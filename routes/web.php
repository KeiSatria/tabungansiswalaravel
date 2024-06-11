<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

// Route untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk registrasi, login, dan logout

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware untuk memeriksa apakah pengguna telah login
Route::middleware('auth')->group(function () {

    Route::get('/users', [AdminController::class, 'Users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/register', [AdminController::class, 'showRegistrationForm'])->name('register');

    // Rute-rute admin siswa
    Route::prefix('admin/siswa')->middleware('role:admin')->group(function () {
        Route::get('/index', [AdminController::class, 'index']);
        Route::get('/', [AdminController::class, 'siswaIndex']);
        Route::get('/tambah', [AdminController::class, 'siswaTambah']);
        Route::post('/tambahdata', [AdminController::class, 'siswaTambahData']);
        Route::get('/hapus/{id}', [AdminController::class, 'siswaHapus']);
        Route::get('/edit/{id}', [AdminController::class, 'siswaEdit']);
        Route::post('/update', [AdminController::class, 'siswaUpdate']);
        Route::get('/cari', [AdminController::class, 'siswaCari']);
    });

    // Rute tabungan
    Route::prefix('admin/tabungan')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'tabunganIndex'])->name('admin.tabungan');
        Route::get('/tambah', [AdminController::class, 'tabunganTambah']);
        Route::post('/tambahdata', [AdminController::class, 'tabunganTambahData']);
        Route::get('/hapus/{id}', [AdminController::class, 'tabunganHapus']);
        Route::get('/edit/{id}', [AdminController::class, 'tabunganEdit']);
        Route::post('/update', [AdminController::class, 'tabunganUpdate']);
        Route::get('/cari', [AdminController::class, 'tabunganCari'])->name('admin/tabungan/cari');
        Route::get('/{nomor_tabungan}/detail', [AdminController::class, 'tabunganDetail'])->name('tabungan.detail');
        Route::get('/{nomor_tabungan}/detail-transaksi', [AdminController::class, 'tabunganDetailTransaksi'])->name('tabungan.detail-transaksi');
        Route::get('/{nomor_tabungan}/form-transaksi', [AdminController::class, 'tabunganFormTransaksi'])->name('formTransaksi');
        Route::post('/update-saldo', [AdminController::class, 'tabunganUpdateSaldo'])->name('transaksi');
        
    });

    Route::get('/transaksi/detail/{id}', [AdminController::class, 'transaksiDetail']);
    Route::get('/admin/datalengkap', [AdminController::class, 'dataLengkapIndex']);

    
    // Rute untuk halaman profil yang hanya bisa diakses oleh pengguna yang telah login
 
    // Rute untuk pengguna dengan peran 'user'
    Route::prefix('')->middleware(['auth', 'role:user'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/siswa', [UserController::class, 'siswaIndex']);
        Route::get('/editsiswa/{id}', [UserController::class, 'siswaEdit'])->name('user.editsiswa');
        Route::post('/update-siswa', [UserController::class, 'siswaUpdate'])->name('user.siswaUpdate');
    
    });
    

});
