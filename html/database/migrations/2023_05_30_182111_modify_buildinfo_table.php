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
        Schema::table('BuildingInfo', function (Blueprint $table) {
            $table->date("export_fix_date")->default('1999-01-01')->comment("出荷確定")->after('export_expected_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('BuildingInfo', function (Blueprint $table) {
            $table->dropColumn("export_fix_date");
        });
    }
};
