<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_leads', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('lead_id');
            $table->string('company_name');
            $table->string('contact_person', 255)->nullable();
            $table->string('job_title', 255)->nullable();
            $table->integer('source_id')->default(0);
            $table->string('phone_number_1',50)->nullable();
            $table->string('phone_number_2',50)->nullable();
            $table->string('email',255)->nullable();
            $table->text('address');
            $table->string('industry', 255)->nullable();
            $table->string('url', 255);
            $table->text('comment');
            $table->integer('type')->default(0);
            $table->string('refer_id', 255)->default(0);
            $table->string('status', 255);
            $table->text('tags');
            $table->integer('currency')->default(0);
            $table->float('amount', 8, 2)->default(0);
            $table->string('user_added_by',10)->nullable();
//
//
//            $table->string('location')->nullable();
//
//            $table->string('skype',255)->nullable();
//            $table->string('phone_number',20)->nullable();
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
        //
        Schema::dropIfExists('local_leads');
    }
}
