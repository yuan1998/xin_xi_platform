<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOppoAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oppo_accounts', function (Blueprint $table) {
            $table->id();
            $table->string("username"); //"SMBHZ-画美团圆5-XXL",
            $table->string("owner_id"); //1000127787,
            $table->string("api_id"); //"0c824a06fac143fb8668f29442240d62",
            $table->string("api_key"); //"0e670d002d1a4a8589f4ccc279a37b5c"
            $table->integer("enable")->default(1); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oppo_accounts');
    }
}
