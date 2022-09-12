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
        Schema::create('Item', function (Blueprint $table) {
            $table->unsignedBigInteger('id', false)->primary();
            $table->unsignedInteger("length")->comment("長さ");
            $table->unsignedInteger("width")->comment("幅");
            $table->unsignedInteger("thickness")->comment("厚み");
            $table->string("raw_wood_size",100)->comment("原木サイズ");
            $table->foreignId("warehouse_id")->comment("倉庫ID")->constrained('Warehouse');
            $table->string("warehouse_name",50)->comment("倉庫名");
            $table->string("memo",255)->comment("摘要");
            $table->unsignedInteger("quantity")->comment("数量");
            $table->unsignedInteger("essential_quantity")->comment("基準数量");
            $table->foreignId("unit_id")->comment("単位ID")->constrained('Unit');
            $table->string("unit_name",10)->comment("単位名");
            $table->foreignId("wood_species_id")->comment("樹種ID")->constrained('WoodSpecies');
            $table->string("wood_species_name",100)->comment("樹種名");
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
        Schema::dropIfExists('Item');
    }
};
