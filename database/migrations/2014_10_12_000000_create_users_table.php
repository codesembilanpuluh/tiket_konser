<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nm_lengkap', 35);
            $table->string('username', 25)->unique();
            $table->string('password');
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}
