<?php
class InventoryApiController extends BaseController {
  public function index() {
    try {
      $itemsWithVendorName = DB::select("SELECT i.id, i.name, i.quantity, i.vendor_id, i.item_url, i.description, v.name as vendor_name, i.email_threshold, i.on_order_quantity FROM item as i, vendor as v WHERE v.id = i.vendor_id AND i.active = 1");
      $items = json_decode(json_encode((array)$itemsWithVendorName),true);
            
      return json_encode($items);
    } catch(Exception $e) {
      return json_encode('{"error":{"text":' . $e->getMessage() . '}}');
    }
  }

  public function store() {
    try {
      $addModel = Input::json()->all();
      //select the vendor name of the new selected vendor
      $vendorQueryResult = Vendor::find($addModel['vendor_id']);
      $newVendorName = $vendorQueryResult->name;

      $addItem = new Item;

      $addItem->description = $addModel['description'];
      $addItem->email_threshold = $addModel['email_threshold'];
      $addItem->item_url = $addModel['item_url'];
      $addItem->name = $addModel['name'];
      $addItem->on_order_quantity = $addModel['on_order_quantity'];
      $addItem->quantity = $addModel['quantity'];
      $addItem->vendor_id = $addModel['vendor_id'];
      $addItem->active = 1;

      $addItem->save();

      $addItem->adjustmentQty = 0;
      $addItem->vendor_name = $newVendorName;

      return $addItem->toJson();
    } catch(Exception $e) {
      return json_encode('{"error":{"text":' . $e->getMessage() . '}}');
    }
  }

  public function update($id) {
    try{
      //get the json from the request.
      $updateModel = Input::json()->all();

      //select the vendor name of the new selected vendor
      $vendorQueryResult = Vendor::find($updateModel['vendor_id']);
      $newVendorName = $vendorQueryResult->name;
      
      //update the item model based on the json data sent.
      $updateItem = Item::find($id);
      $updateItem->description = $updateModel['description'];
      $updateItem->email_threshold = $updateModel['email_threshold'];
      $updateItem->item_url = $updateModel['item_url'];
      $updateItem->name = $updateModel['name'];
      $updateItem->on_order_quantity = $updateModel['on_order_quantity'];
      $updateItem->vendor_id = $updateModel['vendor_id'];

      $updateItem->quantity = ($updateItem->quantity + $updateModel['adjustmentQty']);
      if ($updateItem->quantity < 0) {
        $updateItem->quantity = 0;
      }
      //if ($updateItem->quantity > 999) {
      // $updateItem->quantity = 999;
      //}

      //save the updated item to the database
      $updateItem->save();

      //append the new vendor name to the model to send back in the response
      $updateItem->vendor_name = $newVendorName;
      $updateItem->adjustmentQty = 0;

      //send the response
      echo $updateItem->toJson();
    } catch(Exception $e) {
      return json_encode('{"error":{"text":' . $e->getMessage() . '}}');
    }
  }

  //This function does a soft delete. Hard deletes may screw up order history. This is why soft deletes are used.
  public function destroy($id) {
    try {
      $deleteItem = Item::find($id);
      $deleteItem->active = 0;
      $deleteItem->save();
      //Destroy must return the object that was destroyed for backbone to not throw an error.
      return $deleteItem->toJson();
    } catch(Exception $e) {
      return json_encode('{"error":{"text":' . $e->getMessage() . '}}');
    }
  }
}