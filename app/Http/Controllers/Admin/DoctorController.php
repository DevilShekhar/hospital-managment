<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::with(['department', 'roles'])
            ->role('Doctor')
            ->latest()
            ->paginate(10);

        return view('admin.doctor.index', compact('doctors'));
    }
}