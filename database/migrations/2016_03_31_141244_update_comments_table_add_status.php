<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentsTableAddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function ($table) {
            $table->integer('status')->unsigned();

            $table->foreign('status')
                ->references('id')
                ->on('comment_status');
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

            $table->dropForeign('comments_status_foreign');
            $table->dropColumn('status');
        });
    }
}
