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
        if( Schema::hasTable("users") )
        {
            Schema::table('users', function ( Blueprint $table )
            {
                $table->string('code', 20)->nullable()->after("id");
                $table->string('user', 20)->nullable()->after("email_verified_at");
                $table->char('activated', 1)->default(0)->after("password");
                $table->text('meta')->nullable()->after("remember_token");
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ## Schema::dropIfExists('users');

        Schema::table("users", function(Blueprint $table)
        {
            $table->dropColumn([
                "code",
                "activated",
                "meta"
            ]);
        });
    }
};
