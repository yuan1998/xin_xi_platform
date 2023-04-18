<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJlAccountTableChangeLogFieldType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jl_accounts', function (Blueprint $table) {
            $table->text('run_status_log')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jl_accounts', function (Blueprint $table) {
            $table->string('run_status_log')->nullable()->change();
        });
    }
}
