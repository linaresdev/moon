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
        Schema::create('posts', function (Blueprint $table) 
        {
            $table->bigIncrements('id');

            $table->string("postable_type", 255);
            $table->unsignedBigInteger("postable_id");

            $table->bigInteger("parent")->default(0);

            $table->string("type")->default("entry"); 
            // page|entry|article|news|exception
            
            $table->bigInteger("author")->nullable();
            
            $table->string("author_name")->nuallable();
            $table->string("author_email")->nullable();

            $table->string("title", 254)->nullable();
            
            $table->longText("body")->nullable();

            $table->text("share")->nullable();

            $table->char("state", 2)->default(0); 
            
            $table->string("visibility", 20)->default("public"); 
            // public/private/draf

            $table->string("password", 100)->nullable();

            $table->string("published_at", 15)->nullable();

            $table->integer("comment_state")->default(1);
            $table->integer("comment_counter")->default(0);

            $table->string("ip_address")->nullable();
            $table->text("user_agent")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
