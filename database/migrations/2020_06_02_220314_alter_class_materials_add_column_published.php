<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClassMaterialsAddColumnPublished extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_materials', function(Blueprint $table)
        {
            $table->integer('published')->default(0);
            $table->index('published');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('holder_schools_points', function(Blueprint $table)
        {
            $table->dropColumn('published');
            $table->dropIndex('published');

        });
    }
}
