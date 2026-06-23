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
        Schema::create('comments', function (Blueprint $table) 
        {
            $table->bigIncrements("id");
            
            $table->string("commentable_type", 255);
            $table->unsignedBigInteger("commentable_id");

            $table->unsignedBigInteger("author_id")->default(0);
            $table->unsignedBigInteger("parent")->default(0);

            $table->string("type", 50)->default("comment");

            $table->text("body");

            $table->char("state", 1)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
