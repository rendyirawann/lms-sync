<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\School;
use App\Models\Subject;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use App\Models\TeachingAssignment;
use App\Models\Schedule;
use App\Models\ClassStudent;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DemoAccountSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Permission Dasar
        $permissions = [
            'module.view', 'module.create', 'module.edit', 'module.delete',
            'attendance.view', 'attendance.create',
            'assignment.view', 'assignment.create', 'assignment.submit'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Buat Role (Pastikan Case-Sensitive sesuai DB)
        $roleGuru = Role::firstOrCreate(['name' => 'Guru']);
        $roleSiswa = Role::firstOrCreate(['name' => 'Siswa']);

        $roleGuru->syncPermissions([
            'module.view', 'module.create', 'module.edit', 'module.delete',
            'attendance.view', 'attendance.create',
            'assignment.view', 'assignment.create'
        ]);

        $roleSiswa->syncPermissions([
            'module.view', 'attendance.view', 'assignment.view', 'assignment.submit'
        ]);

        // 3. Ambil Data Master Pendukung
        $school = School::first();
        $subject = Subject::first();
        $class = ClassRoom::first();
        $academicYear = AcademicYear::where('is_active', 1)->first();

        // 4. Buat Akun Guru Demo
        $userGuru = User::updateOrCreate(
            ['email' => 'guru@lms.com'],
            [
                'name' => 'Bpk. Budi Santoso, S.Pd',
                'username' => 'budi_guru',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $userGuru->assignRole($roleGuru);

        $teacher = Teacher::updateOrCreate(
            ['user_id' => $userGuru->id],
            [
                'nip' => '198501012010011001',
                'phone' => '081234567890',
                'gender' => 'L',
                'address' => 'Jl. Pendidikan No. 123, Medan'
            ]
        );

        // --- PLOTING GURU (Agar Dropdown Isi) ---
        if ($teacher && $subject && $class && $academicYear) {
            TeachingAssignment::updateOrCreate(
                [
                    'teacher_id' => $teacher->id,
                    'subject_id' => $subject->id,
                    'class_room_id' => $class->id,
                    'academic_year_id' => $academicYear->id
                ]
            );
        }

        // 5. Buat Akun Siswa Demo
        $userSiswa = User::updateOrCreate(
            ['email' => 'siswa@lms.com'],
            [
                'name' => 'Rendy Irawan (Student)',
                'username' => 'rendy_student',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $userSiswa->assignRole($roleSiswa);

        $student = Student::updateOrCreate(
            ['user_id' => $userSiswa->id],
            [
                'school_id' => $school ? $school->id : null,
                'nisn' => '0012345678',
                'phone' => '089876543210',
                'gender' => 'L',
                'address' => 'Jl. Pelajar No. 45, Medan'
            ]
        );

        // --- PLOTING SISWA KE KELAS ---
        if ($student && $class && $academicYear) {
            ClassStudent::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'class_room_id' => $class->id,
                    'academic_year_id' => $academicYear->id
                ]
            );
        }

        // --- BUAT JADWAL DEMO ---
        $assignment = TeachingAssignment::where('teacher_id', $teacher->id)->first();
        if ($assignment) {
            for ($i = 1; $i <= 5; $i++) {
                Schedule::updateOrCreate(
                    [
                        'teaching_assignment_id' => $assignment->id,
                        'day_of_week' => $i,
                    ],
                    [
                        'start_time' => '08:00:00',
                        'end_time' => '10:00:00',
                        'is_active' => true
                    ]
                );
            }
        }

        $this->command->info('Demo accounts & Plotting created successfully!');
    }
}
