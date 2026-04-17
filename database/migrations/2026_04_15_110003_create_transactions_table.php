<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['deposit', 'withdrawal', 'profit', 'referral']);
            $table->enum('category', ['crypto', 'stocks', 'realestate'])->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('currency')->default('USD');
            $table->string('wallet_address')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('txn_hash')->nullable();
            $table->string('proof')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transactions');
    }
};