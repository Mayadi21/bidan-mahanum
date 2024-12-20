<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
            'role' => 'required|string',
            'has_account' => 'required|in:yes,no',
            'email' => 'nullable|email|unique:users,email|required_if:has_account,yes',
            'password' => 'nullable|string|min:8|confirmed|required_if:has_account,yes',
            'gaji_pokok' => 'nullable|integer|required_if:role,pegawai|min:0',
        ]);
    
        try {
            // Persiapkan parameter untuk procedure
            $hashedPassword = $request->has_account === 'yes' ? Hash::make($request->password) : null;
            $tanggalInput = Carbon::now()->toDateString();
            DB::statement("SET @modifier_id = ?", [auth()->id()]);

            // Panggil procedure MySQL
            DB::statement('CALL add_user(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->nama,                // p_nama
                $request->alamat,              // p_alamat
                $request->tanggal_lahir,       // p_tanggal_lahir
                $request->pekerjaan,           // p_pekerjaan
                $request->no_hp,               // p_no_hp
                $request->role,                // p_role
                $request->has_account === 'yes' ? $request->email : null, // p_email
                $hashedPassword,               // p_password
                $request->role === 'pegawai' ? $request->gaji_pokok : null, // p_gaji_pokok
                $tanggalInput                  // p_tanggal_input
            ]);
    
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
