<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Add back the old columns
            $table->string('author')->nullable()->after('title');
            $table->string('isbn')->nullable()->after('author');
            $table->text('description')->nullable()->after('available_quantity');
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['author', 'isbn', 'description']);
        });
    }
};