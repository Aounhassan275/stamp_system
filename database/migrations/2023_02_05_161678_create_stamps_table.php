<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamps', function (Blueprint $table) {
            $table->id();
            $table->string('stamp_id')->nullable();
            $table->string('type')->nullable();
            $table->string('amount')->nullable();
            $table->string('applicant')->nullable();
            $table->string('guardian_type')->nullable();
            $table->string('guardian')->nullable();
            $table->string('agent')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('issue_date')->nullable();
            $table->date('validity_date')->nullable();
            $table->string('amount_in_words')->nullable();
            $table->string('reason')->nullable();
            $table->foreignId('description_id')->nullable();
            $table->foreign('description_id')->references('id')->on('descriptions')->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stamps');
    }
}
