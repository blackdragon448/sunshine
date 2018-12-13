<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->unsignedTinyInteger('l_ma')->autoIncrement()->comment('ma loai san pham');
            $table->string('l_ten', 50)->comment('ten loai san pham');
            $table->timestamp('l_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('thoi diem tao moi loai sp');
            $table->timestamp('l_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('thoi diem cap nhat moi loai sp');
            $table->tinyInteger('l_trangThai')->default('2')->comment('trang thai loai:1-khoa, 2-kha dung');
            $table->unique(['l_ten']);
        });
        DB::statement("ALTER TABLE `loai` comment 'loai san pham' ");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('loai');
    }
}
