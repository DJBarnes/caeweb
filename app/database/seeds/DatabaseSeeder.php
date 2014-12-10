<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Eloquent::unguard();

		// ------------------------------------------------------------------------
		// Seeds for the Room Scheduler
		// ------------------------------------------------------------------------
		$this->call('classroomTableSeeder');
		$this->command->info("classroom Table Seeded");

		$this->call('StartDateSeeder');
		$this->command->info("Start Date Seeded");

		// ------------------------------------------------------------------------
		// Seeds for the Inventory Table
		// ------------------------------------------------------------------------
		$this->call('itemTableSeeder');
		$this->command->info("Item Table Seeded");

		$this->call('ordersTableSeeder');
		$this->command->info("Order Table Seeded");

		$this->call('order_itemTableSeeder');
		$this->command->info("Order_Item Table Seeded");

		$this->call('vendorTableSeeder');
		$this->command->info("Vendor Table Seeded");

		$this->call('trans_logTableSeeder');
		$this->command->info("Trans Log Table Seeded");


		// ------------------------------------------------------------------------
		// Seeds for the AVLog Table
		// ------------------------------------------------------------------------
		$this->call('ceasroomtypesTableSeeder');
		$this->command->info("CEAS Rooms Table Seeded");

		$this->call('ceasroomsTableSeeder');
		$this->command->info("CEAS Rooms Table Seeded");

		$this->call('avlogTableSeeder');
		$this->command->info("CEAS Rooms Table Seeded");


		// ------------------------------------------------------------------------
		// Seeds for the User Table
		// ------------------------------------------------------------------------
		$this->call('PositionsTableSeeder');
		$this->command->info("Positions Table Seeded");

		$this->call('UserTableSeeder');
		$this->command->info("Users Table Seeded");

		$this->call('ShiftSeeder');
		$this->command->info("Shifts Table Seeded");
	}

}

// ----------------------------------------------------------------------------
// Seeds for the Room Scheduler Table
// ----------------------------------------------------------------------------
class ClassroomTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

	}
}

// ----------------------------------------------------------------------------
// Seeds for the Inventory Tables
// ----------------------------------------------------------------------------
class itemTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

		Item::create(array('name' =>'Paper White 8.5 X 11', 'description' => 'Paper for the printers', 'quantity' => '15', 'vendor_id' => '1', 'email_threshold' => '5', 'item_url' => 'http://www.officedepot.com', 'on_order_quantity' => '0', 'active' => '1'));
		Item::create(array('name' =>'Pens', 'description' => 'Pens to write with', 'quantity' => '20', 'vendor_id' => '1', 'email_threshold' => '5', 'item_url' => 'http://www.officedepot.com', 'on_order_quantity' => '0', 'active' => '1'));
		Item::create(array('name' =>'Staples', 'description' => 'Staples for the automatic stapler', 'quantity' => '40', 'vendor_id' => '1', 'email_threshold' => '5', 'item_url' => 'http://www.officedepot.com', 'on_order_quantity' => '0', 'active' => '1'));
		Item::create(array('name' =>'Black Toner', 'description' => 'Black toner for CAE X and Y', 'quantity' => '10', 'vendor_id' => '2', 'email_threshold' => '5', 'item_url' => 'http://www.konica-minolta.com', 'on_order_quantity' => '0', 'active' => '1'));
		Item::create(array('name' =>'Magenta Toner', 'description' => 'Magenta toner for CAE X and Y', 'quantity' => '5', 'vendor_id' => '2', 'email_threshold' => '5', 'item_url' => 'http://www.konica-minolta.com', 'on_order_quantity' => '0', 'active' => '1'));
		Item::create(array('name' =>'Yellow Toner', 'description' => 'Yellow toner for CAE X and Y', 'quantity' => '5', 'vendor_id' => '2', 'email_threshold' => '5', 'item_url' => 'http://www.konica-minolta.com', 'on_order_quantity' => '0', 'active' => '1'));
		Item::create(array('name' =>'Cyan Toner', 'description' => 'Cyan toner for CAE X and Y', 'quantity' => '5', 'vendor_id' => '2', 'email_threshold' => '5', 'item_url' => 'http://www.konica-minolta.com', 'on_order_quantity' => '0', 'active' => '1'));

	}
}

class ordersTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

		Order::create(array('status' => '0'));
		Order::create(array('status' => '0'));
		Order::create(array('status' => '0'));
		Order::create(array('status' => '0'));
		Order::create(array('status' => '0'));

	}
}

class order_itemTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

		Order_Item::create(array('order_id' => '1', 'item_id' => '1', 'order_qty' => '12'));
		Order_Item::create(array('order_id' => '1', 'item_id' => '2', 'order_qty' => '5'));
		Order_Item::create(array('order_id' => '2', 'item_id' => '3', 'order_qty' => '20'));
		Order_Item::create(array('order_id' => '3', 'item_id' => '4', 'order_qty' => '5'));
		Order_Item::create(array('order_id' => '4', 'item_id' => '5', 'order_qty' => '2'));
		Order_Item::create(array('order_id' => '4', 'item_id' => '6', 'order_qty' => '2'));
		Order_Item::create(array('order_id' => '4', 'item_id' => '7', 'order_qty' => '2'));
		Order_Item::create(array('order_id' => '5', 'item_id' => '4', 'order_qty' => '2'));
		Order_Item::create(array('order_id' => '5', 'item_id' => '1', 'order_qty' => '20'));

	}
}

class vendorTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

		Vendor::create(array('name' => 'Office Depot', 'url' => 'http://www.officedepot.com'));
		Vendor::create(array('name' => 'Konica Minolta', 'url' => 'http://www.konica-minolta.com'));

	}
}

class trans_logTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

	}
}

// ----------------------------------------------------------------------------
// Seeds for the AVLog Tables
// ----------------------------------------------------------------------------
class ceasroomtypesTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

		CeasRoomType::create(array('name' => 'classroom'));
		CeasRoomType::create(array('name' => 'computer classroom'));
		CeasRoomType::create(array('name' => 'breakout room'));
		CeasRoomType::create(array('name' => 'special room'));
	}
}

class ceasroomsTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

		CeasRoom::create(array('name' => 'C-122', 'capacity' => '36', 'type' => '1'));
		CeasRoom::create(array('name' => 'C-123', 'capacity' => '42', 'type' => '1'));
		CeasRoom::create(array('name' => 'C-124', 'capacity' => '34', 'type' => '1'));
		CeasRoom::create(array('name' => 'C-136', 'capacity' => '36', 'type' => '1'));
		CeasRoom::create(array('name' => 'C-141', 'capacity' => '30', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-201', 'capacity' => '50', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-202', 'capacity' => '38', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-204', 'capacity' => '36', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-205', 'capacity' => '36', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-206', 'capacity' => '28', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-208', 'capacity' => '50', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-210', 'capacity' => '32', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-212', 'capacity' => '32', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-109', 'capacity' => '150', 'type' => '1'));
		CeasRoom::create(array('name' => 'D-115', 'capacity' => '80', 'type' => '1'));
		CeasRoom::create(array('name' => 'E-124', 'capacity' => '24', 'type' => '1'));

		CeasRoom::create(array('name' => 'C-220', 'capacity' => '26', 'type' => '2'));
		CeasRoom::create(array('name' => 'C-224', 'capacity' => '26', 'type' => '2'));
		CeasRoom::create(array('name' => 'C-226', 'capacity' => '28', 'type' => '2'));
		CeasRoom::create(array('name' => 'C-227', 'capacity' => '24', 'type' => '2'));
		CeasRoom::create(array('name' => 'C-228', 'capacity' => '24', 'type' => '2'));
		CeasRoom::create(array('name' => 'C-229', 'capacity' => '24', 'type' => '2'));

		CeasRoom::create(array('name' => 'A-120', 'capacity' => '16', 'type' => '3'));
		CeasRoom::create(array('name' => 'B-122', 'capacity' => '16', 'type' => '3'));
		CeasRoom::create(array('name' => 'F-115', 'capacity' => '16', 'type' => '3'));
		CeasRoom::create(array('name' => 'G-113', 'capacity' => '16', 'type' => '3'));
		CeasRoom::create(array('name' => 'A-213', 'capacity' => '16', 'type' => '3'));
		CeasRoom::create(array('name' => 'B-211', 'capacity' => '16', 'type' => '3'));
		CeasRoom::create(array('name' => 'F-210', 'capacity' => '16', 'type' => '3'));

		CeasRoom::create(array('name' => 'C-135', 'capacity' => '0', 'type' => '4'));
		CeasRoom::create(array('name' => 'E-103', 'capacity' => '0', 'type' => '4'));
		CeasRoom::create(array('name' => 'C-208', 'capacity' => '24', 'type' => '4'));
		CeasRoom::create(array('name' => 'C-258', 'capacity' => '0', 'type' => '4'));
		CeasRoom::create(array('name' => 'C-209', 'capacity' => '0', 'type' => '4'));
	}
}

class avlogTableSeeder extends Seeder {
	public function run() {
		Eloquent::unguard();

		AVLog::create(array('room_name' => 'C-122', 'message' => 'This is a test message1', 'username' => 'testuser'));
		AVLog::create(array('room_name' => 'C-122', 'message' => 'This is a test message7', 'username' => 'testuser'));
		AVLog::create(array('room_name' => 'D-109', 'message' => 'This is a test message2', 'username' => 'testuser'));
		AVLog::create(array('room_name' => 'C-220', 'message' => 'This is a test message3', 'username' => 'testuser'));
		AVLog::create(array('room_name' => 'C-227', 'message' => 'This is a test message4', 'username' => 'testuser'));
		AVLog::create(array('room_name' => 'A-120', 'message' => 'This is a test message5', 'username' => 'testuser'));
		AVLog::create(array('room_name' => 'C-208', 'message' => 'This is a test message6', 'username' => 'testuser'));
	}
}

// ----------------------------------------------------------------------------
// Seeds for the Positions Table
// ----------------------------------------------------------------------------
class PositionsTableSeeder extends Seeder {
	public function run(){

		//users table seed [Sample user]

		Positions::create(array('position_name' => 'attendant'));
		Positions::create(array('position_name' => 'administrator'));
		Positions::create(array('position_name' => 'programmer'));
		Positions::create(array('position_name' => 'director'));
		Positions::create(array('position_name' => 'building coordinator'));
	}
}

// ----------------------------------------------------------------------------
// Seeds for the Users Table
// ----------------------------------------------------------------------------
class UserTableSeeder extends Seeder {
	public function run(){

		//users table seed [Sample user]

		$user1 = array('username' => 'attendant1', 'password' => Hash::make('password'), 'fullname' => 'Attendant1 Sample', 'position_id' => '1', 'email' =>'attendant2@sample.com', 'phone' => '1111111111', 'schedule_color' => '#f700b5', 'acc_room' => 1, 'acc_avlog' => 1, 'acc_inv' => 1, 'acc_emp' => 1, 'acc_useradm' => 0, 'acc_crud_timesheet' => 0, 'acc_view_timesheet' => 0, 'acc_gen_timesheet' => 0, 'acc_crud_schedule' => 0);
		$user2 = array('username' => 'attendant2', 'password' => Hash::make('password'), 'fullname' => 'Attendant2 Sample', 'position_id' => '1', 'email' =>'attendant1@sample.com', 'phone' => '2222222222', 'schedule_color' => '#13f0b9', 'acc_room' => 1, 'acc_avlog' => 1, 'acc_inv' => 1, 'acc_emp' => 1, 'acc_useradm' => 0, 'acc_crud_timesheet' => 0, 'acc_view_timesheet' => 0, 'acc_gen_timesheet' => 0, 'acc_crud_schedule' => 0);
		
		$user3 = array('username' => 'admin1', 'password' => Hash::make('password'), 'fullname' => 'Admin1 Sample', 'position_id' => '2', 'email' =>'admin1@sample.com', 'phone' => '3333333333', 'schedule_color' => '#568BFC', 'acc_room' => 1, 'acc_avlog' => 1, 'acc_inv' => 1, 'acc_emp' => 1, 'acc_useradm' => 1, 'acc_crud_timesheet' => 1, 'acc_view_timesheet' => 1, 'acc_gen_timesheet' => 1, 'acc_crud_schedule' => 1);
		$user4 = array('username' => 'admin2', 'password' => Hash::make('password'), 'fullname' => 'Admin2 Sample', 'position_id' => '2', 'email' =>'admin2@sample.com', 'phone' => '4444444444', 'schedule_color' => '#f02213', 'acc_room' => 1, 'acc_avlog' => 1, 'acc_inv' => 1, 'acc_emp' => 1, 'acc_useradm' => 1, 'acc_crud_timesheet' => 1, 'acc_view_timesheet' => 1, 'acc_gen_timesheet' => 1, 'acc_crud_schedule' => 1);
		
		$user5 = array('username' => 'programmer1', 'password' => Hash::make('password'), 'fullname' => 'Programmer1 Sample', 'position_id' => '3', 'email' =>'programmer2@sample.com', 'phone' => '5555555555', 'schedule_color' => '#f73f31', 'acc_room' => 1, 'acc_avlog' => 1, 'acc_inv' => 1, 'acc_emp' => 1, 'acc_useradm' => 1, 'acc_crud_timesheet' => 1, 'acc_view_timesheet' => 1, 'acc_gen_timesheet' => 1, 'acc_crud_schedule' => 1);
		$user6 = array('username' => 'programmer2', 'password' => Hash::make('password'), 'fullname' => 'Programmer2 Sample', 'position_id' => '3', 'email' =>'programmer1@sample.com', 'phone' => '6666666666', 'schedule_color' => '#eaf20e', 'acc_room' => 1, 'acc_avlog' => 1, 'acc_inv' => 1, 'acc_emp' => 1, 'acc_useradm' => 1, 'acc_crud_timesheet' => 1, 'acc_view_timesheet' => 1, 'acc_gen_timesheet' => 1, 'acc_crud_schedule' => 1);
		
		$user7 = array('username' => 'director1', 'password' => Hash::make('password'), 'fullname' => 'Director1 Sample', 'position_id' => '4', 'email' =>'director@sample.com', 'phone' => '7777777777', 'schedule_color' => '#f02213', 'acc_room' => 1, 'acc_avlog' => 1, 'acc_inv' => 1, 'acc_emp' => 1, 'acc_useradm' => 1, 'acc_crud_timesheet' => 1, 'acc_view_timesheet' => 1, 'acc_gen_timesheet' => 1, 'acc_crud_schedule' => 1);
		$user8 = array('username' => 'building1', 'password' => Hash::make('password'), 'fullname' => 'Building Coordinator1 Sample', 'position_id' => '5', 'email' =>'buildingcoordinator@sample.com', 'phone' => '8888888888', 'schedule_color' => '#f02213', 'acc_room' => 1, 'acc_avlog' => 1, 'acc_inv' => 1, 'acc_emp' => 1, 'acc_useradm' => 1, 'acc_crud_timesheet' => 1, 'acc_view_timesheet' => 1, 'acc_gen_timesheet' => 1, 'acc_crud_schedule' => 1);

		

		DB::table('users')->insert($user1);
		DB::table('users')->insert($user2);
		DB::table('users')->insert($user3);
		DB::table('users')->insert($user4);
		DB::table('users')->insert($user5);
		DB::table('users')->insert($user6);
		DB::table('users')->insert($user7);
		DB::table('users')->insert($user8);

	}
}

// ----------------------------------------------------------------------------
// Seeds for the Room Scheduler Start Dates. Used by CAEScheduler App
// ----------------------------------------------------------------------------
class StartDateSeeder extends Seeder {
	public function run(){
		$NOW = date('Y-m-d',time());

		//start dates for semesters
		$spring2013 = array('id' => 'spring2013', 'start_date' => '2013-01-07', 'end_date' => '2013-04-27', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($spring2013);
		$summeri2013 = array('id' => 'summeri2013', 'start_date' => '2013-05-06', 'end_date' => '2013-06-26', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summeri2013);
		$summerii2013 = array('id' => 'summerii2013', 'start_date' => '2013-06-27', 'end_date' => '2013-08-16', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summerii2013);	
		$fall2013 = array('id' => 'fall2013', 'start_date' => '2013-09-03', 'end_date' => '2013-12-14', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($fall2013);
		$spring2014 = array('id' => 'spring2014', 'start_date' => '2014-01-06', 'end_date' => '2014-04-26', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($spring2014);
		$summeri2014 = array('id' => 'summeri2014', 'start_date' => '2014-05-05', 'end_date' => '2014-06-25', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summeri2014);
		$summerii2014 = array('id' => 'summerii2014', 'start_date' => '2014-06-26', 'end_date' => '2014-08-15', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summerii2014);		
		$fall2014 = array('id' => 'fall2014', 'start_date' => '2014-09-02', 'end_date' => '2014-12-13', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($fall2014);
		$spring2015 = array('id' => 'spring2015', 'start_date' => '2015-01-12', 'end_date' => '2015-05-02', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($spring2015);
		$summeri2015 = array('id' => 'summeri2015', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summeri2015);
		$summerii2015 = array('id' => 'summerii2015', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summerii2015);
		$fall2015 = array('id' => 'fall2015', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($fall2015);
		$spring2016 = array('id' => 'spring2016', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($spring2016);
		$summeri2016 = array('id' => 'summeri2016', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summeri2016);
		$summerii2016 = array('id' => 'summerii2016', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summerii2016);
		$fall2016 = array('id' => 'fall2016', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($fall2016);
		$spring2017 = array('id' => 'spring2017', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($spring2017);
		$summeri2017 = array('id' => 'summeri2017', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summeri2017);
		$summerii2017 = array('id' => 'summerii2017', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summerii2017);
		$fall2017 = array('id' => 'fall2017', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($fall2017);
		$spring2018 = array('id' => 'spring2018', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($spring2018);
		$summeri2018 = array('id' => 'summeri2018', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summeri2018);
		$summerii2018 = array('id' => 'summerii2018', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($summerii2018);
		$fall2018 = array('id' => 'fall2018', 'start_date' => '1970-01-01', 'end_date' => '1970-01-01', 'created_at' => $NOW, 'updated_at' => $NOW);
		DB::table('semester_start')->insert($fall2018);
	}
}


class ShiftSeeder extends Seeder {
	public function run(){

		$NOW = date('Y-m-d', time());
		$NOW1hr = date('Y-m-d H:i:s',strtotime($NOW . ' + 1 hour'));

		$TOMORROW = date('Y-m-d H:i:s',strtotime($NOW . ' + 1 day'));
		$TOMORROW2hr = date('Y-m-d H:i:s',strtotime($TOMORROW . ' + 2 hour'));

		Shift::create(array('eid' => '17', 'clockIn' => $NOW, 'clockOut' => $NOW1hr));
		Shift::create(array('eid' => '17', 'clockIn' => $TOMORROW, 'clockOut' => $TOMORROW2hr));
		Shift::create(array('eid' => '17', 'clockIn' => $NOW, 'clockOut' => $TOMORROW));
		Shift::create(array('eid' => '17', 'clockIn' => $NOW, 'clockOut' => $TOMORROW2hr));

	}
}