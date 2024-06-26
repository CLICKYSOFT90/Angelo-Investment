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
        Schema::create('offerings', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->enum('investment_type', ['Equity', 'Fund']);
            $table->enum('project_type', ['Value- Add', 'Development', 'REIT']);
            $table->integer('offering_types');
            $table->integer('min_investments');
            $table->string('hold_period');
            $table->integer('target_irr');
            $table->string('est_construction_completion');
            $table->integer('preferred_rate');
            $table->integer('investment_required');
            $table->integer('no_of_share');
            $table->integer('price_per_share');
            $table->integer('no_of_units');
            $table->string('address');
            $table->text('short_desc');
            $table->text('long_desc');
            $table->text('disclaimer');
            $table->tinyInteger('status');
            $table->tinyInteger('is_completed')->default(0)->nullable();
            $table->integer('actual_irr')->nullable();
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
        Schema::dropIfExists('offerings');
    }
};
