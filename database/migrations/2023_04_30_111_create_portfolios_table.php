<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            // FK user
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // attributes
            $table->string('name', 40)->notNull();
            //In questo caso per pdf, il valore inserito nel campo "curriculum_vitae" sarà un'istanza di "Illuminate\Http\File" che rappresenta il file del curriculum vitae. Puoi quindi salvare il file nel sistema di archiviazione usando il metodo "store()" di questa istanza. Ricorda di impostare il percorso di archiviazione desiderato nel file "config/filesystems.php".
            $table->binary('curriculum_vitae_pdf')->nullable();

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
        Schema::dropIfExists('portfolios');
    }
}
