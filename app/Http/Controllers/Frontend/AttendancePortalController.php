<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceSetting;
use App\Models\Schedule;
use App\Models\TeachingAssignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendancePortalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = Carbon::now();
        $dayOfWeek = $now->dayOfWeekIso; // 1-7

        $settings = AttendanceSetting::first();
        
        // Get Student and their Class
        $student = $user->student;
        $classIds = $student->classStudents->pluck('class_room_id');

        // Check Daily Attendance (Datang/Pulang)
        $arrival = Attendance::where('user_id', $user->id)
            ->where('type', 'datang')
            ->whereDate('created_at', $today)
            ->first();

        $departure = Attendance::where('user_id', $user->id)
            ->where('type', 'pulang')
            ->whereDate('created_at', $today)
            ->first();

        // Get Schedules for Today based on Student's Classes
        $schedules = Schedule::with(['teachingAssignment.subject', 'teachingAssignment.teacher'])
            ->whereIn('teaching_assignment_id', function($query) use ($classIds) {
                $query->select('id')
                    ->from('teaching_assignments')
                    ->whereIn('class_room_id', $classIds);
            })
            ->where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->get();

        // Check which subjects have been attended
        foreach ($schedules as $s) {
            $s->is_attended = Attendance::where('user_id', $user->id)
                ->where('type', 'mapel')
                ->where('schedule_id', $s->id)
                ->whereDate('created_at', $today)
                ->exists();
            
            // Check if within time window
            $startTime = Carbon::createFromFormat('H:i:s', $s->start_time);
            $endTime = Carbon::createFromFormat('H:i:s', $s->end_time);
            $s->can_attend = $now->between($startTime, $endTime);
            $s->is_late = $now->gt($endTime);
        }

        return view('frontend.attendance.index', compact('settings', 'arrival', 'departure', 'schedules', 'now'));
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $type = $request->type;
        $now = Carbon::now();
        $today = Carbon::today();
        $settings = AttendanceSetting::first();

        if ($type == 'datang') {
            $start = Carbon::createFromFormat('H:i:s', $settings->arrival_start);
            $end = Carbon::createFromFormat('H:i:s', $settings->arrival_end);

            if (!$now->between($start, $end)) {
                return response()->json(['message' => 'Batas waktu absen datang adalah ' . $settings->arrival_start . ' - ' . $settings->arrival_end], 422);
            }

            Attendance::create([
                'user_id' => $user->id,
                'type' => 'datang',
                'status' => 'hadir',
                'attended_at' => $now
            ]);
        } 
        elseif ($type == 'pulang') {
            $arrival = Attendance::where('user_id', $user->id)->where('type', 'datang')->whereDate('created_at', $today)->first();
            if (!$arrival) {
                return response()->json(['message' => 'Anda belum melakukan absen datang hari ini.'], 422);
            }

            $start = Carbon::createFromFormat('H:i:s', $settings->departure_start);
            if ($now->lt($start)) {
                return response()->json(['message' => 'Absen pulang baru bisa dilakukan setelah jam ' . $settings->departure_start], 422);
            }

            Attendance::create([
                'user_id' => $user->id,
                'type' => 'pulang',
                'status' => 'hadir',
                'attended_at' => $now
            ]);
        } 
        elseif ($type == 'mapel') {
            $scheduleId = $request->schedule_id;
            $schedule = Schedule::findOrFail($scheduleId);
            
            $startTime = Carbon::createFromFormat('H:i:s', $schedule->start_time);
            $endTime = Carbon::createFromFormat('H:i:s', $schedule->end_time);

            if (!$now->between($startTime, $endTime)) {
                return response()->json(['message' => 'Anda hanya bisa absen pada jam pelajaran berlangsung.'], 422);
            }

            Attendance::create([
                'user_id' => $user->id,
                'type' => 'mapel',
                'schedule_id' => $scheduleId,
                'status' => 'hadir',
                'attended_at' => $now
            ]);
        }

        return response()->json(['message' => 'Absensi berhasil tercatat!']);
    }

    public function timetable()
    {
        $user = Auth::user();
        $student = $user->student;
        $classIds = $student->classStudents->pluck('class_room_id');

        $schedules = Schedule::with(['teachingAssignment.subject', 'teachingAssignment.teacher', 'teachingAssignment.classRoom'])
            ->whereIn('teaching_assignment_id', function($query) use ($classIds) {
                $query->select('id')
                    ->from('teaching_assignments')
                    ->whereIn('class_room_id', $classIds);
            })
            ->where('is_active', true)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        return view('frontend.attendance.timetable', compact('schedules'));
    }
}
