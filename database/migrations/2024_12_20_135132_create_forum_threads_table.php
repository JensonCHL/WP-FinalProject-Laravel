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
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->id();                             // Primary Key
            $table->string('username');              // Username from login
            $table->string('title');                // Thread title
            $table->text('text');                   // Thread content
            $table->integer('replies_count')->default(0);  // Reply count
            $table->integer('likes_count')->default(0);    // Likes count
            $table->timestamps();                   // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_threads');
    }
};
