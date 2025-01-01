<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Sales;
class DashboardController extends Controller
{
    public function index()
    {
          // Fetch data from the database
        $data['totalProducts'] = Product::count(); // Count of total products
        $data['activeUsers'] = User::where('status', '1')->count(); // Count of active users
        $data['totalSale'] = Sales::count();
  
        return view('dashboard',$data);
    }
   
}
