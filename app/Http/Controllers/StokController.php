<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{

    public function index(Request $request)
    {

        if ($request->has('search')) {
            $arsip = $request->input('search');
            $stok = Stok::where('jenis', '=', $arsip)->get();

            if(count($stok) === 0) {
                return response([
                    'success' => 'true',
                    'message' => 'List Semua Data',
                    'data' => "Data belum ada"
                ], 200);
            }else {
                return response([
                    'success' => 'true',
                    'message' => 'List Semua Data',
                    'data' => $stok
                ], 200);
            }

         }else{
            $stokAll = Stok::latest()->get();
            return response([
                'success' => 'true',
                'message' => 'List Semua Data',
                'data' => $stokAll
            ], 200);
         }
    }
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'jenis'     => 'required',
            'nama_barang'   => 'required',
            'kondisi'   => 'required',
            'total'   => 'required',
            'file_id' => 'required'
        ],
            [
                'jenis.required' => 'Masukkan Jenis',
                'nama_barang.required' => 'Masukkan Nama Barang',
                'kondisi.required' => 'Masukkan Kondisi',
                'total.required' => 'Masukkan Total',
                'file_id.required' => 'Masukakan file_id'
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $post = Stok::create([
                'jenis'     => $request->input('jenis'),
                'namaBarang'   => $request->input('nama_barang'),
                'kondisi'   => $request->input('kondisi'),
                'total'   => $request->input('total'),
                'file_id' => $request->input('file_id')
            ]);

            // dd($post->code);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Gagal Disimpan!',
                ], 401);
            }
        }
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ],
            [
                'title.required' => 'Masukkan Title Post !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {
            $stok = Stok::whereCode($request->input('code'))->first();

            if ($stok) {
                return response()->json([
                    'success' => true,
                    'message' => 'Detail Data!',
                    'data'    => $stok
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Tidak Ditemukan!',
                    'data'    => ''
                ], 401);
            }
        }
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'jenis'     => 'required',
            'nama_barang'   => 'required',
            'kondisi'   => 'required',
            'total'   => 'required',
        ],
            [
                'jenis.required' => 'Masukkan Jenis',
                'nama_barang.required' => 'Masukkan Nama Barang',
                'kondisi.required' => 'Masukkan Kondisi',
                'total.required' => 'Masukkan Total',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $post = Stok::whereCode($request->input('code'))->update([
                'jenis'     => $request->input('jenis'),
                'namaBarang'   => $request->input('nama_barang'),
                'kondisi'   => $request->input('kondisi'),
                'total'   => $request->input('total')
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Gagal Diupdate!',
                ], 401);
            }

        }

    }

    public function destroy($id)
    {
        $stok = Stok::whereCode($id);
        $stok->delete();

        if ($stok) {
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Dihapus!',
            ], 400);
        }

    }
}
