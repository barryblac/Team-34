<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTshirtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tshirts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('maat');
            $table->string('geslacht');
        });
        // Insert roles
        DB::table('tshirts')->insert(
            [
                [
                    'id' => 1,
                    'maat' => "XL",
                    'geslacht' => 'V'
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tshirts');
    }
}
