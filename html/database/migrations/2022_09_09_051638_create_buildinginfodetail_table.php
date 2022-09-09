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
            $table->unsignedInteger("build_info_id")->comment("棟情報ID");
            $table->foreignId("item_id")->comment("使用製材ID")->constrained('Item');
            $table->unsignedInteger("item_quantity")->comment("使用製材数");
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
