<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBaiduReportDataTableAddReportTypeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('baidu_report_data', function (Blueprint $table) {
            $table->string('report_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('baidu_report_data', function (Blueprint $table) {
            $table->dropColumn('report_type');
        });
    }
}
