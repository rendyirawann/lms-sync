<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::all();
        return view('backend.master.academic-years.index', compact('academicYears'));
    }

    public function store(Request $request)
    {
        AcademicYear::create($request->all());
        return redirect()->back()->with('success', 'Tahun Ajaran berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = AcademicYear::findOrFail($id);
        $item->update($request->all());
        return redirect()->back()->with('success', 'Tahun Ajaran berhasil diupdate');
    }

    public function destroy($id)
    {
        AcademicYear::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Tahun Ajaran berhasil dihapus');
    }
}
