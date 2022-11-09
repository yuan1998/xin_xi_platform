<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVivoReportDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vivo_report_data', function (Blueprint $table) {
            $table->id();
            $table->string("showCount")->nullable()->comment("显示计数"); // 54305
            $table->dateTime("reportDate")->index()->comment("日期"); // 20220922

            $table->string("formsubmitCount")->nullable()->comment("表单提交计数"); // 5
            $table->string("clickCount")->nullable()->comment("点击数"); // 1696

            $table->string("buttonClick")->nullable()->comment("按钮点击"); // 0
            $table->string("spent")->nullable()->comment("消费"); // 772.39974
            $table->string("advertiserId")->index()->comment("广告主ID"); // "e7ccc2f852e8c514523e"

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vivo_report_data');
    }
}
