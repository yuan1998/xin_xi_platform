<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTxAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tx_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('username')->comment("账户名");
            $table->string('account_id')->comment("账户ID");
            $table->string('access_token')->comment("账户Token");
            $table->string('refresh_token')->comment("刷新Token")->nullable();
            $table->integer('enable')->comment("是否启用")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tx_accounts');
    }
}
