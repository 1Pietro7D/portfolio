<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // FK portfolio
            $table->unsignedBigInteger('portfolio_id');
            $table
                ->foreign('portfolio_id')
                ->references('id')
                ->on('portfolios')
                ->onDelete('cascade');
            // FK icon
            $table->unsignedBigInteger('icon_id')->nullable();
            $table
                ->foreign('icon_id')
                ->references('id')
                ->on('icons')
                ->onDelete('set null');
            // attributes
            $table->string('name', 40)->unique()->notNull();
            $table->string('slug')->unique()->notNull();
            $table->string('contact')->unique()->notNull();

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
        Schema::dropIfExists('contacts');
    }
}
