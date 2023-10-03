<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comment_user', function (Blueprint $table) {
            $table->foreignId('comment_id')->constrained()->name('comment_user_comment_id_foreign')
            ->index()->onDelete('cascade');

            $table->foreignId('user_id')->constrained()->name('comment_user_user_id_foreign')
            ->index()->onDelete('cascade');

            $table->primary(['comment_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::drop('comment_user');
    }
};
