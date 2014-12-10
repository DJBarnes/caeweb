<?php
class AVLogApiController extends BaseController {

  public function index() {
    return AVLog::where('room_name', '=', Input::get('room'))->get();
  }

  public function store() {
    try {
      $addModel = Input::json()->all();

      $addLogEntry = new AVLog;

      $addLogEntry->room_name = $addModel['room_name'];
      $addLogEntry->message = $addModel['message'];
      $addLogEntry->username = Auth::user()->fullname;

      $addLogEntry->save();

      return $addLogEntry->toJson();
    } catch(Exception $e) {
      return json_encode('{"error":{"text":' . $e->getMessage() . '}}');
    }
  }

  public function update($id) {
    //stub for updates. Should not be needed.
  }

  public function destroy($id) {
    //stub for deletes. Should not be needed.
  }
}