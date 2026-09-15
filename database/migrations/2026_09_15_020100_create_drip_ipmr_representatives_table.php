<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drip_ipmr_representatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ipmr_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->enum('sex', ['Male', 'Female']);
            $table->unsignedBigInteger('ad_name');
            $table->enum('ip_type', ['Rightsholder', 'Migrant']);
            $table->string('ip_group');
            $table->text('complete_address');
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_current')->default(true);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->date('birthdate')->nullable();
            $table->string('image_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drip_ipmr_representatives');
    }
};
