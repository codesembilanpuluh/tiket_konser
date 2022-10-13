<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function success($data) {
		return [
			'status' 	=> 'success',
			'message' 	=> 'proses success',
			'data' 		=> $data?$data:null,
		];
	}

	public function warning($message) {
		return [
			"status"	=> "warning",
			"message"  	=> $message
		];
	}

	public function error($e) {
		return [
			'status' 	=> 'error',
			'message' 	=> $e->errorInfo 
		];
	}
	
    public function indonesia() {
        return [
			'accepted' => 'Isian :attribute harus diterima.',
			'active_url' => 'Isian :attribute bukan URL yang valid.',
			'after' => 'Isian :attribute harus tanggal setelah :date.',
			'after_or_equal' => 'Isian :attribute harus berupa tanggal setelah atau sama dengan tanggal :date.',
			'alpha' => 'Isian :attribute hanya boleh berisi huruf.',
			'alpha_dash' => 'Isian :attribute hanya boleh berisi huruf, angka, dan strip.',
			'alpha_num' => 'Isian :attribute hanya boleh berisi huruf dan angka.',
			'array' => 'Isian :attribute harus berupa sebuah array.',
			'before' => 'Isian :attribute harus tanggal sebelum :date.',
			'before_or_equal' => 'Isian :attribute harus berupa tanggal sebelum atau sama dengan tanggal :date.',
			'between' => [
				'numeric' => 'Isian :attribute harus antara :min dan :max.',
				'file' => 'Isian :attribute harus antara :min dan :max kilobytes.',
				'string' => 'Isian :attribute harus antara :min dan :max karakter.',
				'array' => 'Isian :attribute harus antara :min dan :max item.',
			],
			'boolean' => 'Isian :attribute harus berupa true atau false',
			'confirmed' => 'Konfirmasi :attribute tidak cocok.',
			'date' => 'Isian :attribute bukan tanggal yang valid.',
			'date_format' => 'Isian :attribute tidak cocok dengan format :format.',
			'different' => 'Isian :attribute dan :other harus berbeda.',
			'digits' => 'Isian :attribute harus berupa angka :digits.',
			'digits_between' => 'Isian :attribute harus antara angka :min dan :max.',
			'dimensions' => 'Form :attribute tidak memiliki dimensi gambar yang valid.',
			'distinct' => 'Form isian :attribute memiliki nilai yang duplikat.',
			'email' => 'Isian :attribute harus berupa alamat surel yang valid.',
			'exists' => 'Isian :attribute yang dipilih tidak valid.',
			'file' => 'Form :attribute harus berupa sebuah berkas.',
			'filled' => 'Isian :attribute harus memiliki nilai.',
			'image' => 'Isian :attribute harus berupa gambar.',
			'in' => 'Isian :attribute yang dipilih tidak valid.',
			'in_array' => 'Form isian :attribute tidak terdapat dalam :other.',
			'integer' => 'Isian :attribute harus merupakan bilangan bulat.',
			'ip' => 'Isian :attribute harus berupa alamat IP yang valid.',
			'ipv4' => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
			'ipv6' => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
			'json' => 'Isian :attribute harus berupa JSON string yang valid.',
			'max' => [
				'numeric' => 'Isian :attribute seharusnya tidak lebih dari :max.',
				'file' => 'Isian :attribute seharusnya tidak lebih dari :max kilobytes.',
				'string' => 'Isian :attribute seharusnya tidak lebih dari :max karakter.',
				'array' => 'Isian :attribute seharusnya tidak lebih dari :max item.',
			],
			'mimes' => 'Isian :attribute harus dokumen berjenis : :values.',
			'mimetypes' => 'Isian :attribute harus dokumen berjenis : :values.',
			'min' => [
				'numeric' => 'Isian :attribute harus minimal :min.',
				'file' => 'Isian :attribute harus minimal :min kilobytes.',
				'string' => 'Isian :attribute harus minimal :min karakter.',
				'array' => 'Isian :attribute harus minimal :min item.',
			],
			'not_in' => 'Isian :attribute yang dipilih tidak valid.',
			'numeric' => 'Isian :attribute harus berupa angka.',
			'present' => 'Form isian :attribute wajib ada.',
			'regex' => 'Format isian :attribute tidak valid.',
			'required' => 'Form isian :attribute wajib diisi.',
			'required_if' => 'Form isian :attribute wajib diisi bila :other adalah :value.',
			'required_unless' => 'Form isian :attribute wajib diisi kecuali :other memiliki nilai :values.',
			'required_with' => 'Form isian :attribute wajib diisi bila terdapat :values.',
			'required_with_all' => 'Form isian :attribute wajib diisi bila terdapat :values.',
			'required_without' => 'Form isian :attribute wajib diisi bila tidak terdapat :values.',
			'required_without_all' => 'Form isian :attribute wajib diisi bila tidak terdapat ada :values.',
			'same' => 'Isian :attribute dan :other harus sama.',
			'size' => [
				'numeric' => 'Isian :attribute harus berukuran :size.',
				'file' => 'Isian :attribute harus berukuran :size kilobyte.',
				'string' => 'Isian :attribute harus berukuran :size karakter.',
				'array' => 'Isian :attribute harus mengandung :size item.',
			],
			'string' => 'Isian :attribute harus berupa string.',
			'timezone' => 'Isian :attribute harus berupa zona waktu yang valid.',
			'unique' => 'Isian :attribute sudah ada sebelumnya.',
			'uploaded' => 'Isian :attribute gagal diunggah.',
			'url' => 'Format isian :attribute tidak valid.',
			'custom' => [
				'attribute-name' => [
					'rule-name' => 'custom-message',
				],
			],
			'attributes' => [],
		];
    }

	function conver_rupiah($value) {
        return number_format($value,0,',','.');
    }

    function conver_angka($value) {
        return preg_replace("[[^A-Za-z0-9]]", "", $value);
    }
}
