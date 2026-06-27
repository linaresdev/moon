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
        Schema::create('drivers', function (Blueprint $table)
        {
            $table->id();

            $table->integer("parent")->default(0);
            $table->string("type",50)->nullable();
            $table->string("token",75)->nullable();
            $table->string("file", 200)->unique();
            $table->char("align", 2)->default(0);
            $table->integer("counter")->default(0);

            $table->char("state", 1)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
