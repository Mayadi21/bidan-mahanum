<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class AdminUsersController extends Controller
{
    public function index()
    {
        if(request('status')) {
            switch(request('status')) {
                case 'tidak aktif':
                    $users = User::banned();
                    break;
                case 'aktif':
                    $users = User::aktif()->role('user');
                    break;
                case 'admin':
                    $users = User::aktif()->role('admin');
                    break;
                case 'pegawai':
                    $users = User::aktif()->role('pegawai');
                    break;
            }
        } else {
            $users = User::aktif()->role('user');
        }

        if(request('search')) {
            $users = $users->search(request('search'));
        }

        return view('dashboard.admin-users.index', [
            'page' => 'Halaman Users',
            'active' => 'admin-users',
            'users' => $users->get(),
        ]);
    }

    // Menampilkan form untuk menambah pengguna baru
    public function create()
    {
        return view('dashboard.users.create'); 
    }

    public function store(Request $request)
    {
        // Validasi form input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Validasi unique email
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'nullable|string',
            'no_hp' => 'required|string|max:15|unique:users,no_hp', // Validasi unique no_hp
            'role' => 'required|string', // Validasi role
            'password' => 'required|string|min:8|confirmed', // Validasi password
        ]);
    
        try {
            // Menyimpan pengguna baru ke database
            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pekerjaan' => $request->pekerjaan,
                'no_hp' => $request->no_hp,
                'status' => 'aktif', // Status otomatis aktif
                'role' => $request->role,
                'password' => Hash::make($request->password), // Enkripsi password
            ]);
    
            // Redirect atau memberikan response
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) { // Kode error untuk duplicate entry
                // Ambil kolom yang menyebabkan error
                $errorColumn = '';
                if (str_contains($e->getMessage(), 'users_email_unique')) {
                    $errorColumn = 'email';
                } elseif (str_contains($e->getMessage(), 'users_no_hp_unique')) {
                    $errorColumn = 'no_hp';
                }
    
                return redirect()->back()->withInput()->with(
                    'error',
                    "Gagal menambahkan pengguna! {$errorColumn} yang Anda masukkan sudah terdaftar."
                );
            }
    
            // Tangani error lain
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->input('status'); // 'aktif' atau 'tidak aktif'
        $user->save();
    
        $statusMessage = $user->status === 'aktif' ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.users.index')->with('success', "Status pengguna berhasil $statusMessage.");
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:15',
            'role' => 'required|string',
        ]);
    
        $user->update($validatedData);
    
        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }
    

    public function ban(Request $request, $username)
    {
        // Validasi input
        $request->validate([
            'report_id' => 'required|exists:reports,id',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Update report_id user
        $user->report_id = $request->input('report_id');
        $user->save();

        return redirect()->back()->with('success', 'User has been banned successfully.');
    }
    

}
