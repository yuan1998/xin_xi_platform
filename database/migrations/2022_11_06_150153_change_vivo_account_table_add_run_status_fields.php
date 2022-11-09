<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVivoAccountTableAddRunStatusFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vivo_accounts', function (Blueprint $table) {
            $table->integer('run_status')->nullable();
            $table->string('run_status_log')->nullable();
            $table->dateTime('run_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vivo_accounts', function (Blueprint $table) {
            $table->dropColumn('run_status');
            $table->dropColumn('run_status_log');
            $table->dropColumn('run_date');
        });
    }
}
