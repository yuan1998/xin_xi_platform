<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaiduAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baidu_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('token');
            $table->string('password');
            $table->integer('type')->default(0);
            $table->string('targets')->nullable();
            $table->integer('enable')->default(1);
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
        Schema::dropIfExists('baidu_accounts');
    }
}
