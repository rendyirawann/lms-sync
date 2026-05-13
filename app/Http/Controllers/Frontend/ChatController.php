<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get unique users that have chatted with current user
        $chatLog = Chat::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $contactIds = $chatLog->map(function($chat) use ($user) {
            return $chat->sender_id == $user->id ? $chat->receiver_id : $chat->sender_id;
        })->unique();

        $recentContacts = User::whereIn('id', $contactIds)->get();

        // If student, also show all their teachers as potential contacts
        $allContacts = collect($recentContacts);
        if ($user->hasRole('Siswa')) {
            $student = $user->student;
            $classId = \App\Models\ClassStudent::where('student_id', $student->id)
                ->whereHas('academicYear', function($q) { $q->where('is_active', 1); })
                ->value('class_room_id');
            
            $teachers = User::whereHas('teacher.teachingAssignments', function($q) use ($classId) {
                $q->where('class_room_id', $classId);
            })->get();
            
            $allContacts = $allContacts->merge($teachers)->unique('id');
        }

        return view('frontend.chat.index', compact('allContacts'));
    }

    public function show($receiverId)
    {
        $user = Auth::user();
        $receiver = User::findOrFail($receiverId);

        $messages = Chat::where(function($q) use ($user, $receiverId) {
                $q->where('sender_id', $user->id)->where('receiver_id', $receiverId);
            })->orWhere(function($q) use ($user, $receiverId) {
                $q->where('sender_id', $receiverId)->where('receiver_id', $user->id);
            })->orderBy('created_at', 'asc')->get();

        // Mark as read
        Chat::where('sender_id', $receiverId)->where('receiver_id', $user->id)->update(['is_read' => true]);

        return response()->json([
            'status'   => 'success',
            'receiver' => [
                'id'         => $receiver->id,
                'name'       => $receiver->name,
                'avatar_url' => $receiver->avatar_url,
            ],
            'messages' => $messages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:5000'
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $chat
        ]);
    }
}
