<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('category')->nullable()->after('description'); // Eğitim türü
        $table->string('country')->nullable()->after('category');    // Ülke
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['category', 'country']);
    });
}
};
