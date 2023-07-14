<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string("rnumb", 100);
			$table->string("rdate", 8);
			$table->string("rtime", 8);
			$table->string("alocn", 100);
			$table->text("apict1");
			$table->text("apict1thum");
			$table->text("apict2");
			$table->text("apict2thum");
			$table->text("apict3");
			$table->text("apict3thum");
			$table->enum("afire", ['y', 'n'])->default('n');
			$table->enum("atrap", ['y', 'n'])->default('n');
			$table->enum("ainju", ['y', 'n'])->default('n');
			$table->foreignId("user_id")->constrained()->default('1');
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
        Schema::dropIfExists('reports');
    }
}