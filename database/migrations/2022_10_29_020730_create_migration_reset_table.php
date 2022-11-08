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
        DB::statement("ALTER TABLE `expenditures` ADD `engineer` VARCHAR(255) NULL AFTER `amount`, 
                                                ADD `car_no` VARCHAR(11) NULL AFTER `engineer`;");

        DB::statement("ALTER TABLE `car_service_requests` ADD `received_by` VARCHAR(255) NULL AFTER `receipt_no`");

        // DB::statement("UPDATE `rents_episodes` SET `month_year`=concat(`month_year`,', ',YEAR(`rent_date`))");
        
        // DB::statement("");  
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('migrations')->where('migration', '2022_10_29_020730_create_migration_reset_table')->delete();
        // DB::delete("DELETE FROM migrations WHERE migration = ?, ['2022_10_29_020730_create_migration_reset_table']");
    }
    
};
