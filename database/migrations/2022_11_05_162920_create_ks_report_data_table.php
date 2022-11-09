<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKsReportDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ks_report_data', function (Blueprint $table) {
            $table->id();
            $table->string("advertiser_id")->index()->comment("广告主ID");
            $table->dateTime("stat_date")->index()->comment("数据日期");
            $table->string("charge")->nullable()->comment("花费（元）");
            $table->string("show")->nullable()->comment("封面曝光数");
            $table->string("photo_click")->nullable()->comment("封面点击数");
            $table->string("aclick")->nullable()->comment("素材曝光数");
            $table->string("bclick")->nullable()->comment("行为数");
            $table->string("photo_click_ratio")->nullable()->comment("封面点击率");
            $table->string("action_ratio")->nullable()->comment("行为率");
            $table->string("impression_1k_cost")->nullable()->comment("平均千次曝光花费（元）");
            $table->string("photo_click_cost")->nullable()->comment("平均点击单价（元）");
            $table->string("action_cost")->nullable()->comment("平均行为单价（元）");
            $table->string("negative")->nullable()->comment("减少此类作品数");
            $table->string("submit")->nullable()->comment("提交按钮点击数（历史字段，同下方“表单提交数”，预计年底删除该字段）");
            $table->string("form_count")->nullable()->comment("落地页数据-表单提交数");
            $table->string("form_cost")->nullable()->comment("落地页数据-表单提交单价");
            $table->string("form_action_ratio")->nullable()->comment("落地页数据-表单提交点击率");
            $table->string("event_jin_jian_landing_page")->nullable()->comment("落地页数据-落地页完件数");
            $table->string("event_jin_jian_landing_page_cost")->nullable()->comment("落地页数据-落地页完件成本");
            $table->string("event_valid_clues")->nullable()->comment("落地页数据-有效线索数");
            $table->string("event_valid_clues_cost")->nullable()->comment("落地页数据-有效线索成本");
            $table->string("event_add_wechat")->nullable()->comment("微信复制数");
            $table->string("event_add_wechat_cost")->nullable()->comment("微信复制成本");
            $table->string("event_add_wechat_ratio")->nullable()->comment("微信复制率");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ks_report_data');
    }
}
