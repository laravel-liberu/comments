<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->morphs('commentable');

            $table->text('body');

            $table->foreignId('created_by')->nullable()->constrained('users')->index()->name('comments_created_by_foreign');

            $table->foreignId('updated_by')->nullable()->constrained('users')->index()->name('comments_updated_by_foreign');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
