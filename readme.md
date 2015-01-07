## Overview
CAEWeb is a collection of single page web applications that is used by a Universtiy computer lab to provide a variety of functions which include: Room Scheduling, A/V Log, Inventory, and Employee functions such as clocking in and out, employee schedules, timesheet reporting and generation. The version here on Github is not the exact same version as what was implemented at the University, but retains most of the same features.

A demo of this application can be seen at the following [Link](http://barnesbrothers.homeserver.com/caeweb). The application is wired up to an actual database, and although I don't mind you playing around to see how the application functions, please don't be a troll. Otherwise I will be forced to remove the database component and alter the behavior of the application to something different than what the code reflects.

Use the following login information to try it out.

UN: admin1

PW: password

## History
The University that I worked at needed a new system to replace an existing one that was already doing these functions. The old system was very ummaintainable, and hard to use. This version shown here was redesigned, and built from the ground up with maintainablity in mind.

## Technologies
### Laravel 4.0.*
The University version of the CAEWeb application was created in Laravel 4.0.* with only two external PHP packages. The first package is a LDAP package that was written by me, and is available from this same Github account. This LDAP package is not used in the version of CAEWeb here on Github. This version uses the default of Eloquent and the database for user authentication. The second package is one offered by Conar Welsh. He has a mustache wrapper so that mustache templates can be used with Laravel. Most of the templates used in the app are written with Mustache, and his package helped get those templates into the application.

### Backbone.js and Marionette.js
Marionette is a Javascript framework that was used for the client side of the application. Marionette has only one dependency, Backbone.js. Backbone is a popular client side JS framework that adds some basic MVC structure to appications. The dependencies for Backbone are: jQuery, and Underscore.js. All 4 files are required for the client side. All 4 files should be loaded with a CDN, but currently may not be???
  1. [marionette.js](http://marionettejs.com)
  2. [backbone.js](http://backbonejs.org)
  3. [underscore.js](http://underscorejs.org)
  4. [jQuery.js](http://jquery.com)

### Mustache and Handlebars
Mustache and Handlebars are templating frameworks that both use the same syntax for the templates. Mustache is available for both PHP (Server side) and JS (Client side). This application used Mustache on the server side. For the client side, Handlebars was used. Handlebars can display mustache templates, and offers more features that may be needed in the future. The decision to use these templating frameworks over the the Blade templating provided by Laravel, and the underscore templates provided by Underscore was made in an effort to be able to use the exact same template on both the server side, and the client side. Although currently templates are only being used on the server side, or the client side, the ability to reuse a template on either side is a possibility.

### KendoUI
This project needed a way to schedule rooms and employees. Rather than write a scheduler from the ground up, the decision to use an existing Javascript library was made. A few choices were considered, but in the end KendoUI was the most feature rich one. At the time that the decision was made, there was an open source version that could be used for projects that were not of commercial use. Since the University is not making any money off of this software, it should be within the legal rights to use it in this project. In addition, because the version that was pulled down was open source, it should be safe to say that modifications could be made to the framework and still be within the limits of the law.

Since the original download of the KendoUI framework, Telerik (The creator of Kendo) had changed their available versions for download. The version that was originally downloaded is no longer available. Telerik has split Kendo into two different versions. Core, and Professional. Core is open source, and Professional is paid. Some of the features being used such as the scheduler are not available for use in the new Core version. Because of this, the project is still, and will continue to use the original downloaded version.

There have been quite a few modifications made the the Kendo framework that was downloaded. Some were the implementation of missing features, and some were simple customization that was lacking from what the University needed the scheduler to do. The scheduler has been fully tested to perform exactly as needed for the University. Most if not all alterations to the Kendo code is commented with the changes that took place. There is not a list of the files that were altered, but almost all of them are related to the scheduler.

There are a ton of JS files required to make the scheduler work. They are listed below, and listed in the order that they need to be called in order to ensure that the scheduler operates properly.

  1. kendo.core.js
  2. kendo.data.js
  3. kendo.popup.js
  4. kendo.list.js
  5. kendo.dropdownlist.js
  6. kendo.calendar.js
  7. kendo.datepicker.js
  8. kendo.timepicker.js
  9. kendo.datetimepicker.js
  10. kendo.userevents.js
  11. kendo.numerictextbox.js
  12. kendo.validator.js
  13. kendo.binder.js
  14. kendo.editable.js
  15. kendo.multiselect.js
  16. kendo.draganddrop.js
  17. kendo.window.js
  18. kendo.scheduler.recurrence.js
  19. kendo.scheduler.view.js
  20. kendo.scheduler.dayview.js
  21. kendo.scheduler.agendaview.js
  22. kendo.scheduler.monthview.js
  23. kendo.scheduler.js

## System Overview
### Login

As stated earlier, this version of the CAEWeb application uses the Eloquent driver, which is the Laravel default.

### Room Scheduling

The Room scheduling tab provides a Single Page App using KendoUI and Marionette to display a room scheduler for most of the various rooms in the engineering building of the University. The room scheduler is divided into 4 categories: Classrooms, Computer Classrooms, Breakout Rooms, and Special Rooms. Each of the categories has it's own table in the database. They probably could have been in one big table, but I decided to break them apart. The list of rooms is pulled from the database table named ceas_rooms. The room types comes from the database table ceas_room_types.

#### Room Event Public API

There is a public address API that can be used to access individual events that are stored in the room scheduler application. The user simply needs to point to the API to receive data. The API can return a narrowed result by providing some get parameters in the URL for the request. The parameters are:

  * startdate
  * enddate
  * room

There is one more optional parameter that will change the response from JSON to JSONP. It will not impact the actual data that is returned, only what format it is returned in.

  * callback

When providing the callback parameter, the value of callback should be the name of the callback function that should be invoked when the data is returned. If the callback parameter is not included, the response will be JSON instead of JSONP

If no parameters are provided, the API will default to all rooms maintained by the system, and will use a start date of epoch, and an end date of today's current date. More than likely parameters will always be passed to narrow the results.

A sample link is provided below that incorporates all 3 of the query parameters that can be passed in.

[http://barnesbrothers.homeserver.com/caeweb/roomschedule/api/kiosk?startdate=2014-09-01&enddate=2014-10-31&room=D-205] (http://barnesbrothers.homeserver.com/caeweb/roomschedule/api/kiosk?startdate=2014-09-01&enddate=2014-10-31&room=D-205)

The result of the query will return all single and reoccurring events for the specified time period. For reoccurring events, each reoccurring event will be expanded into the equivalent of many single events. This way, any receiving applications do not need to worry about expanding the events on their own.

#### Room Info
##### Classrooms

The classrooms tab lists all of the classrooms that are used for classes. This does not include the classrooms in the computer lab that the CAE Center takes care of. This also does not include any of the breakout rooms and special rooms. A comprehensive list is as follows:
  * C-122
  * C-123
  * C-124
  * C-136
  * C-141
  * D-201
  * D-202
  * D-204
  * D-205
  * D-206
  * D-208
  * D-210
  * D-212
  * D-109
  * D-115
  * E-124

##### Computer Classrooms

The computer classrooms are all of the classrooms that are used for computer classes. These are the rooms that the CAE Center manages and takes care of. This does not include the regular classrooms,  breakout rooms and special rooms. A comprehensive list is as follows:
  * C-220
  * C-224
  * C-226
  * C-227
  * C-228
  * C-229

##### Breakout Rooms

The breakout rooms are all of the small rooms throughout the building that say breakout room on the outside. This does not include the classrooms, computer classrooms, or any special rooms. A comprehensive list is as follows:
  * A-120
  * B-122
  * F-115
  * G-113
  * A-213
  * B-211
  * F-210

##### Special Rooms

The special rooms are all of the rooms that are used but not in any of the above mention categories. This list does not include any of the various research labs that are scattered throughout the building. It only applies to rooms that can be scheduled for events. A comprehensive list is as follows:
  * C-135
  * E-103
  * C-208
  * C-258
  * C-209

### Audio Video Log
The AVlog tab is used to track work done related to AV equipment. The AVLog tab is broken up into the same set of rooms as the room scheduler. It is a Marionette single page app. The list of rooms is pulled from the database table named ceas_rooms. The room types comes from the database table ceas_room_types.

#### Room Info
##### Classrooms

The classrooms tab lists all of the classrooms that are used for classes. This does not include the classrooms in the computer lab that the CAE Center takes care of. This also does not include any of the breakout rooms and special rooms. A comprehensive list is as follows:
  * C-122
  * C-123
  * C-124
  * C-136
  * C-141
  * D-201
  * D-202
  * D-204
  * D-205
  * D-206
  * D-208
  * D-210
  * D-212
  * D-109
  * D-115
  * E-124

##### Computer Classrooms

The computer classrooms are all of the classrooms that are used for computer classes. These are the rooms that the CAE Center manages and takes care of. This does not include the regular classrooms,  breakout rooms and special rooms. A comprehensive list is as follows:
  * C-220
  * C-224
  * C-226
  * C-227
  * C-228
  * C-229

##### Breakout Rooms

The breakout rooms are all of the small rooms throughout the building that say breakout room on the outside. This does not include the classrooms, computer classrooms, or any special rooms. A comprehensive list is as follows:
  * A-120
  * B-122
  * F-115
  * G-113
  * A-213
  * B-211
  * F-210

##### Special Rooms

The special rooms are all of the rooms that are used but not in any of the above mentioned categories. This list does not include any of the various labs that are scattered throughout the building. It only applies to rooms that can be scheduled for events. A comprehensive list is as follows:
  * C-135
  * E-103
  * C-208
  * C-258
  * C-209

### Inventory

The inventory app in CAEWeb is an improvement upon the original inventory app that was created for the CAECenter. The original version is also available on this github account and named simply 'inventory'. The new version offers the exact same functionality as the original but in much more user friendly version that is also designed better, and more maintainable. There are 4 main sections in the inventory app. They are Current Inventory, View Orders, Place Orders, and View log.

#### Current Inventory

The current inventory tab shows all of the items that the CAE Center is tracking, and the assoicated quantities of each item. There is information about the email threshold, and on order quantity as well. Next to the quantity there are increment and decrement buttons. Clicking them changes the inventory automatically and persists that data to the server. Double clicking on a row of an item will open up a modal box where the details of the item can be edited. The modal box can be closed by clicking either save or cancel. If a new item needs to be added to the system, the user can click the add new button. This will open a different but similar modal box that will allow the user to fill out the appropriate information. Once filled out the user can click save to add the new item, or cancel to return to the inventory listing.

#### View Orders

The view orders tab allows a user to see all of the orders that have ever been placed. It shows which vendor the order was for, and if it is open or not, as well as the number of items that were ordered. Double clicking the row of information for the order will open up a modal box displaying the details of the order, as well as a list of what was ordered. If the order is an open order, the modal box will give an option to accept the order. Accepting the order will close out the order and automatically update the quantities for the items in the order to current quantites plus the ordered amount.

#### Place Orders

The place orders tab shows the exact same information as the current inventory tab, however in place of the quanitity spot is a textbox that can be filled out to place an order. When the fields are filled out, and the place order button is clicked, the system will create a new order for each vendor that items are being ordered from. The system does not currenlty send the order somewhere. It simply creates the order in the system. Future plans are to either have the order emailed to an account, or integrate it with some other ordering system. Once and order is submitted, the system will then switch tabs to the view orders tab so that the user can see the newly created orders. In addition to all of these updates, the items will update the on order quantity to show that there are more on the way.

#### View Log

The view log tab shows all of the transactions that have occurred during the use of the system. It sorts the log in reverse chronological order with the most recent transactions at the top. The system also tries to lump any transactions that occur at the same time into a single log. (ie. If say the decrement button is pressed 3 times, rather than logging that the item was decremented by 1, 3 times, it will attempt to see that the actions were performed at relatively the same time, and group them into a single log entry showing 1 decrement of 3.) This may not always work since it does this work by setting a timeout to fire after a few seconds and do the logging. If the increment or decrement are clicked before the timeout fires, the timeout is reset and starts the countdown over. Once the timer actually runs out, the log is fired, and the log reflects how many transactions occurred.

### Employee

This tab is not complete yet, and documentation is still being added to it.

#### Clockin/out

#### Admin Schedule

#### Attendant Schedule

#### Programmer Schedule

#### Timesheet

### User Admin

This tab is not complete yet, and documentation is still being added to it.

## Installation

To install this application you can folllow the following instructions:
  1. clone or download the repository.
  2. Make sure that the web root for your domain points to the public folder of laravel. The public folder is the entry point for the application.
  3. Run 'composer install' using [Composer](https://getcomposer.org)
  4. Create the database that will be used for the application.
  5. Edit database.php in app/config/ and provide the database name and connection parameters.
  6. Run the migrations and seeds provided in the project. See the database section for more info.
  7. If all went well, you should be done.

## Database Information
### Database Name
By default the name of the database is: 

caeweb

This can easily be changed if needed in the database.php file located under the app/config/ directory.

### Tables

All of the table structure has been listed below for reference. Tables can be created and seeded using the artisan commands provided by Laravel. All of the migrations and seeds are already created, but the commands to run them needs to be issued. For instructions on how to do this, refer to the [Laravel](http://laravel.com/docs/4.0/migrations) site.

#### adminschedule

| Field               | Type             | Null | Key | Default             | Extra        |
|---------------------|------------------|------|-----|---------------------|--------------|
| id                  | int(10) unsigned | NO   |PRI  | NULL                |auto_increment|
| Title               | varchar(255)     | NO   |     | NULL                |              |
| Availability        | int(11)          | NO   |     | NULL                |              |
| Start               | datetime         | NO   |     | NULL                |              |
| End                 | datetime         | NO   |     | NULL                |              |
| Employee            | int(11)          | NO   |     | NULL                |              |
| RecurrenceId        | varchar(255)     | NO   |     | NULL                |              |
| RecurrenceRule      | varchar(255)     | NO   |     | NULL                |              |
| RecurrenceException | varchar(255)     | NO   |     | NULL                |              |
| created_at          | timestamp        | NO   |     | NULL                |              |
| updated_at          | timestamp        | NO   |     | NULL                |              |

#### attendantschedule

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| Title               | varchar(255)     | NO   |     | NULL                |                |
| Availability        | int(11)          | NO   |     | NULL                |                |
| Start               | datetime         | NO   |     | NULL                |                |
| End                 | datetime         | NO   |     | NULL                |                |
| Employee            | int(11)          | NO   |     | NULL                |                |
| RecurrenceId        | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceRule      | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceException | varchar(255)     | NO   |     | NULL                |                |
| created_at          | timestamp        | NO   |     | NULL                |                |
| updated_at          | timestamp        | NO   |     | NULL                |                |

#### av_log

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| room_name           | varchar(255)     | NO   |     | NULL                |                |
| message             | text             | NO   |     | NULL                |                |
| username            | varchar(255)     | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |


#### breakoutrooms

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| RoomId              | int(11)          | NO   |     | NULL                |                |
| Title               | varchar(255)     | NO   |     | NULL                |                |
| Start               | datetime         | NO   |     | NULL                |                |
| End                 | datetime         | NO   |     | NULL                |                |
| Attendee            | int(11)          | NO   |     | NULL                |                |
| Host                | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceId        | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceRule      | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceException | varchar(255)     | NO   |     | NULL                |                |
| created_at          | date             | NO   |     | NULL                |                |
| updated_at          | date             | NO   |     | NULL                |                |

#### ceas_room_types

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| name                | varchar(255)     | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |

#### ceas_rooms

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| name                | varchar(255)     | NO   |     | NULL                |                |
| capacity            | int(11)          | NO   |     | NULL                |                |
| type                | int(11)          | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |


#### classrooms

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| RoomId              | int(11)          | NO   |     | NULL                |                |
| Title               | varchar(255)     | NO   |     | NULL                |                |
| Start               | datetime         | NO   |     | NULL                |                |
| End                 | datetime         | NO   |     | NULL                |                |
| Attendee            | int(11)          | NO   |     | NULL                |                |
| Host                | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceId        | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceRule      | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceException | varchar(255)     | NO   |     | NULL                |                |
| created_at          | date             | NO   |     | NULL                |                |
| updated_at          | date             | NO   |     | NULL                |                |


#### computerclassrooms

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| RoomId              | int(11)          | NO   |     | NULL                |                |
| Title               | varchar(255)     | NO   |     | NULL                |                |
| Start               | datetime         | NO   |     | NULL                |                |
| End                 | datetime         | NO   |     | NULL                |                |
| Attendee            | int(11)          | NO   |     | NULL                |                |
| Host                | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceId        | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceRule      | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceException | varchar(255)     | NO   |     | NULL                |                |
| created_at          | date             | NO   |     | NULL                |                |
| updated_at          | date             | NO   |     | NULL                |                |

#### item

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| name                | varchar(25)      | NO   |     | NULL                |                |
| description         | varchar(100)     | NO   |     | NULL                |                |
| quantity            | int(11)          | NO   |     | NULL                |                |
| vendor_id           | int(11)          | NO   |     | NULL                |                |
| email_threshold     | int(11)          | NO   |     | NULL                |                |
| item_url            | varchar(150)     | NO   |     | NULL                |                |
| on_order_quantity   | int(11)          | NO   |     | NULL                |                |
| active              | tinyint(1)       | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |

#### migrations

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| migration           | varchar(255)     | NO   |     | NULL                |                | 
| batch               | int(11)          | NO   |     | NULL                |                |

#### order_item

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| order_id            | int(11)          | NO   |     | NULL                |                |
| item_id             | int(11)          | NO   |     | NULL                |                |
| order_qty           | int(11)          | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |

#### orders

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| status              | smallint(6)      | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |

#### positions

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| position_name       | varchar(30)      | NO   |     | NULL                |                |
| created_at          | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
| updated_at          | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |

#### programmerschedule

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| Title               | varchar(255)     | NO   |     | NULL                |                |
| Availability        | int(11)          | NO   |     | NULL                |                |
| Start               | datetime         | NO   |     | NULL                |                |
| End                 | datetime         | NO   |     | NULL                |                |
| Employee            | int(11)          | NO   |     | NULL                |                |
| RecurrenceId        | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceRule      | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceException | varchar(255)     | NO   |     | NULL                |                |
| created_at          | timestamp        | NO   |     | NULL                |                |
| updated_at          | timestamp        | NO   |     | NULL                |                |

#### semester_start

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | varchar(255)     | NO   | PRI | NULL                | auto_increment |
| start_date          | date             | NO   |     | NULL                |                |
| end_date            | date             | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |

#### specialrooms

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| RoomId              | int(11)          | NO   |     | NULL                |                |
| Title               | varchar(255)     | NO   |     | NULL                |                |
| Start               | datetime         | NO   |     | NULL                |                |
| End                 | datetime         | NO   |     | NULL                |                |
| Attendee            | int(11)          | NO   |     | NULL                |                |
| Host                | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceId        | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceRule      | varchar(255)     | NO   |     | NULL                |                |
| RecurrenceException | varchar(255)     | NO   |     | NULL                |                |
| created_at          | date             | NO   |     | NULL                |                |
| updated_at          | date             | NO   |     | NULL                |                |

#### trans_log

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| username            | varchar(30)      | NO   |     | NULL                |                |
| itemname            | varchar(25)      | NO   |     | NULL                |                |
| action              | varchar(255)     | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |

#### users

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| username            | varchar(16)      | NO   | UNI | NULL                |                |
| password            | varchar(60)      | NO   |     | NULL                |                |
| fullname            | varchar(40)      | NO   |     | NULL                |                |
| position_id         | int(10) unsigned | NO   | MUL | NULL                |                |
| email               | varchar(40)      | NO   |     | NULL                |                |
| phone               | varchar(10)      | NO   |     | NULL                |                |
| schedule_color      | varchar(7)       | NO   |     | NULL                |                |
| acc_room            | tinyint(1)       | NO   |     | NULL                |                |
| acc_avlog           | tinyint(1)       | NO   |     | NULL                |                |
| acc_inv             | tinyint(1)       | NO   |     | NULL                |                |
| acc_emp             | tinyint(1)       | NO   |     | NULL                |                |
| acc_useradm         | tinyint(1)       | NO   |     | NULL                |                |
| acc_crud_timesheet  | tinyint(1)       | NO   |     | NULL                |                |
| acc_view_timesheet  | tinyint(1)       | NO   |     | NULL                |                |
| acc_gen_timesheet   | tinyint(1)       | NO   |     | NULL                |                |
| acc_crud_schedule   | tinyint(1)       | NO   |     | NULL                |                |
| created_at          | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
| updated_at          | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |

#### vendor

| Field               | Type             | Null | Key | Default             | Extra          |
|---------------------|------------------|------|-----|---------------------|----------------|
| id                  | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| name                | varchar(20)      | NO   |     | NULL                |                |
| url                 | varchar(150)     | NO   |     | NULL                |                |
| created_at          | datetime         | NO   |     | NULL                |                |
| updated_at          | datetime         | NO   |     | NULL                |                |
