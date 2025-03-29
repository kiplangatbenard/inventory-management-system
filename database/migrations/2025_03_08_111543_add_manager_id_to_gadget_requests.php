<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    //Schema::table('gadget_requests', function (Blueprint $table) {
        //$table->foreignId('manager_id')->after('gadget_id')->constrained('users')->onDelete('cascade');
    //});
    if (!Schema::hasColumn('gadget_requests', 'manager_id')) {
        Schema::table('gadget_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('manager_id')->after('gadget_id')->notNull();
        });
    }
}

public function down()
{
    Schema::table('gadget_requests', function (Blueprint $table) {
        $table->dropForeign(['manager_id']);
        $table->dropColumn('manager_id');
    });
}

};
