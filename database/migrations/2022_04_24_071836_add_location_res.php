<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationRes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_rs', function (Blueprint $table) {
            $table->string('rumah_sakit_id');
            $table->string('description_id');
            $table->string('rumah_sakit_en');
            $table->string('description_en');
            $table->string('rumah_sakit_cn');
            $table->string('description_cn');
            $table->string('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
