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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->unsignedBigInteger('from_branch_id');
            $table->unsignedBigInteger('to_branch_id');
            $table->decimal('amount', 10, 2);
            $table->json('sender_details')->nullable();
            $table->json('receiver_details')->nullable();
            $table->string('status');
            $table->text('notes')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->bigInteger('paid_by')->unsigned()->nullable();
            $table->foreign('from_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('to_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
