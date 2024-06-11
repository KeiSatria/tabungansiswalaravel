<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = DB::table('siswa')->where('nama', $user->name)->first();
        $tabungan = DB::table('tabungan')->where('nama', $user->name)->first();

        if (!$siswa || !$tabungan) {
            return redirect('/user')->with('error', 'Data tidak ditemukan.');
        }

        return view('user.index', [
            'user' => $user,
            'siswa' => $siswa,
            'tabungan' => $tabungan,
        ]);
    }
    public function siswaIndex()
    {
        $siswa = DB::table('siswa')->orderBy('nama', 'asc')->get();
        return view('user.tabelsiswa', ['siswa' => $siswa]);
    }


    public function siswaEdit($id)
    {
        $siswa = DB::table('siswa')->where('nisn', $id)->first();
        return view('user.editsiswa', ['siswa' => $siswa]);
    }

    public function siswaUpdate(Request $request)
    {
        $user = Auth::user();
        $oldName = $user->name;
        $newName = $request->nama;

        // Update data siswa
        DB::table('siswa')->where('nisn', $request->id)->update([
            'nama' => $newName,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        // Update data tabungan
        DB::table('tabungan')->where('nama', $oldName)->update([
            'nama' => $newName,
        ]);

        // Update nama di tabel users
        DB::table('users')->where('name', $oldName)->update([
            'name' => $newName,
        ]);

        // Update nama di sesi pengguna
        $user->name = $newName;
        $user->save();

        return redirect('/user')->with('success', 'Data berhasil diubah.');
    }
}
