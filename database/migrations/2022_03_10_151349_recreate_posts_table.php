<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* 存在する場合、同名テーブルをドロップ */
        Schema::dropIfExists('posts');

        /* 新たな定義でテーブル作成 */
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('user_id');
            $table->string('post',500);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* 存在する場合、同名テーブルをドロップ */
        Schema::dropIfExists('posts');

        /* 旧定義でテーブル作成(dawnSNS-Laravel-6.20.43_v2) */
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('user_id');
            $table->string('post', 500);
            $table->timestamps();
        });
    }
}
