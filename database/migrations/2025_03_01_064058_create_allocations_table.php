<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gadget_id')->constrained()->onDelete('cascade'); // References gadgets table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // References users table
            $table->enum('status', ['pending', 'approved', 'returned'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('allocations');
    }
};
