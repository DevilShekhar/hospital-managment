<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laboratory;
use App\Models\Department;



class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
   
    public function index()
    {
        $laboratories = Laboratory::with('department')
            ->latest()
            ->paginate(10);

        return view('admin.laboratories.index', compact('laboratories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        
        $categories = [
            'Blood Test',
            'Urine Test',
            'Hormone Test',
            'Liver Function Test',
            'Kidney Function Test',
            'Culture Test',
            'Vitamin Test',
            'Cardiac Marker',
            'Tumor Marker',
        ];

        $sampleTypes = [
            'Blood',
            'Urine',
            'Serum',
            'Plasma',
            'Saliva',
            'Stool',
            'Sputum',
            'Tissue',
            'Swab',
        ];

        $containerTypes = [
            'EDTA Tube',
            'Plain Tube',
            'Fluoride Tube',
            'Citrate Tube',
            'Urine Cup',
            'Sterile Container',
        ];

        return view('admin.laboratories.create', compact(
            'departments',
            'categories',
            'sampleTypes',
            'containerTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $validated = $request->validate([
            'lab_code'           => 'required|unique:laboratories,lab_code',
            'test_name'          => 'required|max:255',
            'department_id'      => 'required|exists:departments,id',
            'category'           => 'required',
            'sample_type'        => 'required',
            'container_type'     => 'required',
            'price'              => 'required|numeric|min:0',
            'turnaround_time'    => 'required|integer|min:1',
            'fasting_required'   => 'required|boolean',
            'home_collection'    => 'required|boolean',
            'description'        => 'nullable|string',
        ]);

        Laboratory::create($validated);

        return redirect()->route('laboratories.index')
            ->with('success', 'Laboratory Test Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laboratory $laboratory)
    {
        $laboratory->load('department');

        return view('admin.laboratories.view', compact('laboratory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laboratory $laboratory)
    {
        $departments = Department::all();

        $categories = [
            'Blood Test',
            'Urine Test',
            'Hormone Test',
            'Liver Function Test',
            'Kidney Function Test',
            'Culture Test',
            'Vitamin Test',
            'Cardiac Marker',
            'Tumor Marker',
        ];

        $sampleTypes = [
            'Blood',
            'Urine',
            'Serum',
            'Plasma',
            'Saliva',
            'Stool',
            'Sputum',
            'Tissue',
            'Swab',
        ];

        $containerTypes = [
            'EDTA Tube',
            'Plain Tube',
            'Fluoride Tube',
            'Citrate Tube',
            'Urine Cup',
            'Sterile Container',
        ];

        return view('admin.laboratories.edit', compact(
            'laboratory',
            'departments',
            'categories',
            'sampleTypes',
            'containerTypes'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laboratory $laboratory)
    {
        $validated = $request->validate([
            'lab_code'           => 'required|unique:laboratories,lab_code,' . $laboratory->id,
            'test_name'          => 'required|max:255',
            'department_id'      => 'required|exists:departments,id',
            'category'           => 'required',
            'sample_type'        => 'required',
            'container_type'     => 'required',
            'price'              => 'required|numeric|min:0',
            'turnaround_time'    => 'required|integer|min:1',
            'fasting_required'   => 'required|boolean',
            'home_collection'    => 'required|boolean',
             'status'             => 'required|boolean',
            'description'        => 'nullable|string',
           
        ]);

        $laboratory->update($validated);

        return redirect()->route('laboratories.index')
            ->with('success', 'Laboratory Test Updated Successfully.');
    }
 

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Laboratory $laboratory)
    {
        $laboratory->delete();

        return redirect()
            ->route('laboratories.index')
            ->with('success','Laboratory deleted successfully');
    }
}
