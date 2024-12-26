<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class DashboardController extends Controller
{
    public function index()
    {
          // Fetch data from the database
        $data['totalUsers'] = User::count(); // Count of users
  
        return view('dashboard',$data);
    }
   
}
