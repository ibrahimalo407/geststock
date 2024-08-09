<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Vous pouvez choisir l'une des options suivantes

            // Option 1: Autoriser les valeurs nulles
            $table->decimal('total_amount', 8, 2)->nullable()->change();

            // Option 2: Définir une valeur par défaut
            // $table->decimal('total_amount', 8, 2)->default(0.00)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Annuler les changements si nécessaire
            // Exemple : Annuler les valeurs nulles ou par défaut
            // $table->decimal('total_amount', 8, 2)->default(0.00)->change();
        });
    }
};
