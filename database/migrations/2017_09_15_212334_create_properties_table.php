<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id')->unsigned();
			$table->string('address', 100)->nullable();
			$table->string('city', 30)->nullable();
			$table->char('state', 2)->nullable();
			$table->string('zip', 10)->nullable();
			$table->string('title', 100)->nullable();
			$table->string('description', 500)->nullable();
			$table->string('type', 10)->nullable();
			$table->double('price', 15, 2)->nullable();
			$table->date('available_date')->nullable();
			$table->char('active', 1)->default('N');
			$table->char('showcase', 1)->default('N');
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
