<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBooksTableForChecklist extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'accession_no')) {
                $table->string('accession_no')->after('title');
            }
            if (!Schema::hasColumn('books', 'call_no')) {
                $table->string('call_no')->after('accession_no');
            }
            if (!Schema::hasColumn('books', 'supplier')) {
                $table->string('supplier')->after('call_no');
            }
            if (!Schema::hasColumn('books', 'date_received')) {
                $table->timestamp('date_received')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_collated')) {
                $table->timestamp('date_collated')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_stamped')) {
                $table->timestamp('date_stamped')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_accessioned')) {
                $table->timestamp('date_accessioned')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_catalogued')) {
                $table->timestamp('date_catalogued')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_labeled')) {
                $table->timestamp('date_labeled')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_tagging')) {
                $table->timestamp('date_tagging')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_book_pocket')) {
                $table->timestamp('date_book_pocket')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_book_card')) {
                $table->timestamp('date_book_card')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_collation_slip')) {
                $table->timestamp('date_collation_slip')->nullable();
            }
            if (!Schema::hasColumn('books', 'date_cover')) {
                $table->timestamp('date_cover')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'accession_no',
                'call_no',
                'supplier',
                'date_received',
                'date_collated',
                'date_stamped',
                'date_accessioned',
                'date_catalogued',
                'date_labeled',
                'date_tagging',
                'date_book_pocket',
                'date_book_card',
                'date_collation_slip',
                'date_cover',
            ]);
        });
    }
}
