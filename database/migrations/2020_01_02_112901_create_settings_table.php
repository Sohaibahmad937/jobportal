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
            $table->bigIncrements('id');
            $table->string('mail_driver',255)->nullable();
            $table->string('mail_host',255)->nullable();
            $table->string('mail_port',255)->nullable();
            $table->string('mail_from_address',255)->nullable();
            $table->string('mail_from_name',255)->nullable();
            $table->string('mail_encryption',255)->nullable();
            $table->string('mail_username',255)->nullable();
            $table->string('mail_password',255)->nullable();
            $table->string('mail_recipient',255)->nullable();
            $table->string('mail_recipientname',255)->nullable();
            $table->timestamps();
        });
        DB::table('settings')->insert([
            [
                'id' => 1
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
        Schema::dropIfExists('settings');
    }
}
