<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodosController extends Controller
{
    public function add(Request $request)
    {
        $todo = new \App\Todo;
        $validator = Validator::make($request->all(), $todo->rules);
        if ($validator->fails()) {
            return [
                'error' => $validator->errors()
            ];
        } else {
            if ($request->start != null) {
                $start = Carbon::parse($request->start);
                $end = null;
            }
            if ($request->end != null) {
                $end = Carbon::parse($request->end);
            }

            $insert = \App\Todo::create([
                'title' => $request->title,
                'desscription' => $request->desscription,
                'start' => $start,
                'end' => $end
            ]);
            if ($insert) {
                return [
                    'status' => 'success',
                    'message' => 'data Berhasil Dimasukan',
                    'result' => $insert
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'data gagal dimasukkan',
                    'result' => null
                ];
            }
        }
    }

    public function all()
    {
        $result = \App\Todo::all();
        return [
            'status' => 'success',
            'message' => 'Data Tersedia',
            'result' => $result
        ];
    }

    public function put(Request $request, $id)
    {
        $todo = new \App\Todo;
        $validator = Validator::make($request->all(), $todo->rules);
        if ($validator->fails()) {
            return [
                'error' => $validator->errors()
            ];
        } else {
            if ($request->start != null) {
                $start = Carbon::parse($request->start);
                $end = null;
            }
            if ($request->end != null) {
                $end = Carbon::parse($request->end);
            }
            $todos = \App\Todo::find($id);
            $result = $todos->update([
                'title' => $request->title,
                'desscription' => $request->desscription,
                'start' => $start,
                'end' => $end
            ]);
            if ($result) {
                return [
                    'status' => 'success',
                    'message' => 'Data Berhasil Diubah',
                    'result' => null
                ];
            }
        }
    }

    public function remove($id)
    {
        $delete = \App\Todo::find($id)->delete();
        if($delete){
            return [
                'status'=>'success',
                'message'=>'Data Berhasil Dihapus',
                'result'=> null
            ];
        }
    }
}
