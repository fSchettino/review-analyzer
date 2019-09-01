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

            $table->engine = 'MyISAM';
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();

            $table->engine = 'MyISAM';
        });

        Schema::create('hotel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->text('description');
            $table->integer('rooms');
            $table->double('score', 2, 1)->nullable();
            $table->timestamps();

            $table->engine = 'MyISAM';
        });

        Schema::create('service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->timestamps();

            $table->engine = 'MyISAM';
        });

        Schema::create('review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id');
            $table->string('title', 100);
            $table->text('description');
            $table->double('score', 2, 1)->nullable();
            $table->timestamps();

            $table->foreign('hotel_id')
                   ->references('id')->on('hotel')
                   ->onDelete('cascade');

            $table->engine = 'MyISAM';
        });

        Schema::create('keyword', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['positive', 'negative']);
            $table->string('name', 100);
            $table->enum('weight', [1, 2, 3]);
            $table->timestamps();

            $table->engine = 'MyISAM';
        });

        Schema::create('rule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_id');
            $table->string('name', 100);
            $table->timestamps();

            $table->foreign('service_id')
                   ->references('id')->on('service')
                   ->onDelete('cascade');

            $table->engine = 'MyISAM';
        });

        // junction table between hotels and services
        Schema::create('hotel_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id');
            $table->bigInteger('service_id');

            $table->foreign('hotel_id')
                  ->references('id')->on('hotels')
                  ->onDelete('cascade');
            $table->foreign('service_id')
                  ->references('id')->on('service')
                  ->onDelete('cascade');

            $table->engine = 'MyISAM';
        });

        // junction table between hotels and rules
        Schema::create('hotel_rule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id');
            $table->bigInteger('rule_id');

            $table->foreign('hotel_id')
                  ->references('id')->on('hotels')
                  ->onDelete('cascade');
            $table->foreign('rule_id')
                  ->references('id')->on('rule')
                  ->onDelete('cascade');

            $table->engine = 'MyISAM';
        });

        // junction table between rules and keywords
        Schema::create('rule_keyword', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rule_id');
            $table->bigInteger('keyword_id');

            $table->foreign('rule_id')
                  ->references('id')->on('rule')
                  ->onDelete('cascade');
            $table->foreign('keyword_id')
                  ->references('id')->on('keyword')
                  ->onDelete('cascade');

            $table->engine = 'MyISAM';
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
        Schema::dropIfExists('hotel');
        Schema::dropIfExists('service');
        Schema::dropIfExists('review');
        Schema::dropIfExists('keyword');
        Schema::dropIfExists('rule');
        Schema::dropIfExists('hotel_service');
        Schema::dropIfExists('rule_keyword');
    }
}
