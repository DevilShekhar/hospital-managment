<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Prescription;


class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prescription::with([
            'patient',
            'doctor',
            'medicalRecord'
        ])
        ->where('status',1);


        // Search
        if ($request->search) {

            $search = $request->search;

            $query->where(function($q) use ($search){

                $q->where('medicine','LIKE','%'.$search.'%')

                ->orWhereHas('patient', function($patient) use ($search){

                        $patient->where('first_name','LIKE','%'.$search.'%')
                                ->orWhere('last_name','LIKE','%'.$search.'%');

                })

                ->orWhereHas('doctor', function($doctor) use ($search){

                        $doctor->where('first_name','LIKE','%'.$search.'%')
                            ->orWhere('last_name','LIKE','%'.$search.'%');

                });

            });

        }


        $prescriptions = $query
                            ->latest()
                            ->paginate(10)
                            ->withQueryString();


        return view('admin.prescriptions.index',
            compact('prescriptions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::orderBy('first_name')->get();

        $doctors = Doctor::orderBy('first_name')->get();

        $medicalRecords = MedicalRecord::all();

        return view('admin.prescriptions.create', compact(
            'patients',
            'doctors',
            'medicalRecords'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        $patients = Patient::orderBy('first_name')->get();

        $doctors = Doctor::orderBy('first_name')->get();

        $medicalRecords = MedicalRecord::all();


        return view('admin.prescriptions.edit', compact(
            'prescription',
            'patients',
            'doctors',
            'medicalRecords'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([

            'patient_id' => 'required|exists:patients,id',

            'doctor_id' => 'required|exists:doctors,id',

            'medical_record_id' => 'nullable|exists:medical_records,id',

            'medicine' => 'required|string|max:255',

            'dosage' => 'nullable|string|max:255',

            'duration' => 'nullable|string|max:255',

            'instructions' => 'nullable|string',

            'status' => 'required|in:0,1',

        ]);


        $prescription->update([

            'patient_id' => $request->patient_id,

            'doctor_id' => $request->doctor_id,

            'medical_record_id' => $request->medical_record_id,

            'medicine' => $request->medicine,

            'dosage' => $request->dosage,

            'duration' => $request->duration,

            'instructions' => $request->instructions,

            'status' => $request->status,

        ]);


        return redirect()
            ->route('prescriptions.index')
            ->with('success','Prescription updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->update([
            'status' => 0
        ]);

        return redirect()
            ->route('prescriptions.index')
            ->with('success','Prescription deleted successfully');
    }
}
