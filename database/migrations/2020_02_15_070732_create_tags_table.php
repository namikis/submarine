<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            // $sql="
            //     create table `tags`(
            //         `id` int(11) unsigned not null auto_increment,
            //         `content_id` int(11) unsigned not null,
            //         `tag` varchar(255) not null,
            //         primary key(`id`)
            //     );
            // ";
            // DB::connection()->getPdo()->exec($sql);
            $table->increments('id');
            $table->integer('content_id');
            $table->string('tag',255);
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
