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
        Schema::table('OutStockInfo', function (Blueprint $table) {
            $table->foreignId("building_info_id")->nullable()->constrained()->after('reason')->comment("棟情報ID");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('OutStockInfo', function (Blueprint $table) {
            $table->dropColumn('building_info_id');
        });
    }
};
