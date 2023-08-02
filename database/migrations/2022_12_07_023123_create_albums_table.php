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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255); // album name

            $table->timestamps(); // We moved this up here! It was at the last line of code!

            $table->foreignIdFor(\App\Models\User::class, 'user_id')->nullable(); // foreignIdFor(): https://laravel.com/docs/9.x/migrations#column-method-foreignIdFor

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
};
