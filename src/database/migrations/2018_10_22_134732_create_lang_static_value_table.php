<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLangStaticValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang_static_values', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('lang_static_id')->unsigned()->index();
            $table->foreign('lang_static_id')->references('id')->on('lang_statics')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('lang_id')->unsigned()->index();
            $table->foreign('lang_id')->references('id')->on('langs')->onUpdate('cascade');
            $table->string('value', 255)->nullable();
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
        Schema::dropIfExists('lang_static_values');
    }
}
