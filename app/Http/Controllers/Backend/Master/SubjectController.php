<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('backend.master.subjects.index', compact('subjects'));
    }

    public function store(Request $request)
    {
        Subject::create($request->all());
        return redirect()->back()->with('success', 'Pelajaran berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = Subject::findOrFail($id);
        $item->update($request->all());
        return redirect()->back()->with('success', 'Pelajaran berhasil diupdate');
    }

    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pelajaran berhasil dihapus');
    }
}
