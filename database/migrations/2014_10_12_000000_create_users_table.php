<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        }); */
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_strava');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('points')->default('0');
            $table->integer('gold_medals')->default('0');
            $table->integer('silver_medals')->default('0');
            $table->integer('bronze_medals')->default('0');
            $table->string('role')->default('runner');
            $table->string('why_run')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
}
