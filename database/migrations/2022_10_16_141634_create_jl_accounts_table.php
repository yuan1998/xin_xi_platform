<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJlAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jl_accounts', function (Blueprint $table) {
            $table->id();
            $table->string("advertiser_id")->nullable();
            $table->string("advertiser_name")->nullable();
            $table->string("rebate")->nullable();
            $table->string("comment")->nullable();
            $table->string("log")->nullable();
            $table->unsignedBigInteger("app_id")->nullable();
            $table->string("token_id")->nullable();
            $table->integer("advertiser_role")->nullable();
            $table->boolean("enable")->default(1);
            $table->boolean("enable_robot")->default(0);
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
        Schema::dropIfExists('jl_accounts');
    }
}
