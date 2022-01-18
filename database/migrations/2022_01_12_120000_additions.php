<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name')->unique();
            $table->string('package');
            $table->string('version');
            $table->string('wrapper_class');
            $table->text('description');
            $table->text('icon');
            $table->json('documentation')->nullable();
            $table->timestamps();
        });
    }
};
