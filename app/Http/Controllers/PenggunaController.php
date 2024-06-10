<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $param['title'] = 'List Recipient';
        $query = Recipient::when($search,function($query) use ($search) {
            $query->where('name','like','%'.$search.'%');
        })->latest();
        $param['data'] = $query->paginate(10);

        $title = 'Delete Recipient!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('penerima.index',$param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if ($validateData->fails()) {
            $html = "<ol class='max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400'>";
            foreach($validateData->errors()->getMessages() as $error) {
                $html .= "<li>$error[0]</li>";
            }
            $html .= "</ol>";

            alert()->html('Terjadi kesalahan eror!', $html, 'error')->autoClose(5000);
            return redirect()->route('pengguna.index');
        }
        try {
            $tambah = new Recipient;
            $tambah->name = $request->get('name');
            $tambah->nak = $request->get('nak');
            $tambah->nik = $request->get('nik');
            $tambah->departemen = $request->get('departemen');
            $tambah->bagian = $request->get('bagian');
            $tambah->status = $request->get('status');

            $tambah->save();

            alert()->success('Sukses','Berhasil menambahkan data.');
            return redirect()->route('pengguna.index');

        } catch (Exception $th) {
            alert()->error('Error','Terjadi Kesalahan');
            return redirect()->route('pengguna.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $data = Recipient::find($request->get('id'));
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $data = Recipient::find($request->get('id'));
        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if ($validateData->fails()) {
            $html = "<ol class='max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400'>";
            foreach($validateData->errors()->getMessages() as $error) {
                $html .= "<li>$error[0]</li>";
            }
            $html .= "</ol>";

            alert()->html('Terjadi kesalahan eror!', $html, 'error')->autoClose(5000);
            return redirect()->route('pengguna.index');
        }
        try {
            $edit = Recipient::find($request->get('id'));
            $edit->name = $request->get('name');
            $edit->status = $request->get('status');

            $edit->update();

            alert()->warning('Perhatian','Berhasil mengganti data.');
            return redirect()->route('pengguna.index');

        } catch (Exception $th) {
            alert()->error('Error','Terjadi Kesalahan');
            return redirect()->route('pengguna.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Recipient::find($id)->delete();
        alert()->success('Sukses','Berhasil dihapus.');
        return redirect()->route('pengguna.index');
    }
}
