<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterShopCategoriesTableToInnodb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //Schema::table('shop_categories', function (Blueprint $table) {
            //$table->increments('id');
            //$table->timestamps();
            //$table->engine = 'InnoDB';
        //});
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE shop_categories ENGINE=InnoDB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
