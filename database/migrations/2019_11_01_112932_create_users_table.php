<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('name')->nullable(false)->unique();
            $table->string('email')->nullable(false)->unique();
            $table->text('password')->nullable(false);
            $table->string('profile', 255)->nullable();
            $table->string('type', 1)->nullable(false)->default(1);
            $table->string('phone', 20)->nullable();
            $table->string('address', 255)->nullable();
            $table->date('dob')->nullable();
            $table->integer('create_user_id')->unsigned();
            $table->foreign('create_user_id')->references('id')->on('users');
            $table->integer('updated_user_id')->unsigned();
            $table->foreign('updated_user_id')->references('id')->on('users');
            $table->integer('deleted_user_id')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes()->nullable();
            $table->string('remember_token', 100)->nullable()->default(null);
        });
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
