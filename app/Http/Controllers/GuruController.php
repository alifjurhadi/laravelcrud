<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $data_guru = Guru::all();
        return view('guru.index', ['data_guru' => $data_guru]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:3|max:50',
            'telpon' => 'required|min:10|max:12',
            'alamat' => 'required',
            'foto' => 'mimes:jpg,png,jpeg|max:100'
        ]);
        $guru = Guru::create($request->all());
        if ($request->has('foto')) {
            $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
            $guru->foto = $request->file('foto')->getClientOriginalName();
            $guru->save();
        }
        return redirect('/guru')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function profile($id)
    {
        $guru = Guru::find($id);
        return view('guru.profile',['guru' => $guru]);
    }

    public function editguru($id)
    {
        $guru = Guru::find($id);
        return view('guru.editguru', ['guru' => $guru]);
    }

    public function updateguru(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|min:3|max:50',
            'telpon' => 'required|min:10|max:12',
            'alamat' => 'required',
            'foto' => 'mimes:jpg,png,jpeg|max:100'
        ]);
        $guru = Guru::find($id);
        $guru->update($request->all());
        if ($request->has('foto')) {
            $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
            $guru->foto = $request->file('foto')->getClientOriginalName();
            $guru->save();
        }
        return redirect('/guru')->with('sukses', 'Data berhasil Diperbarui');
    }

    public function deleteguru($id)
    {
        $guru = Guru::find($id);
        $guru->delete();
        return redirect('/guru')->with('sukses', 'Data berhasil dihapus');
    }
}
