<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drip_ipmr', function (Blueprint $table) {
            $table->id();
            $table->string('ancestral_domain_id');
            $table->string('level_of_representation');
            $table->string('governance_body');
            $table->string('position_type');
            $table->text('area_of_responsibility');
            $table->string('region_code', 10);
            $table->string('province_code', 10);
            $table->string('municipality_code', 10);
            $table->string('barangay_code', 10);
            $table->string('lgu_represented_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drip_ipmr');
    }
};
