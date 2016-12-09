<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('image_id');
            $table->text('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->integer('image_id');
            $table->string('description');
        });
    }
}
