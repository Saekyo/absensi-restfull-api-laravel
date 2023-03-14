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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender',['pria', 'wanita']);
            $table->string('email')->unique();
            $table->string('telp_number')->unique();
            $table->string('password');
            $table->enum('role',['admin', 'user']);
            $table->unsignedBigInteger('media_id');
            $table->timestamps();
            $table->rememberToken();

            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
 
    });
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
