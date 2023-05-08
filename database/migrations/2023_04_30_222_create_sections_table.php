<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            // FK portfolio
            $table->unsignedBigInteger('portfolio_id')->nullable();
            $table
                ->foreign('portfolio_id')
                ->references('id')
                ->on('portfolios')
                ->onDelete('cascade');
            //attributes
            $table->string('title', 40)->notNull();
            $table->string('slug')->notNull();
            $table->text('paragraph');
            $table->text('img_path')->nullable();
            // condition for future multiple portfolios
            $table->unique(['title', 'portfolio_id']);
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
        Schema::dropIfExists('sections');
    }
}
