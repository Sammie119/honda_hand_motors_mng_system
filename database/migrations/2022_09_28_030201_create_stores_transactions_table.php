<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->integer('customer_id');
            $table->string('car_no', 10);
            $table->json('items');
            $table->json('quantity');
            $table->json('unit_price');
            $table->decimal('total_amount', 12,2);
            $table->decimal('amount_paid', 12,2);
            $table->integer('invoice_no');
            $table->integer('receipt_no');
            $table->date('transaction_date');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE stores_transactions
            CHANGE receipt_no receipt_no INT(10) UNSIGNED ZEROFILL NOT NULL,
            CHANGE invoice_no invoice_no INT(10) UNSIGNED ZEROFILL NOT NULL
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores_transactions');
    }
};
