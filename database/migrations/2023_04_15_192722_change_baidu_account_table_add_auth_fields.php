<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBaiduAccountTableAddAuthFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('baidu_accounts', function (Blueprint $table) {
            // masterUId , accessToken , refreshToken , expires , refExpires , authType, userAcctType
            $table->string('masterUId')->comment('用户ID')->nullable();
            $table->text('accessToken')->comment('令牌')->nullable();
            $table->text('refreshToken')->comment('刷新令牌')->nullable();
            $table->json('subUserList')->comment('子用户')->nullable();
            $table->dateTime('expires')->comment('临牌过期时间')->nullable();
            $table->dateTime('refExpires')->comment('刷新临牌过期时间')->nullable();
            $table->unsignedInteger('authType')->comment('账号授权类型(区分新旧')->default(0);
            $table->unsignedInteger('app_id')->comment('app_id')->nullable();

            $table->string('token')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
    43888537,46003956,46003969,
    }
    ]
     * @return void
     */
    public function down()
    {
        Schema::table('baidu_accounts', function (Blueprint $table) {
            $table->dropColumn('accessToken');
            $table->dropColumn('masterUId');
            $table->dropColumn('refreshToken');
            $table->dropColumn('expires');
            $table->dropColumn('refExpires');
            $table->dropColumn('authType');
            $table->dropColumn('app_id');
            $table->dropColumn('subUserList');
            $table->string('token')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
        });
    }
}
