<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('contact_messages', function (Blueprint $table) {
        $table->text('message')->after('phone'); // Telefonun hemen sonrasına ekliyoruz
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            //
        });
    }
};
