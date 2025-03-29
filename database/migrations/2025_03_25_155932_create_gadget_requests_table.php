<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('gadget_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference users
            $table->foreignId('gadget_id')->nullable()->constrained('gadgets')->onDelete('set null'); // Reference gadgets
            $table->string('gadget_type'); // Type of gadget (Laptop, Phone, etc.)
            $table->text('reason'); // User's reason for requesting
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Approval status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gadget_requests');
    }
};
