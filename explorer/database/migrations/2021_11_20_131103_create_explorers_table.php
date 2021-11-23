<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExplorersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explorers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id');
            $table->timestamps();
        });
        DB::table('explorers')->insert(['name' => 'World', 'parent_id' => 0]);
        DB::table('explorers')->insert(['name' => 'Europa', 'parent_id' => 1]);
        DB::table('explorers')->insert(['name' => 'Afryka', 'parent_id' => 1]);
        DB::table('explorers')->insert(['name' => 'Polska', 'parent_id' => 2]);
        DB::table('explorers')->insert(['name' => 'Niemcy', 'parent_id' => 2]);
        DB::table('explorers')->insert(['name' => 'Warszawa', 'parent_id' => 4]);
        DB::table('explorers')->insert(['name' => 'Berlin', 'parent_id' => 5]);
        DB::table('explorers')->insert(['name' => 'Monachium', 'parent_id' => 5]);
        DB::table('explorers')->insert(['name' => 'Kraków', 'parent_id' => 4]);
        DB::table('explorers')->insert(['name' => 'Gdańsk', 'parent_id' => 4]);



    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('explorers');
    }
}
