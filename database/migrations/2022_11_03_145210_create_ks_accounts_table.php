<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ks_accounts', function (Blueprint $table) {
            $table->id();
            $table->boolean("enable")->default(1)->comment('启用');
            $table->unsignedBigInteger("app_id")->comment('APP ID');
            $table->dateTime("run_date")->nullable()->comment('上次运行日期');
            $table->integer("run_status")->nullable()->comment('上次运行状态');
            $table->string("run_status_log")->nullable()->comment('上次运行日志');
            $table->string("comment")->nullable()->comment('备注');
            $table->string("token_id")->nullable()->comment('TOKEN');//2116534399
            $table->string("advertiser_id")->index()->nullable()->comment('广告主ID');//2116534399
            $table->string("user_id")->nullable()->comment('用户ID');//2116534399
            $table->string("corporation_name")->nullable()->comment('资质公司');//"重庆团圆口腔医院有限公司"
            $table->string("user_name")->nullable()->comment('用户名称');//"西安团圆口医院"
            $table->string("industry_id")->nullable()->comment('二级行业 id');//1216
            $table->string("industry_name")->nullable()->comment('二级行业名称');//"医疗机构"
            $table->string("primary_industry_id")->nullable()->comment('一级行业 id');//1017
            $table->string("primary_industry_name")->nullable()->comment('一级行业名称');//"医疗"
            $table->string("delivery_type")->nullable()->comment('交货类型');//null
            $table->string("effect_first")->nullable()->comment('效果第一');//null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ks_accounts');
    }
}
