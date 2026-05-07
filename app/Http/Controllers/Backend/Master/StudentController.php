<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'school'])->get();
        $schools = School::all();
        return view('backend.master.students.index', compact('students', 'schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nisn' => 'required|unique:students,nisn',
            'school_id' => 'required'
        ]);

        try {
            DB::beginTransaction();
            
            // Buat User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->nisn,
                'no_wa' => $request->phone,
                'phone' => $request->phone,
                'email_verified_at' => now(),
                'is_active' => 1,
                'password' => Hash::make($request->password),
            ]);
            
            // Set Role
            $role = Role::firstOrCreate(['name' => 'Siswa', 'guard_name' => 'web']);
            $user->assignRole($role);
            
            // Buat Profil Siswa
            Student::create([
                'user_id' => $user->id,
                'school_id' => $request->school_id,
                'nisn' => $request->nisn,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
            
            DB::commit();
            return redirect()->back()->with('success', 'Siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'nisn' => 'required|unique:students,nisn,' . $student->id,
            'school_id' => 'required'
        ]);

        try {
            \DB::beginTransaction();
            
            $user = $student->user;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = \Hash::make($request->password);
            }
            $user->save();

            $student->update([
                'school_id' => $request->school_id,
                'nisn' => $request->nisn,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
            
            \DB::commit();
            return redirect()->back()->with('success', 'Data Siswa berhasil diperbarui');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        if ($student->user) {
            $student->user->delete(); 
        }
        $student->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus');
    }
}
