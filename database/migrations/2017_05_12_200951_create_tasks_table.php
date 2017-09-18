<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('description', 195);
            $table->enum('type', ['urgent', 'not_urgent', 'current']);
            $table->enum('status', ['todo', 'in_progress', 'done']);
            $table->string('post');
            $table->string('price', 255);
            $table->string('file')->nullable();
            $table->string('result')->nullable();

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
        });

        Schema::connection('mysql2')->create('tasks', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 60);
            $table->string('description', 195);
            $table->enum('type', ['urgent', 'not_urgent', 'current']);
            $table->enum('status', ['todo', 'in_progress', 'done']);
            $table->string('post');
            $table->string('price', 255);
            $table->string('file')->nullable();
            $table->string('result')->nullable();

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->string('role', 255)->nullable();

            $table->string('project', 255)->nullable();

            $table->string('user', 255)->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
        Schema::connection('mysql2')->dropIfExists('tasks');
    }
}
