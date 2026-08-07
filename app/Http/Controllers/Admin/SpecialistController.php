<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialist;

class SpecialistController extends Controller
{
     public function index()
    {
        $specialists = Specialist::latest()->paginate(10);

        return view('admin.specialists.index', compact('specialists'));
    }

    public function create()
    {
        return view('admin.specialists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:specialists,name',
            'description' => 'nullable',
        ]);

        // Auto-assign status = 1 (Active) before creation
        $request->merge(['status' => 1]);

        Specialist::create($request->all());

        return redirect()->route('specialists.index')
                ->with('success', 'Specialist created successfully.');
    }

    public function edit(Specialist $specialist)
    {
        return view('admin.specialists.edit', compact('specialist'));
    }

   public function update(Request $request, Specialist $specialist)
    {
        $request->validate([
            'name'        => 'required|unique:specialists,name,' . $specialist->id,
            'description' => 'nullable',
            'status'      => 'required|in:1,0',
        ]);

        $specialist->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('specialists.index')
                ->with('success','Specialist updated successfully.');
    }

    
    public function destroy(Specialist $specialist)
    {
        $specialist->update([
            'status' => 0,
            'deleted_at' => now()
        ]);

        return redirect()->route('specialists.index')
            ->with('success', 'Specialist marked as inactive successfully.');
    }
}
