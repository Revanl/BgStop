<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('job_messages', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('job_id')->unsigned()->change();
            $table->foreign('job_id')->references('id')->on('jobs');
        });

        Schema::table('rents', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('rent_messages', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('rent_id')->unsigned()->change();
            $table->foreign('rent_id')->references('id')->on('rents');
        });

        Schema::table('purchase', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('purchase_messages', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('purchase_id')->unsigned()->change();
            $table->foreign('purchase_id')->references('id')->on('purchase');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('lesson_messages', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('lesson_id')->unsigned()->change();
            $table->foreign('lesson_id')->references('id')->on('lessons');
        });

        Schema::table('dating_profiles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('dating_profile_messages', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('dating_profile_id')->unsigned()->change();
            $table->foreign('dating_profile_id')->references('id')->on('dating_profiles');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
