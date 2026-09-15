<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drip_ipmr_representative_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('representative_id');
            $table->string('document_type');
            $table->string('document_name');
            $table->text('description')->nullable();
            $table->string('attachment_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drip_ipmr_representative_documents');
    }
};