<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* 存在する場合、同名テーブルをドロップ */
        Schema::dropIfExists('users');

        /* 新たな定義でテーブル作成 */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('name',255);
            $table->string('email',255);
            $table->string('password',255);
            $table->string('bio',400)->nullable();
            $table->string('image',255)->default('dawn.png')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('users');

        /* 旧定義でテーブル作成(dawnSNS-Laravel-6.20.43_v2) */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->string('bio', 400)->default('自己紹介を書いてみんなに自分をアピールしよう！')->nullable();
            $table->string('image')->default('dawn.png')->nullable();
            $table->timestamps();
        });
    }
}
