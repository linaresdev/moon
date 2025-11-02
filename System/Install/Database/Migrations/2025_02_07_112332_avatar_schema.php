<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avatars', function (Blueprint $table) 
        {
            $table->bigIncrements("id");

            $table->string("avatable_type", 255);
            $table->unsignedBigInteger("avatable_id");

            $table->string("name", 200)->nullable();
            $table->text("url");

            $table->char("activated", 1)->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avatars');
    }
};
