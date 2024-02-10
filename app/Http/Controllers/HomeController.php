<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $enquiryCount = Enquiry::count();
        $today = now()->format('Y-m-d');
        $todayEnquiryCount = Enquiry::whereDate('created_at', $today)->count();
        $serviceCount = ServiceType::where('status', 1)->count();
        return view('home', compact('enquiryCount', 'todayEnquiryCount', 'serviceCount'));
    }
}
