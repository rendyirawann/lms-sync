<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return view('backend.master.teachers.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nip' => 'required|unique:teachers,nip',
        ]);

        try {
            DB::beginTransaction();
            
            // Buat User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->nip,
                'no_wa' => $request->phone,
                'phone' => $request->phone,
                'email_verified_at' => now(),
                'is_active' => 1,
                'password' => Hash::make($request->password),
            ]);
            
            // Set Role (Pastikan role Guru sudah ada)
            $role = Role::firstOrCreate(['name' => 'Guru', 'guard_name' => 'web']);
            $user->assignRole($role);
            
            // Buat Profil Guru
            Teacher::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
            
            DB::commit();
            return redirect()->back()->with('success', 'Guru berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'nip' => 'required|unique:teachers,nip,' . $teacher->id,
        ]);

        try {
            \DB::beginTransaction();
            
            $user = $teacher->user;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = \Hash::make($request->password);
            }
            $user->save();

            $teacher->update([
                'nip' => $request->nip,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
            
            \DB::commit();
            return redirect()->back()->with('success', 'Data Guru berhasil diperbarui');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        
        // Proteksi Hapus: Cek apakah guru sudah di-assign ke kelas
        if (\App\Models\TeachingAssignment::where('teacher_id', $id)->exists()) {
            return redirect()->back()->with('error', 'Gagal: Guru ini tidak dapat dihapus karena sudah memiliki Penugasan Mengajar. Silakan hapus penugasannya terlebih dahulu.');
        }

        if ($teacher->user) {
            $teacher->user->delete(); 
        }
        $teacher->delete();
        return redirect()->back()->with('success', 'Guru berhasil dihapus');
    }
}
