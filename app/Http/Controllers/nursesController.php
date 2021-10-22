<?php

namespace App\Http\Controllers;

use App\Models\basic;
use App\Models\nurses;
use Illuminate\Http\Request;
use Validator;

class nursesController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Enfermeros"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'bodyCustomClass' => 'menu-collapse'];

        return view('/nurses/index', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function getNurses(Request $request)
    {
        try {
            $data = nurses::search($request->search)->orderBy('created_at', 'DESC')->paginate(7);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
            ],
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = nurses::where('id', $request->id)->delete();
            if ($data) {
                return response()->json([
                    'status' => 'delete',
                ]);
            } else {
                return response()->json([
                    'status' => 'error']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
            ],
            ]);
        }
    }

    public function save(Request $request)
    {
        try {
            $basic = new basic();
            if ($request->id == '') {
                $validador = Validator::make($request->all(), [
                    'document_type' => 'required',
                    'dni' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'first_surname' => 'required',
                    'last_surname' => 'required',
                    'gender' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                    'file' => 'required',
                ]);
                if ($validador->fails()) {
                    return response()->json([
                        'status' => 'validator',
                        'errors' => $validador->errors(),
                    ]);
                }

                $data = new nurses();
                $data->id = $basic->generateId('NUES');
                $data->document_type = strtoupper($request->document_type);
                $data->dni = $request->dni;
                $data->first_name = strtoupper($request->first_name);
                $data->last_name = strtoupper($request->last_name);
                $data->first_surname = strtoupper($request->first_surname);
                $data->last_surname = strtoupper($request->last_surname);
                $data->gender = $request->gender;
                $data->phone = $request->phone;
                $data->email = $request->email;
                $data->url = $data->id;
                $data->save();

                $file = explode(',', $request->file);
                $pdf = base64_decode($file[1]);
                $name = $data->url . '.' . explode(";", explode("/", $request->file)[1])[0];
                $path = public_path() . '/hv/' . $name;
                file_put_contents($path, $pdf);

                if ($data) {
                    return response()->json([
                        'status' => 'save',
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error']);
                }
            } else {
                $validador = Validator::make($request->all(), [
                    'document_type' => 'required',
                    'dni' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'first_surname' => 'required',
                    'last_surname' => 'required',
                    'gender' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                    'file' => 'required',
                ]);
                if ($validador->fails()) {
                    return response()->json([
                        'status' => 'validator',
                        'errors' => $validador->errors(),
                    ]);
                }

                $data = nurses::find($request->id);
                $data->document_type = strtoupper($request->document_type);
                $data->dni = $request->dni;
                $data->first_name = strtoupper($request->first_name);
                $data->last_name = strtoupper($request->last_name);
                $data->first_surname = strtoupper($request->first_surname);
                $data->last_surname = strtoupper($request->last_surname);
                $data->gender = $request->gender;
                $data->phone = $request->phone;
                $data->email = $request->email;
                $data->url = $data->url = $data->id;
                $data->save();

                $file = explode(',', $request->file);
                $pdf = base64_decode($file[1]);
                $name = $data->url . '.' . explode(";", explode("/", $request->file)[1])[0];
                $path = public_path() . '/hv/' . $name;
                file_put_contents($path, $pdf);

                if ($data) {
                    return response()->json([
                        'status' => 'save',
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error']);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
            ],
            ]);
        }
    }
}
