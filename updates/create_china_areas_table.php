<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChinaAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('china_areas', function (Blueprint $table) {
            $table->id('code');
            $table->string('name')->comment('地区');
            $table->unsignedTinyInteger('level')->index();
            $table->unsignedBigInteger('parent_code')->index()->comment('上级区划');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('china_areas');
    }
}
