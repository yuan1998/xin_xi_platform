<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bd_apps', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('应用名称');
            $table->string('app_id')->comment('APP ID');
            $table->string('app_secret')->comment('APP 秘钥');
            $table->unsignedInteger('version')->comment('APP 接口版本')->default(1);
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
        Schema::dropIfExists('bd_apps');
    }
}
