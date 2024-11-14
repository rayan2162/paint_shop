<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // database/migrations/xxxx_xx_xx_create_orders_table.php

public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->string('company');
        $table->text('details')->nullable();
        $table->integer('quantity');
        $table->enum('status', ['pending', 'shipped', 'completed'])->default('pending');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
