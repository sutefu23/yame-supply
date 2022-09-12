<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OutStockInfo', function (Blueprint $table) {
            $table->id();
            $table->foreignId("builder_user_id")->nullable()->comment("工務店ユーザーID")->constrained('users');
            $table->foreignId("builder_user_name",100)->nullable()->comment("工務店名");
            $table->date("export_date")->comment("出庫日");
            $table->string("reason",255)->comment("理由");
            $table->foreignId("create_user_id")->comment("登録者")->constrained('users');
            $table->foreignId("update_user_id")->comment("変更者")->constrained('users');
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
        Schema::dropIfExists('OutStockInfo');
    }
};