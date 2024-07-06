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
        Schema::create('property_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Property::class);
            $table->string('url');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->integer('display_order')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_pictures');
    }
};
