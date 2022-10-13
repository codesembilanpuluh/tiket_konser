<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use App\Models\Pesanan;

use App\Exports\ExportPesanan;

use DataTables;
use Excel;

class PesananController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
			$result = Pesanan::select('pesanans.*','kategoris.kategori','kategoris.harga')
                ->join('kategoris','kategoris.id','pesanans.kategori_id');
			return DataTables::eloquent($result)
				->addIndexColumn()
				->addColumn('act', function($data) {
                    $btn_act = '<div class="btn-group">
                        <button type="button" onclick="delete_data('.$data->id.')" class="btn btn-set btn-xs bg-danger"><i class="fa fa-trash"></i></button>
                    </div>';
                    return $btn_act;
                })
				->rawColumns(['act'])
				->make(true);
		}
        
        return view('admin.pages.pesanan.index');
    }

    public function delete($id) {
		try {
			Pesanan::findOrFail($id)->delete();
			return response()->json($this->success(''), 201);
        } catch(QueryException $e) { 
            return response()->json($this->error($e), 500);
        }
	}

    public function export_excel(Request $request) {
        return Excel::download(new ExportPesanan($request), 'rekap.xlsx'); 
    }
}
