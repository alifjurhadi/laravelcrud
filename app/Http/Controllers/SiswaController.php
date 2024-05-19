<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Support\Str;
use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_siswa = Siswa::where('nama_depan', 'LIKE', '%'.$request->cari.'%')->get();    
        }else{
            $data_siswa = Siswa::all();
        }
        return view('siswa.index',['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nama_depan' => 'required|min:3|max:50',
            'nama_belakang' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'avatar' => 'mimes:jpg,png,jpeg|max:100'
        ]);
        // Insert ke table Users
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('12345');
        $user->remember_token = Str::random(60);
        $user->save();

        // Insert Ke Table Siswa:
        $request->request->add(['user_id' => $user->id]);
        $siswa = Siswa::create($request->all());
        if ($request->has('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
       return view('siswa.edit',['siswa' => $siswa]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $this->validate($request, [
            'nama_depan' => 'required|min:3|max:50',
            'nama_belakang' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'avatar' => 'mimes:jpg,png,jpeg|max:100'
        ]);
        $siswa->update($request->all());
        if($request->has('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data berhasil Diperbarui');
    }

    public function delete(Siswa $siswa)
    {
        $siswa->delete();
        return redirect('/siswa')->with('sukses', 'Data berhasil Dihapus');
    }

    public function profile(Siswa $siswa)
    {
        $matapelajaran = Mapel::all();

        // Menyiapkan data untuk chart
        $categories = [];
        $data = [];
        
        foreach($matapelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }

        // dd($data);

        return view('siswa.profile',['siswa' => $siswa,'matapelajaran' => $matapelajaran,'categories' => $categories,'data' => $data]);
    }

    public function addnilai(Request $request,$idsiswa)
    {
        $siswa = Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa.'/profile')->with('error','Maaf data mata pelajaran sudah ada.');
        }
        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);

        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','Data nilai berhasil dimasukkan');
    }

    public function deletemapel($idsiswa, $idmapel)
    {
        $siswa = Siswa::find($idsiswa);

        // Detach mapel dengan id yang diberikan dari siswa
        $siswa->mapel()->detach($idmapel);

        return redirect()->back()->with('sukses', 'Mapel berhasil dihapus dari data siswa');
    }

    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    public function exportPDF()
    {
        $siswa = Siswa::all();
        $pdf = Pdf::loadView('export.siswapdf',['siswa' => $siswa]);
        return $pdf->download('siswa.pdf');
    }

    public function getdatasiswa()
    {
        $siswa = Siswa::select('siswa.*')->get();

        return DataTables::of($siswa)
            ->addColumn('nama_lengkap', function ($s) {
                return '<a href="/siswa/' . $s->id . '/profile">' . $s->nama_depan . ' ' . $s->nama_belakang . '</a>';
            })
            ->addColumn('rata2_nilai', function ($s) {
                return $s->rataRataNilai();
            })
            ->addColumn('aksi', function ($s) {
                return '<a href="/siswa/' . $s->id . '/edit" class="d-flex btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></a>' .
                '<a href="#" class="btn btn-danger btn-sm delete" siswa-id="' . $s->id . '" style="margin-left: 60px; margin-top:-50px;"><i class="lnr lnr-trash"></i></a>';
            })
            ->rawColumns(['nama_lengkap', 'rata2_nilai', 'aksi'])
            ->toJson();
    }

}
