<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Break_;

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
                case 'null':
                    $users = User::aktif()->WhereNull('email');
                    break;
                case 'not null':
                    $users = User::aktif()->whereNotNull('email');
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
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'nullable|string',
            'no_hp' => 'required|string|max:15|unique:users,no_hp',
            'has_account' => 'required|in:yes,no',
            'email' => 'nullable|email|unique:users,email|required_if:has_account,yes',
            'password' => 'nullable|string|min:8|confirmed|required_if:has_account,yes',
        ]);
    
        try {
            // Menyimpan pengguna baru ke database
            DB::statement("SET @modifier_id = ?", [auth()->id()]);

            $user = new User([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pekerjaan' => $request->pekerjaan,
                'no_hp' => $request->no_hp,
                'status' => 'aktif', // Status otomatis aktif
            ]);
    
            // Tambahkan data akun jika pasien memiliki akun
            if ($request->has_account === 'yes') {
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
            }
    
            $user->save();
    
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
    

    public function updateStatus(Request $request, $id)
    {
        DB::statement("SET @modifier_id = ?", [auth()->id()]);
        $user = User::findOrFail($id);
        $user->status = $request->input('status'); // 'aktif' atau 'tidak aktif'
        $user->save();
    
        $statusMessage = $user->status === 'aktif' ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.users.index')->with('success', "Status pengguna berhasil $statusMessage.");
    }
    
    public function update(Request $request, $id)
    {
        DB::statement("SET @modifier_id = ?", [auth()->id()]);
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
