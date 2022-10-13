<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use App\Models\Pesanan;

class TiketController extends Controller {
    public function index() {
        return view('admin.pages.tiket.index');
    }

    public function check_tiket($tiket_id) {
        try {
			$result = Pesanan::select('pesanans.*','kategoris.kategori','kategoris.harga')
                ->join('kategoris','kategoris.id','pesanans.kategori_id')
                ->where('pesanans.tiket_id', $tiket_id)
                ->first();
                
			return response()->json($this->success($result), 201);
        } catch(QueryException $e) { 
            return response()->json($this->error($e), 500);
        }
    }

    public function check_in(Request $request, $tiket_id) {
        try {
			$result = Pesanan::where('tiket_id', $tiket_id)->update(['status' => '1']);
			return response()->json($this->success(''), 201);
        } catch(QueryException $e) { 
            return response()->json($this->error($e), 500);
        }
    }
}
