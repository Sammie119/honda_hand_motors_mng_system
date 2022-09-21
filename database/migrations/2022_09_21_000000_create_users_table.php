<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('mobile_no', 15);
            $table->string('user_level', 15);
            $table->string('department', 30);
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
            'name' => 'Samuel Sarpong-Duah',
            'username' => 'sam119',
            'mobile_no' => '0248376160',
            'user_level' => 'Super Admin',
            'department' => 'System Admin',
            'password' =>  Hash::make('sammie119'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
