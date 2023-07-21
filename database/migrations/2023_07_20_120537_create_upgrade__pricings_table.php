<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upgrade__pricings', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('placement_cost');
            $table->string('featured_ad_cost');
            $table->string('animated_gif_cost');
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
        Schema::dropIfExists('upgrade__pricings');
    }
};
