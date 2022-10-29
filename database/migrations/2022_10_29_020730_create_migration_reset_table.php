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
        DB::statement("INSERT INTO `staff`(`name`, `position`, `mobile`, `address`, `created_at`, `updated_at`) VALUES 
                        ('Master welder','Associate Master','0243319194','None',now(),now()),
                        ('master Ansah','Associate Master','0244868906','None',now(),now()),
                        ('Master 1','Associate Master','0244952603','None',now(),now()),
                        ('Master 2','Associate Master','0243319195','None',now(),now()),
                        ('Master 3','Associate Master','0243236043','None',now(),now()),
                        ('Master 4','Associate Master','00','None',now(),now())");

        DB::statement("UPDATE rents_episodes, staff
                        SET rents_episodes.master_id = staff.staff_id
                        WHERE rents_episodes.contact = staff.mobile
                        AND rents_episodes.master_id = 0;");  

        DB::statement("ALTER TABLE `rents_episodes`
                        DROP `contact`;");

        DB::statement("UPDATE `rents_episodes` SET `month_year`=concat(`month_year`,', ',YEAR(`rent_date`))");
        
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
