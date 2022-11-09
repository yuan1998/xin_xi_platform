<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTxReportDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tx_report_data', function (Blueprint $table) {
            $table->id();
            $table->dateTime("date")->comment("日期")->index()->nullable();
            $table->string("account_id")->comment("账户ID")->index()->nullable();
            $table->string("view_count")->comment("曝光")->nullable();
            $table->string("valid_click_count")->comment("点击量")->nullable();
            $table->string("ctr")->comment("点击率")->nullable();
            $table->string("cpc")->comment("点击均价")->nullable();
            $table->string("cost")->comment("消费")->nullable();
            $table->string("page_reservation_count")->comment("表单预约量")->nullable();
            $table->string("page_reservation_cost")->comment("表单预约成本(次数)")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tx_report_data');
    }
}
