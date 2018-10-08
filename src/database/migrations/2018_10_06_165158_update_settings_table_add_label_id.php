<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSettingsTableAddLabelId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->integer('label_id')->after('tab_id')->unsigned()->nullable();
            $table->foreign('label_id')->references('id')->on('labels')->onUpdate('cascade');
            $table->index('label_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropForeign('settings_label_id_foreign');
            $table->dropIndex('settings_label_id_index');
            $table->dropColumn(['label_id']);
        });
    }
}
