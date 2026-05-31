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
    Schema::table('orders', function (Blueprint $table) {
        // 0: Bekliyor, 1: Tedarik, 2: Hazırlanıyor, 3: Kargo, 4: Yolda, 5: Teslim Edildi
        $table->integer('status_level')->default(0)->after('price');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
