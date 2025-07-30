<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('accession_no')->unique();
            $table->string('call_no');
            $table->string('supplier');
            $table->string('barcode')->unique()->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('available_quantity')->default(1);
            
            // Processing checklist timestamps
            $table->timestamp('date_received')->nullable();
            $table->timestamp('date_collated')->nullable();
            $table->timestamp('date_stamped')->nullable();
            $table->timestamp('date_accessioned')->nullable();
            $table->timestamp('date_catalogued')->nullable();
            $table->timestamp('date_labeled')->nullable();
            $table->timestamp('date_tagging')->nullable();
            $table->timestamp('date_book_pocket')->nullable();
            $table->timestamp('date_book_card')->nullable();
            $table->timestamp('date_collation_slip')->nullable();
            $table->timestamp('date_cover')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};