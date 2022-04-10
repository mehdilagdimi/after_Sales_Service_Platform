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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            //create significant reference
            $table->string('ref', 50)->unique();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('service_id')
                ->constrained('services')
                ->onUpdate('cascade');
            $table->foreignId('status_id')
                ->constrained('statuses')
                ->onUpdate('cascade');
            $table->text('body');
            $table->timestamps();

            //Use this if name of primary key column is not "id"
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
