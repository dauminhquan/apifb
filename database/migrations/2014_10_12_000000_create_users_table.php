<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string("avatar")->default("https://scontent.fhan3-1.fna.fbcdn.net/v/t1.0-9/43031884_999801423524108_369613155938074624_n.jpg?_nc_cat=109&_nc_ht=scontent.fhan3-1.fna&oh=4d70be2a6b0809658dea6d4d551d24e8&oe=5C812A20");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
