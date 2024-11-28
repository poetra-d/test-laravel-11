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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('name');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('major_id')->references('id')->on('majors')->onUpdate('cascade')->nullable();
            $table->bigInteger('academic_year_id')->references('id')->on('academic_years')->onUpdate('cascade')->nullable();
            $table->string('phone_number')->nullable();
            $table->tinyInteger('actived')->default(1);
            $table->timestamps();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->softDeletes();

            $table->foreign('major_id')->references('id')->on('majors')->onUpdate('cascade');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
