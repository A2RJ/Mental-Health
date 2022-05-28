<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationRsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_rs', function (Blueprint $table) {
            $table->unsignedBigInteger('rs_id')->primary();
            $table->string('rumah_sakit_id');
            $table->text('description_id');
            $table->string('rumah_sakit_en');
            $table->text('description_en');
            $table->string('rumah_sakit_cn');
            $table->text('description_cn');
            $table->string('website')->nullable();
            $table->bigInteger('province_id');
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
        Schema::dropIfExists('location_rs');
    }
}
