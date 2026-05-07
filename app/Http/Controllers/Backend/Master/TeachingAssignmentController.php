<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Models\TeachingAssignment;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class TeachingAssignmentController extends Controller
{
    public function index()
    {
        $assignments = TeachingAssignment::with(['classRoom.school', 'subject', 'teacher.user', 'academicYear'])->get();
        $classRooms = ClassRoom::with('school')->get();
        $subjects = Subject::all();
        $teachers = Teacher::with('user')->get();
        $academicYears = AcademicYear::where('is_active', 1)->get();
        
        return view('backend.master.teaching-assignments.index', compact('assignments', 'classRooms', 'subjects', 'teachers', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_room_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'academic_year_id' => 'required',
        ]);

        // Cek duplikasi
        $exists = TeachingAssignment::where([
            'class_room_id' => $request->class_room_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'academic_year_id' => $request->academic_year_id,
        ])->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Penugasan ini sudah ada sebelumnya!');
        }

        TeachingAssignment::create($request->all());
        return redirect()->back()->with('success', 'Penugasan guru berhasil ditambahkan');
    }

    
    public function update(Request $request, $id)
    {
        $assignment = TeachingAssignment::findOrFail($id);
        
        $request->validate([
            'class_room_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'academic_year_id' => 'required',
        ]);

        // Cek duplikasi
        $exists = TeachingAssignment::where([
            'class_room_id' => $request->class_room_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'academic_year_id' => $request->academic_year_id,
        ])->where('id', '!=', $id)->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Penugasan ini sudah ada sebelumnya!');
        }

        $assignment->update($request->all());
        return redirect()->back()->with('success', 'Penugasan guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        TeachingAssignment::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Penugasan berhasil dihapus');
    }
}
