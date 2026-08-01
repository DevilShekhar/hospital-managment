<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Doctor;


class DoctorController extends Controller
{
    
   public function index()
    {
        $doctors = Doctor::with('department')
                    ->latest()
                    ->paginate(10);

        return view('admin.doctor.index', compact('doctors'));
    }

   

    
     

}
