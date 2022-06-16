<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* 存在する場合、同名テーブルをドロップ */
        Schema::dropIfExists('follows');

        /* 新たな定義でテーブル作成 */
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('follower_id');
            $table->integer('followee_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('follows');

        /* 旧定義でテーブル作成(dawnSNS-Laravel-6.20.43_v2) */
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('follower_id'); // フォローをする側のユーザーID
            $table->integer('followee_id'); // フォローをされる側のユーザーID
            $table->timestamp('created_at')->useCurrent();
        });
    }
}
