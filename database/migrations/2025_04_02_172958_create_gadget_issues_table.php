<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_gadget_issues_table.php
public function up()
{
    Schema::create('gadget_issues', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('gadget_id')->constrained()->onDelete('cascade');
        $table->string('issue_title');
        $table->text('issue_description');
        $table->enum('status', ['Pending', 'Resolved'])->default('Pending');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('gadget_issues');
}
};