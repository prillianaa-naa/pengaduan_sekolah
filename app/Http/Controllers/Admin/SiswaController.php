<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display list of students
     */
    public function index()
    {
        $siswas = Siswa::latest()->paginate(10);
        return view('admin.siswa.index', compact('siswas'));
    }

    /**
     * Store new student
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:siswas,nis|max:20',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:50',
            'password' => 'required|min:6',
        ]);

        Siswa::create([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'kelas' => $validated['kelas'],
            'password' => Hash::make($validated['password']),
        ]);

        // Return JSON for AJAX, redirect for form
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', '✅ Siswa berhasil ditambahkan');
    }

    /**
     * Update student
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        
        if (!$siswa) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }
            return redirect()->back()->with('error', '❌ Data tidak ditemukan');
        }
        
        $validated = $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $siswa->id . '|max:20',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:50',
            'password' => 'nullable|min:6',
        ]);

        $updateData = [
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'kelas' => $validated['kelas'],
        ];
        
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $siswa->update($updateData);

        // Return JSON for AJAX, redirect for form
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', '✅ Siswa berhasil diupdate');
    }

    /**
     * Delete student
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        
        if (!$siswa) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        
        $siswa->delete();
        
        return response()->json(['success' => true]);
    }
}