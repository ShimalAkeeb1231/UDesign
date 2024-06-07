<?php

namespace App\Http\Controllers;

use App\Models\CustomerProfile;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customerProfiles = CustomerProfile::paginate(10);
        return view('admin.customer.index', compact('customerProfiles'));
    }

    // Other methods...
}
