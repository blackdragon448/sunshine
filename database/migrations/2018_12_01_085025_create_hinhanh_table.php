<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHinhanhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hinhanh', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->unsignedBigInteger('sp_ma')->comment('ma san pham');
            $table->unsignedTinyInteger('ha_stt')->default('1')->comment('so thu tu hinh');
            $table->string('ha_ten', 150)->comment('ten hinh anh san pham');
            $table->primary(['sp_ma', 'ha_stt']);
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham')->onDelete('CASCADE')->onUpdate('CASCADE');
           
        });
        DB::statement("ALTER TABLE `hinhanh` comment'hinh san pham' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hinhanh');
    }
}
