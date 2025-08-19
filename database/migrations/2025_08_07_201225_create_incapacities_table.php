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
        Schema::create('incapacities', function (Blueprint $table) {
            $table->id();
            $table->string('type_incapacity');
            $table->string('description_incapacity');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status');
            $table->foreignId('employee_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incapacities');
    }
};
