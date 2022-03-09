<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attacher_id');
            $table->morphs('attachable');
            $table->index('attacher_id');
            $table->string('label');
            $table->string('path');
            $table->integer('size');
            $table->string('type');
            $table->timestamp('created_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropMorphs('attachable');
        });
        Schema::dropIfExists('attachments');
    }
}
