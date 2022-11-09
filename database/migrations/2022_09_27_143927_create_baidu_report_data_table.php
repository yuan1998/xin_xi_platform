<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaiduReportDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baidu_report_data', function (Blueprint $table) {
            $table->id();
            $table->dateTime("date")->index(); //"2022-09-01"
            $table->string("userName")->index(); //"xa-hmtyn"
            $table->string("campaignName")->nullable(); //"A606-R61-209本地均衡商圈-优质视频合集-自定义-7.21-8.30FZ"
            $table->string("campaignId")->index(); //219741003
            $table->string("impression")->nullable(); //2345
            $table->string("click")->nullable(); //27
            $table->string("cost")->nullable(); //7.34
            $table->string("ctr")->nullable(); //0.011513859275053
            $table->string("cpc")->nullable(); //0.27185185185185
            $table->string("cpm")->nullable(); //3.1300639658849
            $table->string("aggrFormSubmitSuccess")->nullable(); //0
            $table->string("formSubmitCost")->nullable(); //0
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baidu_report_data');
    }
}
