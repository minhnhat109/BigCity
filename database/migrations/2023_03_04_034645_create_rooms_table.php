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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('id_category');
            $table->string('name');
            $table->string('slug_name');
            $table->longText('address');
            $table->integer('id_landlord');
            $table->integer('is_open');
            $table->string('image');
            $table->double('price', 18, 0);
            $table->longText('short_description');
            $table->longText('detail_description');
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
        Schema::dropIfExists('rooms');
    }
};
