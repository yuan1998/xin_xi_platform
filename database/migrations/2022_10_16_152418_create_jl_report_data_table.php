<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJlReportDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jl_report_data', function (Blueprint $table) {
            $table->id();
            $table->string("stat_datetime")->index()->comment("数据起始时间")->nullable();
            $table->string("ad_name")->comment("计划name")->nullable();
            $table->string("campaign_id")->index()->comment("广告组id")->nullable();
            $table->string("campaign_name")->comment("广告组name")->nullable();
            $table->string("ad_id")->index()->comment("计划id")->nullable();
            $table->string("show")->comment("展现数据-展示数")->nullable();
            $table->string("click")->comment("展现数据-点击数")->nullable();
            $table->string("cost")->comment("展现数据-总花费")->nullable();
            $table->string("ctr")->comment("展现数据-点击率")->nullable();
            $table->string("avg_click_cost")->comment("展现数据-平均点击单价")->nullable();

            $table->string("avg_show_cost")->comment("展现数据-平均千次展现费用")->nullable();
            $table->string("convert")->comment("转化数据-转化数")->nullable();
            $table->string("convert_cost")->comment("转化数据-转化成本")->nullable();
            $table->string("convert_rate")->comment("转化数据-转化率")->nullable();
            $table->string("form")->comment("落地页转化数据-表单提交")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jl_report_data');
    }
}
