<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\School;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classRooms = ClassRoom::with('school')->get();
        $schools = School::all();
        return view('backend.master.class-rooms.index', compact('classRooms', 'schools'));
    }

    public function store(Request $request)
    {
        ClassRoom::create($request->all());
        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = ClassRoom::findOrFail($id);
        $item->update($request->all());
        return redirect()->back()->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy($id)
    {
        ClassRoom::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Kelas berhasil dihapus');
    }
}
