<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('contact_forms', function (Blueprint $table) {
        $table->string('message_title')->nullable(); // أو بدون nullable لو إلزامي
    });
}

public function down()
{
    Schema::table('contact_forms', function (Blueprint $table) {
        $table->dropColumn('message_title');
    });
}

};
