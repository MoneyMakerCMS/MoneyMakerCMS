<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('uri');
            $table->text('middleware');
            $table->string('route')->unique();
            $table->string('type');
            $table->string('layout')->nullable();
            $table->string('section')->nullable();
            $table->text('content')->nullable();
            $table->string('file')->nullable();
            $table->boolean('active');
            $table->boolean('ab')->default(0);

            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('uri');
            $table->index(['uri', 'active']);
        });


        Schema::create('seo', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('entity');
            $table->string('title')->length(60);
            $table->string('description')->length(160);
            $table->string('keywords');
            $table->string('robots');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
        Schema::drop('seo');
    }
}
