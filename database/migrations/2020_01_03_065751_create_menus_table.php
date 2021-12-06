<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('menu_id');
            $table->integer('main_menu_id')->nullable();
            $table->integer('submenu')->default(0)->comment('1=yes, 0=no');
            $table->string('menu_title')->nullable();
            $table->string('menu_title_guj')->nullable();
            $table->string('menu_title_hin')->nullable();
            $table->integer('parent_menu_id')->default(0)->nullable();
            $table->string('link')->nullable();
            $table->integer('sort')->nullable();
            $table->string('Target')->default('_self')->nullable();
            $table->integer('publish')->nullable();
            $table->string('icons')->nullable();
            $table->integer('menu_type')->nullable()->comment('1=page,2=link,3=submenu');
            $table->timestamps();
        });
        DB::table('menus')->insert([
            [
                'menu_id' => 1,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Dashboard',
                'parent_menu_id' => 0,
                'link' => 'admin/home',
                'sort' => 1,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-tachometer-alt',
                'menu_type' => 2
            ]
            ,
            [
                'menu_id' => 2,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Users',
                'parent_menu_id' => 0,
                'link' => 'admin/users',
                'sort' => 3,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 2
            ],
            [
                'menu_id' => 3,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Menus',
                'parent_menu_id' => 0,
                'link' => 'admin/menus',
                'sort' => 2,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 2
            ]
            ,
            [
                'menu_id' => 4,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Administration',
                'parent_menu_id' => 0,
                'link' => NULL,
                'sort' => 2,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 3
            ]
            ,
            
            [
                'menu_id' => 5,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Roles',
                'parent_menu_id' => 4,
                'link' => 'admin/roles',
                'sort' => 2,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 2
            ]
             ,
              
            
            [
                'menu_id' => 6,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Settings',
                'parent_menu_id' => 4,
                'link' => 'admin/settings',
                'sort' => 2,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 2
            ]
             ,
            
            [
                'menu_id' => 7,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Web Settings',
                'parent_menu_id' => 0,
                'sort' => 2,
                'link' => NULL,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 3
            ]
            ,
            
            [
                'menu_id' => 8,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Sliders',
                'parent_menu_id' => 7,
                'link' => 'admin/sliders',
                'sort' => 2,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 2
            ]
            ,
            
            [
                'menu_id' => 9,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Home Page Settings',
                'parent_menu_id' => 7,
                'link' => 'admin/home_page_settings',
                'sort' => 2,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 2
            ]
            ,
            
            [
                'menu_id' => 10,
                'main_menu_id' => 3,
                'submenu' => 0,
                'menu_title' => 'Pages',
                'parent_menu_id' => 0,
                'link' => 'admin/pages',
                'sort' => 2,
                'Target' => '_self',
                'publish' => 1,
                'icons' => 'fas fa-cubes',
                'menu_type' => 2
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
        Schema::dropIfExists('menus');
    }
}
