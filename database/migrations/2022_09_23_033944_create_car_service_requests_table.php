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
        Schema::create('car_service_requests', function (Blueprint $table) {
            $table->id('service_id');
            $table->bigInteger('customer_id');
            $table->string('car_no', 10);
            $table->text('fault');
            $table->json('item_in_car');
            $table->text('other_item_car')->nullable();
            $table->decimal('ser_charge', 12, 2)->default(0.00);
            $table->string('engineer')->nullable();
            $table->decimal('amount_paid', 12,2)->default(0.00);
            $table->decimal('balance', 12,2)->default(0.00);
            $table->date('service_date');
            $table->integer('receipt_no');
            $table->bigInteger('service_no');
            $table->tinyInteger('status')->default(0);
            $table->integer('user');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE car_service_requests CHANGE receipt_no receipt_no INT(10) UNSIGNED ZEROFILL NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_service_requests');
    }
};
