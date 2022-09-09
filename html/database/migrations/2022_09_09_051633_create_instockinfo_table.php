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
        Schema::create('InStockInfo', function (Blueprint $table) {
            $table->id();
            $table->foreignId("produce_user_id")->comment("製材所ユーザーID")->constrained('users');
            $table->string("produce_user_name",100)->comment("製材所名");
            $table->date("import_date")->comment("入庫日");
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
        Schema::dropIfExists('InStockInfo');
    }
};
