<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE_NAME = 'order_products';
    private const FIRST_FOREIGN_TABLE_NAME = 'products';
    private const SECOND_FOREIGN_TABLE_NAME = 'orders';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained(self::FIRST_FOREIGN_TABLE_NAME);
            $table->foreignId('order_id')->constrained(self::SECOND_FOREIGN_TABLE_NAME);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
