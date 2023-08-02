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
        Schema::create('image_manipulations', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('path', 2000);
            $table->string('type', 25);
            $table->text('data');
            $table->string('output_path', 2000)->nullable();
            $table->timestamp('created_at')->nullable(); // We don't `updated_at` column, we need `created_at` ONLY
            $table->foreignIdFor(\App\Models\User::class, 'user_id')->nullable();
            $table->foreignIdFor(\App\Models\Album::class, 'album_id')->nullable();

            // $table->timestamps(); // We don't neede `updated_at` column, we need `created_at` ONLY. Check the    const UPDATED_AT = null;    in ImageManipulation.php model.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_manipulations');
    }
};
