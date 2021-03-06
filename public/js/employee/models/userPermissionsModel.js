//Define the module EmployeeTab for all functions that apply to all tabs. Tab specific ones will be namespaced to thier specific tab.
EmployeeApp.module('EmployeeTab', function (EmployeeTab, App, Backbone, Marionette, $, _) {
  //Define a model to be used when fetching the current user permissions
  EmployeeTab.UserPermissionModel = Backbone.Model.extend({
    //define defaults for new models
    defaults : {
      'username':'',
      'fullname':'',
      'email':'',
      'schedule_color':'',
      'fullname':'',
      'acc_room':'',
      'acc_avlog':'',
      'acc_inv':'',
      'acc_emp':'',
      'acc_useradm':'',
      'acc_crud_timesheet':'',
      'acc_view_timesheet':'',
      'acc_gen_timesheet':'',
      'acc_crud_schedule':'',
      'created_at':'',
      'updated_at':''
    },

    //url that will be used to persist data.
    urlRoot : 'api/userpermissions'
  });
});