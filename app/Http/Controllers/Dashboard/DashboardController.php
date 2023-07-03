<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboard(){
        // $total_services = Service::where('status', 1)->count();
        // $total_blogs = Blog::where('status', 1)->count();
        // $total_candidates = Candidate::where('status', 1)->count();
        // $total_products = Product::where('status', 1)->count();

        // return view('content.dashboard.dashboard')->with(['total_services' => $total_services, 'total_blogs' => $total_blogs, 'total_candidates' => $total_candidates, 'total_products' => $total_products  ]);
        return view('content.dashboard.dashboard')->with(['total_services' => 0, 'total_blogs' => 0, 'total_candidates' => 0, 'total_products' => 0  ]);
    }
}
