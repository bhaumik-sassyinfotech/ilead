<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalLeadNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_lead_notes', function (Blueprint $table) {
            $table->increments('note_id');
            $table->integer('lid')->comment('lead id for which notes are added');
//            $table->foreign('lid')->references('lead_id')->on('international_leads');
            $table->text('note_desc');
            $table->integer('user_added_by')->default(0);
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
        Schema::dropIfExists('local_lead_notes');
    }
}
