<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBaiduAccountTableChangeTargetsFieldType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('baidu_accounts', function (Blueprint $table) {
            $table->text('targets')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('baidu_accounts', function (Blueprint $table) {
            $table->dropColumn('targets');
        });
    }
}
