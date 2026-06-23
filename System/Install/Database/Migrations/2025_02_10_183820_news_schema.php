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
        Schema::create('news', function (Blueprint $table)
        {
            $table->id();

            $table->string("newsable_type", 255);
            $table->unsignedBigInteger("newsable_id");

            $table->string("header")->default("info");

            $table->string("title", 255)->nullable();

            $table->text("meta");

            $table->char("activated",1)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
