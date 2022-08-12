<?php

use App\Enums\ApiStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('apis', function (Blueprint $table) {
            $table->string('status')->default(ApiStatus::SUBMITTED->value)->index()->after('name');
            $table->softDeletes();
        });
    }
};
