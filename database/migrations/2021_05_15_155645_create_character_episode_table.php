<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterEpisodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_episode', function (Blueprint $table) {
            $table->unsignedBigInteger('character_id');
            $table->unsignedBigInteger('episode_id');

            $table->foreign('character_id')
                ->references('id')->on('characters')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('episode_id')
                ->references('id')->on('episodes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['character_id', 'episode_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_episode');
    }
}
