<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\MedicalRecord;


class MedicalRecordController extends Controller
{
    //
    public function create()
    {
            $patients = Patient::orderBy('first_name')->get();

        $doctors = Doctor::orderBy('first_name')->get();

        return view('admin.medical_records.create', compact(
            'patients',
            'doctors'
        ));
    }
 

    public function index(Request $request)
    {
        $search = $request->search;

            $medicalRecords = MedicalRecord::with(['patient', 'doctor'])
                ->where('is_deleted', 1)
                ->when($search, function ($query) use ($search) {
                    $query->where('record_no', 'like', "%{$search}%")
                        ->orWhere('treatment_status', 'like', "%{$search}%")
                        ->orWhereHas('patient', function ($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('doctor', function ($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

        return view('admin.medical_records.index', compact(
            'medicalRecords',
            'search'
        ));
    }
   
   
    public function store(Request $request)
    {
        $request->validate([
            'record_no' => 'required|unique:medical_records,record_no',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'visit_date' => 'required|date',
            'symptoms' => 'required',
            'diagnosis' => 'required',
            'prescription' => 'required',
            'doctor_notes' => 'nullable',
            'follow_up_date' => 'nullable|date',
            'treatment_status' => 'required',
        ]);

        MedicalRecord::create([
            'record_no' => $request->record_no,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'visit_date' => $request->visit_date,
            'symptoms' => $request->symptoms,
            'diagnosis' => $request->diagnosis,
            'prescription' => $request->prescription,
            'doctor_notes' => $request->doctor_notes,
            'follow_up_date' => $request->follow_up_date,
            'treatment_status' => $request->treatment_status,
            'is_deleted' => 1,
        ]);

        return redirect()
            ->route('medical_records.index')
            ->with('success', 'Medical Record created successfully.');
    }

    public function show($id)
    {
        $medicalRecord = MedicalRecord::with(['patient', 'doctor'])->findOrFail($id);

        return view('admin.medical_records.show', compact('medicalRecord'));
    }

    public function edit($id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);

        $patients = Patient::orderBy('first_name')->get();

        $doctors = Doctor::orderBy('first_name')->get();

        return view('admin.medical_records.edit', compact(
            'medicalRecord',
            'patients',
            'doctors'
        ));
    }

   public function update(Request $request, $id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);

        $request->validate([
            'record_no' => 'required|unique:medical_records,record_no,' . $id,
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'visit_date' => 'required|date',
            'symptoms' => 'required',
            'diagnosis' => 'required',
            'prescription' => 'required',
            'doctor_notes' => 'nullable',
            'follow_up_date' => 'nullable|date',
            'treatment_status' => 'required',
        ]);

        $medicalRecord->update([
            'record_no' => $request->record_no,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'visit_date' => $request->visit_date,
            'symptoms' => $request->symptoms,
            'diagnosis' => $request->diagnosis,
            'prescription' => $request->prescription,
            'doctor_notes' => $request->doctor_notes,
            'follow_up_date' => $request->follow_up_date,
            'treatment_status' => $request->treatment_status,
        ]);

        return redirect()
            ->route('medical_records.index')
            ->with('success', 'Medical Record updated successfully.');
}

   public function destroy($id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);

        $medicalRecord->update([
            'is_deleted' => 0,
        ]);

        return redirect()
            ->route('medical_records.index')
            ->with('success', 'Medical Record deleted successfully.');
    }
   
    
    
    
}
    
    

