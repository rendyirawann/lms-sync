<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('backend.master.schools.index', compact('schools'));
    }

    public function store(Request $request)
    {
        School::create($request->all());
        return redirect()->back()->with('success', 'Sekolah berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = School::findOrFail($id);
        $item->update($request->all());
        return redirect()->back()->with('success', 'Sekolah berhasil diupdate');
    }

    public function destroy($id)
    {
        School::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Sekolah berhasil dihapus');
    }
}
