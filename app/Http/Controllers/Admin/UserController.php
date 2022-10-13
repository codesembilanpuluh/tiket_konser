<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use App\Models\User;

use DataTables;
use Validator;
use Hash;

class UserController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
			$result = User::query();
			return DataTables::eloquent($result)
				->addIndexColumn()
                ->addColumn('act', function($data) {
                    $btn_act = '<div class="btn-group">
                        <a href="'.asset('admin/user/edit/'.$data->id).'" class="btn btn-set btn-xs bg-primary mr"><i class="fa fa-edit"></i></a>  
                        <button type="button" onclick="delete_data('.$data->id.')" class="btn btn-set btn-xs bg-danger"><i class="fa fa-trash"></i></button>
                    </div>';
                    return $btn_act;
                })
				->rawColumns(['act'])
				->make(true);
		}
        return view('admin.pages.user.index');
    }

    public function add() {
        return view('admin.pages.user.add');
    }
	
	public function edit($id) {
        $result = User::find($id);
        return view('admin.pages.user.edit', compact('result'));
    }

    public function attribute() {
		$attribute 	= [
			"nm_lengkap" => "nama lengkap",
		];
		return $attribute;
	}

	public function create(Request $request) {
		$validates 	= [
			"username"      => "required|unique:users",
            "password"      => "required",
            "nm_lengkap"    => "required",
		];

		$validation = Validator::make($request->all(), $validates, $this->indonesia(), $this->attribute());
        if($validation->fails()) {
            return response()->json($this->warning($validation->errors()->first()), 422);
        }
        \DB::beginTransaction();
		try {
			$data = [
                "username"  => $request->username, 
                "password"  => Hash::make($request->password), 
                "nm_lengkap"=> $request->nm_lengkap, 
            ];

			$result = User::create($data);
            \DB::commit();
			return response()->json($this->success(''), 201);
        } catch(QueryException $e) {
            \DB::rollback();
            return response()->json($this->error($e), 500);
        }
	}

	public function update(Request $request, $id) {
		$validates 	= [
			"username"  	=> "required|unique:users,username,".$id,
			"nm_lengkap" 	=> "required",
		];

		$validation = Validator::make($request->all(), $validates, $this->indonesia(), $this->attribute());
        if($validation->fails()) {
            return response()->json($this->warning($validation->errors()->first()), 422);
        }
        \DB::beginTransaction();
		try {
			$data = [
                "username"  => $request->username, 
                "nm_lengkap"=> $request->nm_lengkap, 
            ];

			if(!empty($request->password)) {
				$data += ["password" => Hash::make($request->password)];
			}

			$result = User::findOrFail($id)->update($data);
			\DB::commit();
			return response()->json($this->success(''), 201);
        } catch(QueryException $e) {
            \DB::rollback();
            return response()->json($this->error($e), 500);
        }
	}

	public function delete($id) {
        \DB::beginTransaction();
		try {
			$result = User::findOrFail($id)->delete();
			
			\DB::commit();
			return response()->json($this->success(''), 201);
        } catch(QueryException $e) {
            \DB::rollback();
            return response()->json($this->error($e), 500);
        }
	}
}
