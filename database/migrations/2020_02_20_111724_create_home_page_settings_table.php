<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner_1')->nullable();
            $table->string('banner_2')->nullable();
            $table->string('banner_3')->nullable();
            $table->string('banner_4')->nullable();
            $table->string('banner_1_link')->nullable();
            $table->string('banner_2_link')->nullable();
            $table->string('banner_3_link')->nullable();
            $table->string('banner_4_link')->nullable();
            $table->string('home_bottom_categories')->nullable();
            $table->longText('home_content')->nullable();
            $table->timestamps();
        });

        DB::table('home_page_settings')->insert([
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
        Schema::dropIfExists('home_page_settings');
    }
}
