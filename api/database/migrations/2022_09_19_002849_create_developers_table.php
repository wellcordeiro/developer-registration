<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained();
            $table->string('email')->unique();
            $table->string('name');
            $table->char('gender');
            $table->string('hobby')->nullable();
            $table->date('birthdate');
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
        Schema::table('developers', function (Blueprint $table) {
            $table->dropForeign('developers_level_id_foreign');
        });
        Schema::dropIfExists('developers');
    }
};
