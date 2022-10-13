<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Kategori;
use App\Models\Pesanan;

use Validator;
use PDF;

class HomeController extends Controller {
    public function index() {
        return view('home');
    }

    public function daftar() {
        $kategoris = Kategori::all();
        return view('daftar', compact('kategoris'));
    }

    public function pesan(Request $request) {
        $validates 	= [
            "kategori_id"   => "required",
            "no_hp"         => "required|max:13",
            "email"         => "required|email",
            "nm_lengkap"    => "required|max:25",
            "alamat"        => "required|max:500",
        ];

		$validation = Validator::make($request->all(), $validates, $this->indonesia(), [
            'no_hp'         => 'nomor hp',
            'kategori_id'   => 'kategori',
            'nm_lengkap'    => 'nama lengkap',
        ]);

        if($validation->fails()) {
            return response()->json($this->warning($validation->errors()->first()), 422);
        }

        \DB::beginTransaction();
		try {
			$data = [
                "no_hp"         => $request->no_hp, 
                "email"         => $request->email, 
                "nm_lengkap"    => $request->nm_lengkap, 
                "alamat"        => $request->alamat, 
                "tiket_id"      => rand(100000, 999999), 
                "kategori_id"   => $request->kategori_id,
            ];
            
            $result = Pesanan::create($data);

            \DB::commit();
            return response()->json($this->success($result), 201);
        } catch(QueryException $e) {
            \DB::rollback();
            return response()->json($this->error($e), 500);
        }
    }

    public function print_tiket($tiket_id)
    {   
        $result = Pesanan::select('pesanans.*','kategoris.kategori','kategoris.harga')
                ->join('kategoris','kategoris.id','pesanans.kategori_id')
                ->where('pesanans.tiket_id', $tiket_id)
                ->first();

        $view   = PDF::loadView('tiket_pdf', compact('result'));

        $view->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer'       => FALSE,
                    'verify_peer_name'  => FALSE,
                ]
            ])
        );
        $view->setPaper("A4", "portrait");
        return $view->stream("tiket.pdf");
    }
}
