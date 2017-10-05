<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColdLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_leads', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('lead_id');
            $table->string('company_name');
            $table->string('contact_person', 255)->nullable();
            $table->string('job_title', 255)->nullable();
            $table->string('refer_id', 255)->default(0);
            $table->integer('type')->default(0);
            $table->string('url', 255);
            $table->integer('source_id')->default(0);
            $table->integer('currency')->default(0);
            $table->float('amount', 8, 2)->default(0);
            $table->string('status', 255);
            $table->string('email',255)->nullable();
            $table->string('industry', 255)->nullable();
            $table->string('phone_number_1',50)->nullable();
            $table->string('phone_number_2',50)->nullable();
            $table->string('type_1',255);
            $table->string('staff_size',50)->nullable();
            $table->string('distance',50)->nullable();
            $table->string('postcode',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('linked_in',50)->nullable();
            $table->text('address_1');
            $table->text('address_2');
            $table->text('comment');
            $table->text('tags');
            $table->string('user_added_by',10)->nullable();
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
        Schema::dropIfExists('cold_leads');
    }
}
