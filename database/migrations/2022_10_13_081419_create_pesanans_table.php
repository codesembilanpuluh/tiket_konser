<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kategori_id');
            $table->string('no_hp', 25)->unique();
            $table->string('email', 50)->unique();
            $table->string('nm_lengkap', 50);
            $table->text('alamat');
            $table->string('tiket_id', 50);
            $table->enum('status', ['0','1'])->default(0)->comment('0=free, 1=check-in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
