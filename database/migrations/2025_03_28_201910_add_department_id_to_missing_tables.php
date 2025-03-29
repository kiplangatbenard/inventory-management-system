<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gadget_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('user_id');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('user_id');
        });

        Schema::table('gadget_allocations', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('gadget_requests', function (Blueprint $table) {
            $table->dropColumn('department_id');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->dropColumn('department_id');
        });

        Schema::table('gadget_allocations', function (Blueprint $table) {
            $table->dropColumn('department_id');
        });
    }
};
