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
        Schema::create('provider_profiles', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_pic')->nullable()->default('500x500.png');
            $table->string('phone')->unique();
            $table->string('address_line');
            $table->string('address_line_2')->nullable();
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
        Schema::dropIfExists('provider_profiles');
    }
};
