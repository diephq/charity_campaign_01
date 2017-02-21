<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_campaigns', function (Blueprint $table) {
            $table->boolean('is_owner')->default(0)->change();
            $table->boolean('status')->after('is_owner')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_campaigns', function (Blueprint $table) {
            $table->boolean('is_owner')->nullable()->change();
            $table->dropColumn('status');
        });
    }
}
