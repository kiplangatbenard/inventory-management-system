<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User reporting the issue
            $table->foreignId('gadget_id')->constrained()->onDelete('cascade'); // Gadget with issue
            $table->text('description');
            $table->enum('status', ['reported', 'in-progress', 'resolved'])->default('reported');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('issues');
    }
    
};
