<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_favorite', function (Blueprint $table) {
            // $sql = "
            //     create table user_favorite(
            //         `id` int(11) not null auto_increment,
            //         `user_id` int(11) not null,
            //         `content_id` int(11) not null,
            //         primary key(`id`)
            //     );
            // ";
            // DB::connection()->getPdo()->exec($sql);
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('content_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_favorite');
    }
}
