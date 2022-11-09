<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUcReportDatumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uc_report_data', function (Blueprint $table) {
            $table->id();
            $table->string("date")->index()->comment("日期"); //"20220701"
            $table->string("account_id")->nullable()->comment("账户ID"); //"210689979"
            $table->string("account_name")->nullable()->comment("账户"); //"UC信息流-团圆口腔医院2"
            $table->string("campaign_id")->index()->comment("推广组ID"); //"119259762"
            $table->string("campaign_name")->nullable()->comment("推广组"); //"A704-R61-uc种植-6.30-客服建"
            $table->string("campaign_type")->nullable()->comment("推广对象"); //"网站"
            $table->string("impression")->nullable()->comment("展现数"); //"7015"
            $table->string("click")->nullable()->comment("点击数"); //"24"
            $table->string("cost")->nullable()->comment("消费"); //"6.23"
            $table->string("ctr")->nullable()->comment("点击率"); //"0.34%"
            $table->string("cpc")->nullable()->comment("点击均价"); //"0.26"
            $table->string("cpm")->nullable()->comment("千次展现均价"); //"0.89"
            $table->string("transfer")->nullable()->comment("转化类型"); //"-"
            $table->string("td")->nullable()->comment("转化数（回传时间）"); //"0"
            $table->string("td_rate")->nullable()->comment("转化率（回传时间）"); //"0.00%"
            $table->string("td_cost")->nullable()->comment("转化成本（回传时间）"); //"0.00"
            $table->string("tc")->nullable()->comment("转化数（点击时间）"); //"0"
            $table->string("tc_rate")->nullable()->comment("转化率（点击时间）"); //"0.00%"
            $table->string("tc_cost")->nullable()->comment("转化成本（点击时间）"); //"0.00"
            $table->string("tc_type")->nullable()->comment("深度转化类型"); //"-"

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uc_report_data');
    }
}
