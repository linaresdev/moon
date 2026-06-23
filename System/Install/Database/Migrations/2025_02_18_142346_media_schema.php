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
        Schema::create('medias', function (Blueprint $table)
        {
            $table->bigIncrements("id");
            
            $table->string("mediable_type", 255);
            $table->unsignedBigInteger("mediable_id");

            $table->string("type")->default("image");

            $table->text("description")->nullable();

            $table->text("url");

            $table->string("ext")->nullable();

            $table->boolean("activated")->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
