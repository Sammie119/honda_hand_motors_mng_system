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
        Schema::create('monthly_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->integer('stock');
            $table->decimal('price', 12, 2);
            $table->date('mdate');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        DB::statement("INSERT INTO `monthly_stocks`(`item`, `stock`, `price`, `mdate`, `status`) VALUES ('Item','0','0.00',now(),'0')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_stocks');
    }
};
