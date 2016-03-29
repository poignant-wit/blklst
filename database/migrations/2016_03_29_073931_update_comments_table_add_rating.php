<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentsTableAddRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function ($table) {
            $table->integer('rating')->unsigned();

            $table->foreign('rating')
                ->references('id')
                ->on('ratings');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function ($table) {

            $table->dropForeign('comments_rating_foreign');
            $table->dropColumn('rating');
        });
    }
}
