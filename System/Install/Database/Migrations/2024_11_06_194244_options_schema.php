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
        Schema::create('options', function ( Blueprint $table )
        {
            $table->id();

            $table->string("optionable_type", 255);
            $table->unsignedBigInteger("optionable_id");

            $table->string("key", 40);
            $table->string("value", 255);

            $table->boolean("activated")->default(1); 
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
