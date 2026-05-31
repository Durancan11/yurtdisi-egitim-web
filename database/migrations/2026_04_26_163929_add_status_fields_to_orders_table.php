<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('price');
            $table->string('shipping_stage')->nullable()->after('status');
            $table->boolean('is_cancelled')->default(false)->after('shipping_stage');
            $table->boolean('is_delivered_by_user')->default(false)->after('is_cancelled');
            $table->timestamp('approved_at')->nullable()->after('is_delivered_by_user');
            $table->timestamp('cancelled_at')->nullable()->after('approved_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'shipping_stage',
                'is_cancelled',
                'is_delivered_by_user',
                'approved_at',
                'cancelled_at'
            ]);
        });
    }
};