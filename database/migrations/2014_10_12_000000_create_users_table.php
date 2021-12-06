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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username',255)->nullable();
            $table->string('mobile',255)->nullable();
            $table->integer('role')->nullable();
            $table->string('user_image',255)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            
        });

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Super',
                'email' => 'superadmin@gmail.com',
                'password' => '$2y$10$yUuKjedOJ8r6EiCF3U3CRebhYvjum70IFkAPQC/xVISq6KcXKi8ZW',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'username' => 'Super',
                'role' => 1
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$yUuKjedOJ8r6EiCF3U3CRebhYvjum70IFkAPQC/xVISq6KcXKi8ZW',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'username' => 'admin',
                'role' => 2
            ]
        ]);
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
