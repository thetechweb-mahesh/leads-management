<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255); // title, varchar(255)
            $table->string('subtitle', 255)->nullable(); // subtitle, varchar(255), nullable
            $table->text('details')->nullable(); // details, text, nullable
            $table->string('slug', 255); // slug, varchar(255)
            $table->text('meta')->nullable(); // meta, text, nullable
            $table->text('img')->nullable(); // img, text, nullable
            $table->text('extra')->nullable(); // extra, text, nullable
            $table->integer('orders')->default(0); // orders, int(11), default 0
            $table->integer('parent')->default(0); // parent, int(11), default 0
            $table->tinyInteger('status')->default(1); // status, tinyint(1), default 1
            $table->string('lang', 10)->default('en'); // lang, varchar(10), default 'en'
            $table->string('type', 255)->nullable(); // type, varchar(255), nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
