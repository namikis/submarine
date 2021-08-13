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
        Schema::create('users',function(Blueprint $table) {
            // $sql = "
            //     create table `users`(
            //         `id` int(11) unsigned not null auto_increment,
            //         `user_name` varchar(255) not null,
            //         `email` varchar(255) not null,
            //         `password` varchar(255) not null,
            //         `create_date` datetime null default current_timestamp,
            //         primary key(`user_id`),
            //         unique(`email`));
            // ";
            // DB::connection()->getPdo()->exec($sql);

            $table->increments('id');
            $table->string('user_name');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
            $table->unique('email');

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
