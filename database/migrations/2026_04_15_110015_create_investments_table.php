<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('package_id'); // No foreign key constraint
            $table->enum('category', ['crypto', 'stocks', 'realestate']);
            $table->decimal('amount', 15, 2);
            $table->decimal('roi_percent', 5, 2);
            $table->decimal('profit_earned', 15, 2)->default(0);
            $table->integer('duration_days');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('investments');
    }
};