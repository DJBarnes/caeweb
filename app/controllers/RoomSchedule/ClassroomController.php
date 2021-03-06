<?php
 
use Illuminate\Database\Eloquent\Collection as BaseCollection;

class ClassroomController extends BaseController {
  
  public function getIndex()
  {
    $theArray = Classroom::all();
    $jsonArray = $theArray->toJson();
    return $jsonArray;
  }

  public function postNew()
  {
    $NewModel = Input::json('models.0');

    $startDatetime = new DateTime();
    $endDatetime = new DateTime();

    $Eastern = new DateTimeZone('America/Detroit');
    $startDatetime->setTimezone($Eastern);
    $endDatetime->setTimezone($Eastern);

    $startDatetime->setTimestamp(strtotime($NewModel['Start']));
    $endDatetime->setTimestamp(strtotime($NewModel['End']));

    $newClassroom = new Classroom;
    $newClassroom->RoomId = $NewModel['RoomId'];
    $newClassroom->Title = $NewModel['Title'];
    $newClassroom->Start = $startDatetime->format('Y-m-d H:i:s');
    $newClassroom->End = $endDatetime->format('Y-m-d H:i:s');
    $newClassroom->Attendee = $NewModel['Attendee'];
    $newClassroom->Host = $NewModel['Host'];
    $newClassroom->RecurrenceId = $NewModel['RecurrenceId'];
    if (array_key_exists('RecurrenceRule',$NewModel)) {
      $newClassroom->RecurrenceRule = $NewModel['RecurrenceRule'];
    }
    $newClassroom->RecurrenceException = $NewModel['RecurrenceException'];

    $newClassroom->save();

    return $newClassroom->toJson();
  }

  public function putUpdate()
  {
    $modelArray = array();
    $updateModels = Input::json('models');
    foreach ($updateModels as $model) {

      $startDatetime = new DateTime();
      $endDatetime = new DateTime();

      $Eastern = new DateTimeZone('America/Detroit');
      $startDatetime->setTimezone($Eastern);
      $endDatetime->setTimezone($Eastern);

      $startDatetime->setTimestamp(strtotime($model['Start']));
      $endDatetime->setTimestamp(strtotime($model['End']));
      
      $updateClassroom = Classroom::find($model['id']);
      $updateClassroom->RoomId = $model['RoomId'];
      $updateClassroom->Title = $model['Title'];
      $updateClassroom->Start = $startDatetime->format('Y-m-d H:i:s');
      $updateClassroom->End = $endDatetime->format('Y-m-d H:i:s');
      $updateClassroom->Attendee = $model['Attendee'];
      $updateClassroom->Host = $model['Host'];
      $updateClassroom->RecurrenceId = $model['RecurrenceId'];
      if (array_key_exists('RecurrenceRule', $model)) {
        $updateClassroom->RecurrenceRule = $model['RecurrenceRule'];
      }
      $updateClassroom->RecurrenceException = $model['RecurrenceException'];

      $updateClassroom->save();

      array_push($modelArray, $updateClassroom);
      $returnModels = BaseCollection::make($modelArray);
    }
    echo $returnModels->toJson();
  }

  public function deleteDestroy()
  {
    $modelArray = array();
    $deleteModels = Input::json('models');
    foreach ($deleteModels as $model) {
      $deleteClassroom = Classroom::find($model['id']);
      $deleteClassroom->delete();
      array_push($modelArray, $deleteClassroom);
      $returnModels = BaseCollection::make($modelArray);
    }
    echo $returnModels->toJson();
  }

}
?>