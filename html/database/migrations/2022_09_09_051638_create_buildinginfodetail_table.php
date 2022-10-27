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
        Schema::create('BuildingInfoDetail', function (Blueprint $table) {
            $table->id();
            $table->foreignId("build_info_id")->comment("棟情報ID")->constrained('BuildingInfo');
            $table->foreignId("item_id")->comment("使用製材ID")->constrained('Item');
            $table->unsignedInteger("item_quantity")->comment("使用製材数");
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
        Schema::dropIfExists('BuildingInfoDetail');
    }
};
