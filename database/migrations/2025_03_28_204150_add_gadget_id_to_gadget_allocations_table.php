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
    Schema::table('gadget_allocations', function (Blueprint $table) {
        $table->unsignedBigInteger('gadget_id')->nullable()->after('id');
        $table->foreign('gadget_id')->references('id')->on('gadgets')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('gadget_allocations', function (Blueprint $table) {
        $table->dropForeign(['gadget_id']);
        $table->dropColumn('gadget_id');
    });
}

};
