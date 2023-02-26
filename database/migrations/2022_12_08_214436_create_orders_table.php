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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedFloat('products_price', 10, 0);
            $table->string('status', 50)->default(0);
            $table->string('sku', 10);
            $table->unsignedFloat('shipping_cost', 8, 0)->nullable();
            $table->unsignedFloat('total_price', 10, 0);
            $table->string('tax_percent', 5)->nullable();
            $table->unsignedFloat('tax_price', 8, 0)->nullable();
            $table->string('delivery_person_name', 191);
            $table->string('delivery_person_phone_number', 191);
            $table->text('additional_note')->nullable();
            $table->enum('payment_method', ['online', 'COD']);
            $table->enum('step_delivery', ['order_placed','order_accepted','prepare', 'shipped', 'delivered'])->default('order_placed');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('CASCADE');
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
        Schema::dropIfExists('orders');
    }
};
