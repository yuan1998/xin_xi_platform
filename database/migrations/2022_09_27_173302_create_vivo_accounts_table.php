<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVivoAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vivo_accounts', function (Blueprint $table) {
            $table->id();
            $table->string("username")->comment("账户名"); // "西安团圆口腔医院有限公司",
            $table->string("uuid")->comment("账户ID"); // "3d7ab6512302f842ba26",
            $table->string("access_token")->comment("Token"); // "a98182d249039f8d80bbaf109dc9e787d8fe3af85ff1fc715065e27c3e31b8b7",
            $table->string("refresh_token")->comment("刷新Token"); // "68cff33cecf5c8c471c4167f8904d602177d23a0609b65c5ee0602338cf7bec9",
            $table->string("token_date")->comment("Token过期时间"); // "2023/05/08"
            $table->integer('enable')->default(1)->comment("是否启用");

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
        Schema::dropIfExists('vivo_accounts');
    }
}
