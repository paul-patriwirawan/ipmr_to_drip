<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drip_ipmr_representative_terms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('representative_id');
            $table->string('term');
            $table->enum('status', ['SEATED', 'NOT SEATED']);
            $table->enum('benefits_received', ['FULL', 'PARTIAL', 'HONORARIA']);
            $table->date('date_of_selection');
            $table->string('coa_number')->nullable();
            $table->date('date_issued')->nullable();
            $table->date('end_of_term')->nullable();
            $table->timestamps();
            $table->date('date_appointed')->nullable();
            $table->string('source_of_funds')->nullable();
            $table->string('other_source')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drip_ipmr_representative_terms');
    }
};
