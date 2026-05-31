<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('announcements', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->string('type')->default('indigo'); // Renk kodlaması için (indigo, rose, emerald)
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
