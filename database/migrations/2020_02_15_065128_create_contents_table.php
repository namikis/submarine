<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            // $sql="
            //     create table `contents`(
            //         `id` int(11) unsigned not null auto_increment,
            //         `company_id` int(11) not null,
            //         `image_name` varchar(255) not null,
            //         `tag_id` int(11),
            //         `content_detail` varchar(255),
            //         `content_link` varchar(255),
            //         `created_date` datetime null default current_timestamp,
            //         primary key(`id`),
            //         unique(`image_name`)
            //     );
            // ";
            // DB::connection()->getPdo()->exec($sql);

            $table->increments('id');
            $table->integer('company_id');
            $table->string('image_name',255);
            $table->integer('tag_id');
            $table->string('content_detail',255);
            $table->string('content_link',255);
            $table->timestamps();
            $table->unique('image_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
