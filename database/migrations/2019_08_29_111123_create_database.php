<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->text('description');
            $table->integer('rooms');
            $table->double('score', 2, 1);
            $table->timestamps();
        });

        Schema::create('hotel_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id');
            $table->string('title', 100);
            $table->text('description');
            $table->double('score', 2, 1);
            $table->timestamps();

            $table->foreign('hotel_id')
                   ->references('id')->on('hotels')
                   ->onDelete('cascade');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->double('score', 2, 1);
            $table->timestamps();
        });

        Schema::create('service_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_id');
            $table->string('title', 100);
            $table->text('description');
            $table->double('score', 2, 1);
            $table->timestamps();

            $table->foreign('service_id')
                   ->references('id')->on('services')
                   ->onDelete('cascade');
        });

        Schema::create('whitelist_keywords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->integer('weight');
            $table->timestamps();
        });

        Schema::create('blacklist_keywords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->integer('weight');
            $table->timestamps();
        });

        // junction table between hotels and services
        Schema::create('hotels_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id');
            $table->bigInteger('service_id');
            $table->timestamps();

            $table->foreign('hotel_id')
                   ->references('id')->on('hotels');
            $table->foreign('service_id')
                   ->references('id')->on('services');
        });

        // junction table between hotels and whitelist keywords
        Schema::create('hotels_whitelist_keywords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id');
            $table->bigInteger('whitelist_keyword_id');
            $table->timestamps();

            $table->foreign('hotel_id')
                   ->references('id')->on('hotels');
            $table->foreign('whitelist_keyword_id')
                   ->references('id')->on('whitelist_keywords');
        });

        // junction table between hotels and blacklist keywords
        Schema::create('blacklist_keywords_hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id');
            $table->bigInteger('blacklist_keyword_id');
            $table->timestamps();

            $table->foreign('hotel_id')
                   ->references('id')->on('hotels');
            $table->foreign('blacklist_keyword_id')
                   ->references('id')->on('blacklist_keywords');
        });

        // junction table between services and whitelist keywords
        Schema::create('services_whitelist_keywords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_id');
            $table->bigInteger('whitelist_keyword_id');
            $table->timestamps();

            $table->foreign('service_id')
                   ->references('id')->on('services');
            $table->foreign('whitelist_keyword_id')
                   ->references('id')->on('whitelist_keywords');
        });

        // junction table between services and blacklist keywords
        Schema::create('blacklist_keywords_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_id');
            $table->bigInteger('blacklist_keyword_id');
            $table->timestamps();

            $table->foreign('service_id')
                   ->references('id')->on('services');
            $table->foreign('blacklist_keyword_id')
                   ->references('id')->on('blacklist_keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('hotels');
        Schema::dropIfExists('hotel_reviews');
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_reviews');
        Schema::dropIfExists('whitelist_keywords');
        Schema::dropIfExists('blacklist_keywords');
        Schema::dropIfExists('hotels_services');
        Schema::dropIfExists('hotels_whitelist_keywords');
        Schema::dropIfExists('blacklist_keywords_hotels');
        Schema::dropIfExists('services_whitelist_keywords');
        Schema::dropIfExists('blacklist_keywords_services');
    }
}
