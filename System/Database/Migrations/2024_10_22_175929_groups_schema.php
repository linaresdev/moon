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
        Schema::create('groups', function (Blueprint $table)
        {
            $table->id();
            
            $table->string("type", 100)->default("GR");
            
            $table->unsignedBigInteger("parent")->default(0);

            $table->string("slug", 100);

            $table->string("icon", 80)->default('mdi-google-circles-group');

            $table->string("name", 50);

            $table->string("description", 200)->nullable();

            $table->char("activated", 1)->default(1);

            $table->text("meta")->nullable();

            $table->timestamps();
        });

        Schema::create('groupables', function (Blueprint $table)
        {
            $table->id();

            $table->string("groupable_type", 255);
            $table->unsignedBigInteger("groupable_id");

            $table->unsignedBigInteger("group_id");
            $table->foreign("group_id")->references("id")->on("groups")->onDelete("cascade");
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupables');
        Schema::dropIfExists('groups');
    }
};
