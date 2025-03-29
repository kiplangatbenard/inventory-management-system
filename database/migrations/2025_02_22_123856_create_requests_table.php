<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_type'); // e.g., allocation, return, issue, replacement
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // who made the request
            $table->foreignId('gadget_id')->nullable()->constrained()->onDelete('set null'); // gadget involved
            $table->text('description')->nullable(); // details of the request
            $table->string('status')->default('pending'); // e.g., pending, approved, rejected, resolved
            $table->string('priority')->default('medium'); // e.g., low, medium, high
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // admin/technician assigned
            $table->date('due_date')->nullable(); // due date for resolution
            $table->text('comments')->nullable(); // comments from admins or managers
            $table->string('attachment')->nullable(); // file path for attachments
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
}