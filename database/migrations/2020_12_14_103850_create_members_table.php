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
                        $table->enum("gender", ["male", "female"])->nullable();
                        $table->string("phone");
                        $table->double("age", 10)->nullable();
                        $table->string("password", 1000)->nullable(); //TODO(walid): remove the nullable;
                        $table->boolean("logout")->default(false);
                        $table->string("pic")->nullable()->default("default.jpg");
                        $table->string("designation")->nullable();
                        $table->string("status")->nullable();
                        // $table->unsignedBigInteger("faculty_id")->nullable();
                        $table->string("faculty")->nullable();

                        // $table->foreign("faculty_id")->references("id")->on("faculties")->onDelete("set null");
                });
        }
        
        public function down()
        {
                Schema::dropIfExists('members');
        }
}
