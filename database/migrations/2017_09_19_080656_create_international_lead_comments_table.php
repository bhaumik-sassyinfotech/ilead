<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternationalLeadCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('international_lead_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('lid')->unsigned()->nullable();
            $table->foreign('lid')->references('lead_id')->on('international_leads');
            $table->text('lead_comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
//        Schema::table('international_lead_comments', function (Blueprint $table) {
//
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('international_lead_comments');
    }
}
