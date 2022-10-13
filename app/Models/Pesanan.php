<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillabel = [
		"no_hp",
		"email",
		"nm_lengkap",
		"alamat",
		"tiket_id",
		"kategori_id",
		"status",
	];
	protected $guarded	= ["created_at", "updated_at"];

}
