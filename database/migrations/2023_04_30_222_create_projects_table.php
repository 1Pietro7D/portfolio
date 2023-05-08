<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            // FK portfolio
            $table->unsignedBigInteger('portfolio_id');
            $table
                ->foreign('portfolio_id')
                ->references('id')
                ->on('portfolios')
                ->onDelete('cascade');
            // attributes
            $table->string('title', 40)->unique()->notNull();
            $table->string('slug')->unique()->notNull();
            $table->text('description')->notNull();
            $table->text('img_path')->nullable();
            $table->text('video_path')->nullable();
            $table->text('link_github')->nullable();

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
        Schema::dropIfExists('projects');
    }
}
