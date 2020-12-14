<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("fullname", 1000);
            $table->string("nat_id", 14);
            $table->enum("gender", ["male", "female"]);
            $table->double("age", 10, 2)->nullable();
            $table->string("password", 1000);
            $table->text("pic")->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
}
