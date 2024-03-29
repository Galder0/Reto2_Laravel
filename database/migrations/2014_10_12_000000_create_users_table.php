<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Surnames
     * DNI
     * Direction
     * Phone Number
     * ImageView
     * Cycle
     * Year
     * FCT/Dual
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('name');
            $table->string('surnames')->nullable();
            $table->string('DNI')->nullable();
            $table->string('email')->unique();
            $table->string('direction')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('fct_dual')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
