<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
class AdminController extends Controller
{
    // Fungsi untuk menampilkan halaman utama admin
    public function index()
    {
        return view('admin.index');
    }

    public function viewPdf()
    {
        $data_lengkap = DB::table('data_lengkap')->orderBy('nama', 'asc')->get();
        $pdf = PDF::loadView('admin.tabeltabunganasli', ['data_lengkap' => $data_lengkap]);
        return $pdf->stream('data_lengkap.pdf');
    }
    public function dataLengkapIndex()
    {
        $datalengkap = DB::table('data_lengkap')->orderBy('nama', 'asc')->get();
        return view('admin.tabeltabunganasli', ['data_lengkap' => $datalengkap]);
    }
    public function Users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully');
    }
    
    // Fungsi untuk menampilkan daftar siswa
    public function siswaIndex()
    {
        $siswa = DB::table('siswa')->orderBy('nama', 'asc')->get();
        return view('admin.tabelsiswa', ['siswa' => $siswa]);
    }

    // Fungsi untuk menampilkan form tambah siswa
    public function siswaTambah()
    {
        $opt = DB::table('siswa')->select('nisn')->get();
        return view('admin.tambahsiswa', ['opt' => $opt]);
    }

    // Fungsi untuk menyimpan data siswa baru
    public function siswaTambahData(Request $request)
    {
        DB::table('siswa')->insert([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
        ]);
        return redirect('/admin/siswa');
    }

    // Fungsi untuk menghapus data siswa
    public function siswaHapus($id)
    {
        DB::table('siswa')->where('nisn', $id)->delete();
        return redirect('/admin/siswa')->with('success', 'Data berhasil dihapus');
    }

    // Fungsi untuk menampilkan form edit siswa
    public function siswaEdit($id)
    {
        $siswa = DB::table('siswa')->where('nisn', $id)->get();
        return view('admin.editsiswa', ['siswa' => $siswa]);
    }

    // Fungsi untuk mengupdate data siswa
    public function siswaUpdate(Request $request)
    {
        DB::table('siswa')->where('nisn', $request->id)->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
        ]);
        return redirect('/admin/siswa');
    }

    // Fungsi untuk mencari data siswa// Fungsi untuk mencari data siswa
public function siswaCari(Request $request)
{
    $cari = $request->cari;
    $siswa = DB::table('siswa')->where('nama', 'like', "%$cari%")->get();
    return view('admin.tabelsiswa', ['siswa' => $siswa]);
}


    // Fungsi untuk menampilkan daftar tabungan
    public function tabunganIndex()
    {
        $tabungan = DB::table('tabungan')->orderBy('nama', 'asc')->get();
        return view('admin.tabeltabungan', compact('tabungan'));
    }

    // Fungsi untuk menampilkan form tambah tabungan
    public function tabunganTambah()
    {
        $nomor_tabungan = $this->getNextNomorTabungan();
        $opt = DB::table('siswa')->select('nisn', 'nama')->get();
        return view('admin.tambahtabungan', ['nomor_tabungan' => $nomor_tabungan, 'opt' => $opt]);
    }

 
// Fungsi untuk menyimpan data tabungan baru
public function tabunganTambahData(Request $request)
{
    $nomor_tabungan = $this->getNextNomorTabungan();

    // Simpan data transaksi ke dalam tabel 'tabungan'
    DB::table('tabungan')->insert([
        'nomor_tabungan' => $nomor_tabungan,
        'saldo' => $request->saldo,
        'nama' => $request->nama,
          // Pastikan ini sesuai dengan nama kolom yang benar di tabel 'tabungan'
    ]);
 

    return redirect('/admin/tabungan')->with('success', 'Data berhasil ditambahkan.');
}


    private function getNextNomorTabungan()
    {
        $lastTabungan = DB::table('tabungan')->orderBy('nomor_tabungan', 'desc')->first();

        if ($lastTabungan) {
            // Ambil nomor tabungan terakhir, misal "T001", kemudian tambahkan satu digit
            $lastNumber = (int) substr($lastTabungan->nomor_tabungan, 1);
            $nextNumber = $lastNumber + 1;
            return 'T' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada nomor tabungan sebelumnya, mulai dari T001
            return 'T001';
        }
    }

    // Fungsi untuk menghapus data tabungan
    public function tabunganHapus($id)
    {
        DB::table('tabungan')->where('nomor_tabungan', $id)->delete();
        return redirect('/admin/tabungan')->with('success', 'Data berhasil dihapus');
    }

    // Fungsi untuk menampilkan form edit tabungan
    public function tabunganEdit($id)
    {
        $tabungan = DB::table('tabungan')->where('nomor_tabungan', $id)->get();
        return view('admin.edittabungan', ['tabungan' => $tabungan]);
    }

    // Fungsi untuk mengupdate data tabungan
    public function tabunganUpdate(Request $request)
    {
        DB::table('tabungan')->where('nomor_tabungan', $request->id)->update([
            'nomor_tabungan' => $request->nomor_tabungan,
            'nama' => $request->nama,
            'saldo' => $request->saldo,
        ]);
        return redirect('/admin/tabungan');
    }

    // Fungsi untuk mencari data tabungan
    public function tabunganCari(Request $request)
    {
        $cari = $request->cari;
        $tabungan = DB::table('tabungan')->where('nama', 'like', "%$cari%")->get();
        return view('admin.tabeltabungan', ['tabungan' => $tabungan]);
    }
    

    // Fungsi untuk menampilkan detail tabungan
    public function tabunganDetail($nomor_tabungan)
    {
        $tabungan = DB::table('tabungan')->where('nomor_tabungan', $nomor_tabungan)->first();
        if (!$tabungan) {
            return redirect()->route('admin.tabungan')->with('error', 'Tabungan tidak ditemukan');
        }
        $details = DB::table('detail')->where('nomor_tabungan', $nomor_tabungan)->orderBy('tanggal', 'desc')->first();
        return view('admin.detail_tabungan', compact('tabungan', 'details'));
    }

    // Fungsi untuk menampilkan detail transaksi tabungan
    public function tabunganDetailTransaksi($nomor_tabungan)
    {
        $detail = DB::table('detail')->where(
            'nomor_tabungan',
            $nomor_tabungan
        )->orderByDesc('tanggal')->first();
        if (!$detail) {
            return view('errors.404');
        }
        return view('admin.detail_transaksi', compact('detail'));
    }

    // Fungsi untuk menampilkan form transaksi tabungan
    public function tabunganFormTransaksi($nomor_tabungan)
    {
        $tabungan = DB::table('tabungan')->where('nomor_tabungan', $nomor_tabungan)->first();
        return view('admin.form_transaksi', compact('tabungan'));
    }
    public function tabunganUpdateSaldo(Request $request)
    {
        $request->validate([
            'nomor_tabungan' => 'required',
            'histori' => 'required',
            'nominal' => 'required|numeric|min:0',
        ]);
    
        $nomor_tabungan = $request->input('nomor_tabungan');
        $histori = $request->input('histori');
        $nominal = $request->input('nominal');
    
        $tabungan = DB::table('tabungan')->where('nomor_tabungan', $nomor_tabungan)->first();
    
        if (!$tabungan) {
            return back()->withErrors(['msg' => 'Tabungan tidak ditemukan.']);
        }
    
        $saldo_awal = $tabungan->saldo;
        $saldo_akhir = $saldo_awal;
    
        if ($histori == 'Penarikan') {
            if ($nominal > $saldo_awal) {
                return back()->withInput()->with('error', 'Maaf, saldo tidak mencukupi untuk penarikan.');
            }
            $saldo_akhir -= $nominal;
        } else {
            $saldo_akhir += $nominal;
        }
    
        // Update saldo tabungan
        DB::table('tabungan')->where('nomor_tabungan', $nomor_tabungan)->update(['saldo' => $saldo_akhir]);
    
        // Simpan histori transaksi ke dalam tabel detail
        DB::table('detail')->insert([
            'nomor_tabungan' => $nomor_tabungan,
            'histori' => $histori,
            'nominal' => $nominal,
            'tanggal' => now(),
            'saldo_awal' => $saldo_awal,
            'saldo_akhir' => $saldo_akhir,
        ]);
    
        return redirect()->route('admin.tabungan')->with('success', 'Transaksi berhasil dilakukan.');
    }
    
    public function showRegistrationForm()
    {
        $siswa = DB::table('siswa')->orderBy('nama', 'asc')->get();
        return view('admin.register', ['siswa' => $siswa]);
    }

    // Fungsi untuk menampilkan detail transaksi
    public function transaksiDetail($id)
    {
        $transaksi = DB::table('transaksi')->where('id_transaksi', $id)->first();
        return view('transaksi.detail', ['transaksi' => $transaksi]);
    }
    
}
