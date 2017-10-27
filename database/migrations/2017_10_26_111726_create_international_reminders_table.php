<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternationalRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('international_reminders', function (Blueprint $table) {
            $table->increments('reminder_id');
            $table->dateTime('remind_at');
            $table->integer('user_added_by');
            $table->integer('user_updated_by');
            $table->string('subject','255');
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
        Schema::dropIfExists('international_reminders');
    }
}
