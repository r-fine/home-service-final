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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('cascade');
            $table->boolean('is_ordered')->nullable()->default(false);
            $table->string('status')->nullable()->default('Pending');
            $table->boolean('is_reviewable')->nullable()->default(false);
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
        Schema::dropIfExists('order_items');
    }
};
