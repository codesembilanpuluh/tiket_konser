<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use App\Models\Kategori;

use DataTables;
use Validator;


class KategoriController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
			$result = Kategori::query();
			return DataTables::eloquent($result)
				->addIndexColumn()
				->addColumn('act', function($data) {
                    $btn_act = '<div class="btn-group">
                        <a href="'.asset('admin/kategori/edit/'.$data->id).'" class="btn btn-set btn-xs bg-primary mr"><i class="fa fa-edit"></i></a>  
                        <button type="button" onclick="delete_data('.$data->id.')" class="btn btn-set btn-xs bg-danger"><i class="fa fa-trash"></i></button>
                    </div>';
                    return $btn_act;
                })
				->rawColumns(['act'])
				->make(true);
		}
        
        return view('admin.pages.kategori.index');
    }

    public function add() {
        return view('admin.pages.kategori.add');
    }

    public function edit($id) {
		$result	 = Kategori::find($id);
        return view('admin.pages.kategori.edit', compact('result'));
    }

	public function create(Request $request) {
		$validates 	= [
            "kategori"  => "required|max:20",
            "harga"     => "required|max:10",
        ];

		$validation = Validator::make($request->all(), $validates, $this->indonesia(), []);
        if($validation->fails()) {
            return response()->json($this->warning($validation->errors()->first()), 422);
        }

        \DB::beginTransaction();
		try {
			$data = [
                "kategori"  => $request->kategori, 
                "harga"     => $request->harga, 
            ];
            Kategori::create($data);

            \DB::commit();
            return response()->json($this->success(''), 201);
        } catch(QueryException $e) {
            \DB::rollback();
            return response()->json($this->error($e), 500);
        }
	}


    public function update(Request $request, $id) {
		$validates 	= [
            "kategori"  => "required|max:20",
            "harga"     => "required|max:10",
        ];

		$validation = Validator::make($request->all(), $validates, $this->indonesia(), []);
        if($validation->fails()) {
            return response()->json($this->warning($validation->errors()->first()), 422);
        }
        \DB::beginTransaction();
		try {
            $data = [
                "kategori"  => $request->kategori, 
                "harga"     => $request->harga, 
            ];
            Kategori::findOrFail($id)->update($data);

			\DB::commit();
            return response()->json($this->success(''), 201);
        } catch(QueryException $e) {
            \DB::rollback();
            return response()->json($this->error($e), 500);
        }
	}

	public function delete($id) {
		try {
			Kategori::findOrFail($id)->delete();

			return response()->json($this->success(''), 201);
        } catch(QueryException $e) { 
            return response()->json($this->error($e), 500);
        }
	}
}
