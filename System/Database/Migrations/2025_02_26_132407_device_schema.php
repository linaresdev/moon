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
        Schema::create('devices', function (Blueprint $table)
        {
            $table->id();

            $table->string("type", 30)->default("Equipo de trabajo");
            $table->string("name", 60);
            $table->text("description")->nullable();

            $table->string("servitag", 45)->nullable();

            $table->string("model", 80);
            $table->string("serial", 100);

            $table->string("ip", 20)->nullable();

            $table->string("number", 20)->nullable();

            $table->string("macIPV4", 24)->nullable();
            $table->string("macIPV6", 30)->nullable();

            $table->text("meta")->nullable();

            $table->char("activated", 1)->default(1);
            
            $table->timestamps();
        });

        Schema::create('deviceables', function (Blueprint $table)
        {
            $table->id();

            $table->string("deviceable_type", 255);
            $table->unsignedBigInteger("deviceable_id");

            $table->unsignedBigInteger("device_id");
            $table->foreign("device_id")->references("id")->on("devices")->onDelete("cascade");
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deviceables');
        Schema::dropIfExists('devices');
    }
};
