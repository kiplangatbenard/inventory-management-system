<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // For user relationship
            $table->text('description'); // The activity description (e.g., "Reported an issue")
            $table->timestamps(); // Automatically adds created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_activities');
    }
}
