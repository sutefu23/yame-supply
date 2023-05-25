<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Item', function (Blueprint $table) {
            $table->unsignedInteger("defective_quantity")->comment("不良品");
            $table->unsignedInteger("manufacturing_quantity")->comment("乾燥中・製材中");
            $table->unsignedInteger("raw_wood_arrival_quantity")->comment("原木入荷");
            $table->unsignedInteger("raw_wood_arrangement_quantity")->comment("原木手配");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Item', function (Blueprint $table) {
            $table->dropColumn("defective_quantity");
            $table->dropColumn("manufacturing_quantity");
            $table->dropColumn("raw_wood_arrival_quantity");
            $table->dropColumn("raw_wood_arrangement_quantity");
        });
    }
};
