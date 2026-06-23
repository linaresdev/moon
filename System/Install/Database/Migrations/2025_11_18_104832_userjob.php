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
        Schema::create('userjobs', function (Blueprint $table) 
        {
            $table->bigIncrements("id");

            $table->string("type", 30)->default("getmembership");

            $table->string("email", 80);

            $table->string("subject", 255);

            $table->string("zip", 100)->nullable();

            $table->text("meta")->nullable();

            $table->index(["type","email"]);

            $table->char("activated", 1)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userjobs');
    }
};
