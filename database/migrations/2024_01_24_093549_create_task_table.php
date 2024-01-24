<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\TaskConstants;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->enum('status', [TaskConstants::TO_DO, TaskConstants::IN_PROGRESS, TaskConstants::COMPLETED, TaskConstants::DELETED]);
            $table->bigInteger('user_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
}
