<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->char('state', 2);
            $table->string('state_name', 25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
	
	/**
	
		INSERT INTO `states` (`id`, `state_name`, `state_abb`) VALUES
		(1, 'Alabama', 'AL'),
		(2, 'Alaska', 'AK'),
		(3, 'Arizona', 'AZ'),
		(4, 'Arkansas', 'AR'),
		(5, 'California', 'CA'),
		(6, 'Colorado', 'CO'),
		(7, 'Connecticut', 'CT'),
		(8, 'Delaware', 'DE'),
		(9, 'Florida', 'FL'),
		(10, 'Georgia', 'GA'),
		(11, 'Hawaii', 'HI'),
		(12, 'Idaho', 'ID'),
		(13, 'Illinois', 'IL'),
		(14, 'Indiana', 'IN'),
		(15, 'Iowa', 'IO'),
		(16, 'Kansas', 'KS'),
		(17, 'Kentucky', 'KY'),
		(18, 'Louisiana', 'LA'),
		(19, 'Maine', 'ME'),
		(20, 'Maryland', 'MD'),
		(21, 'Massachusetts', 'MA'),
		(22, 'Michigan', 'MI'),
		(23, 'Minnesota', 'MN'),
		(24, 'Mississippi', 'MS'),
		(25, 'Missouri', 'MO'),
		(26, 'Montana', 'MT'),
		(27, 'Nebraska', 'NE'),
		(28, 'Nevada', 'NV'),
		(29, 'New Hampshire', 'NH'),
		(30, 'New Jersey', 'NJ'),
		(31, 'New Mexico', 'NM'),
		(32, 'New York', 'NY'),
		(33, 'North Carolina', 'NC'),
		(34, 'North Dakota', 'ND'),
		(35, 'Ohio', 'OH'),
		(36, 'Oklahoma', 'OK'),
		(37, 'Oregon', 'OR'),
		(38, 'Pennsylvania', 'PA'),
		(39, 'Rhode Island', 'RI'),
		(40, 'South Carolina', 'SC'),
		(41, 'South Dakota', 'SD'),
		(42, 'Tennessee', 'TN'),
		(43, 'Texas', 'TX'),
		(44, 'Utah', 'UT'),
		(45, 'Vermont', 'VT'),
		(46, 'Virginia', 'VA'),
		(47, 'Washington', 'WA'),
		(48, 'West Virginia', 'WV'),
		(49, 'Wisconson', 'WI'),
		(50, 'Wyoming', 'WY');
		
	**/
}
