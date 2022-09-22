<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('car_no', 10)->unique();
            $table->string('customer_name')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('car_model', 50)->nullable();
            $table->string('fuel', 50)->nullable();
            $table->string('customer_contact', 13)->nullable();
            $table->string('driver_contact', 13)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
