<?php
    
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    
    class CreateInternationalLeadsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('international_leads', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('lead_id');
                $table->string('project_name', 301);
                $table->string('contact_person', 255)->nullable();
                $table->string('job_title', 255)->nullable();
                $table->string('refer_id', 255)->nullable();
                $table->integer('type')->default(0);
                $table->integer('currency');
                $table->float('amount', 8, 2);
                $table->integer('source_id')->default(0);
                $table->text('tags');
                $table->text('comment');
                $table->string('status', 255);
                $table->string('url', 255);
                $table->string('location')->nullable();
                $table->string('email',255)->nullable();
                $table->string('skype',255)->nullable();
                $table->string('phone_number',20)->nullable();
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
            Schema::dropIfExists('international_leads');
        }
    }
