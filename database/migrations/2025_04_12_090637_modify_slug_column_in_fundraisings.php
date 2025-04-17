<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySlugColumnInFundraisings extends Migration
{
    public function up()
    {
        Schema::table('fundraisings', function (Blueprint $table) {
            $table->string('slug')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('fundraisings', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }
}
