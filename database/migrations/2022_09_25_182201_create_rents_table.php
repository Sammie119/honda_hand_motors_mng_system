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
        Schema::create('rents_episodes', function (Blueprint $table) {
            $table->id('rent_id');
            $table->bigInteger('master_id');
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->string('month_year', 20);
            $table->date('rent_date');
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('rents_episodes');
    }
};
