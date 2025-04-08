<?php

// database/migrations/xxxx_xx_xx_create_gadget_returns_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGadgetReturnsTable extends Migration
{
    public function up()
    {
        Schema::create('gadget_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('gadget_id')->constrained()->onDelete('cascade');
            $table->string('reason')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gadget_returns');
    }
}

