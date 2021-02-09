<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('welcomg_content', 255)->nullable();
            $table->string('welcomg_media', 100)->nullable();
            $table->string('mission', 1000)->nullable();
            $table->string('email', 50)->nullable();
            $table->char('phone', 15)->nullable();
            $table->char('show_welcome')->default('N');
            $table->char('show_deletes')->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
