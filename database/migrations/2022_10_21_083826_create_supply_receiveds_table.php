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
        Schema::create('supplies_received', function (Blueprint $table) {
            $table->id('supply_id');
            $table->bigInteger('supplier_id');
            $table->bigInteger('item_id');
            $table->integer('old_stock');
            $table->integer('new_stock');
            $table->decimal('amount', 12, 2);
            $table->decimal('paid', 12, 2);
            $table->integer('receipt_no');
            $table->date('sup_date');
            $table->bigInteger('supply_no');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE supplies_received
            CHANGE receipt_no receipt_no INT(10) UNSIGNED ZEROFILL NOT NULL
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplies_received');
    }
};
