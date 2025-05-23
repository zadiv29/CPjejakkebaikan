<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAnoutToAboutInFundraisings extends Migration
{
    public function up()
    {
        // Schema::table('fundraisings', function (Blueprint $table) {
        //     $table->renameColumn('anout', 'about');
        // });
    }

    public function down()
    {
        // Schema::table('fundraisings', function (Blueprint $table) {
        //     $table->renameColumn('about', 'anout');
        // });
    }
}
