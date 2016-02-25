<?php

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
            $table->increments('id')->unsigned();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('section')->comment = 'admin,front';
            $table->string('name');
            $table->string('class')->nullable()->comment = 'css class';
            $table->string('route')->nullable()->comment = 'if type is external use https://example.com';
            $table->smallInteger('position')->nullable();
            $table->tinyInteger('default')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
