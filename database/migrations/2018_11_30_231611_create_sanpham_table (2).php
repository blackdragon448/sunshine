<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('sp_ma')->comment('ma san pham');
            $table->string('sp_ten', 191)->comment('ten san pham');
            $table->unsignedInteger('sp_giaGoc')->default('0')->commnet('gia goc san pham');
            $table->unsignedInteger('sp_giaBan')->default('0')->commnet('gia ban san pham');
            $table->string('sp_hinh', 200)->comment('hinh dai dien san pham');
            $table->text('sp_thongTin')->comment('thong tin san pham');
            $table->string('sp_danhGia', 50)->default('0;0;0;0;0')->comment('chat luong san pham:1 den 5 sao');
            $table->timestamp('sp_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('thoi gian tao moi san pham');
            $table->timestamp('sp_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('thoi gian cap nhat san pham');
            $table->tinyInteger('sp_trangThai')->default('2')->comment('trang thai san pham: 1-khoa, 2-kha dung');
            $table->unsignedTinyInteger('l_ma')->comment('ma loai san pham');

            $table->unique(['sp_ten']);
            $table->foreign('l_ma')->references('l_ma')->on('loai')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
        DB::statement("ALTER TABLE `sanpham` comment 'Sản phẩm # Sản phẩm: hoa, giỏ hoa, vòng hoa, ...'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sanpham');
    }
}


