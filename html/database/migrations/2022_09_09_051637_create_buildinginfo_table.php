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
        Schema::create('BuildingInfo', function (Blueprint $table) {
            $table->id();
            $table->string("field_name",255)->comment("現場名");
            $table->foreignId("builder_user_id")->comment("工務店ユーザーID")->constrained('users');
            $table->date("time_limit")->comment("期限");
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
        Schema::dropIfExists('BuildingInfo');
    }
};
