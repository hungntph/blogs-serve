<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->string('password', 225);
            $table->string('email', 225)->unique();
            $table->string('phone', 15)->nullable();
            $table->string('avatar', 225)->nullable();
            $table->boolean('gender')->default('0')->comment('0 = male, 1 = female');
            $table->tinyInteger('role')->default('0')->comment('0 = user, 1 = staff, 2 = admin');
            $table->tinyInteger('status')->default('0')->comment('0 = active, 1 = block, 2 = verify');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
