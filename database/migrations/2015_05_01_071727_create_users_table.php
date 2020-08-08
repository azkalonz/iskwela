<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('username');
                $table->string('user_type');
                $table->string('password');
                $table->string('first_name');
                $table->string('middle_name')->nullable();
                            $table->string('last_name');
                            $table->string('gender', 1); /*m male, f female*/
                            $table->string('email')->nullable();
                            $table->integer('phone_number')->nullable();
                            $table->integer('school_id')->nullable();
                $table->integer('status')->default(1);
                            $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
                $table->softDeletes();
                $table->rememberToken();
                $table->unique('username');
            });
        }
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::dropIfExists('users');
   }
}