<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainMenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_menues', function (Blueprint $table) {
            $table->bigIncrements('main_id');
            $table->string('name',255)->nullable();
            $table->integer('createdate')->nullable();
            //$table->timestamps();
        });
        DB::table('main_menues')->insert([

            [
                'main_id' => 3,
                'name' => 'Admin Menu',
                'createdate' => 1519893716
            ],
            [
                'main_id' => 5,
                'name' => 'Front',
                'createdate' => 1573214138
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
        Schema::dropIfExists('main_menues');
    }
}
