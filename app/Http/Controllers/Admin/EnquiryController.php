<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\EnquiryRepository;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public $enquiryRepo;

    public function __construct(EnquiryRepository $enquiryRepo)
    {
        $this->enquiryRepo = $enquiryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('enquiry.index');
    }

    public function datatable(Request $request)
    {

        try {

            $responseData = $this->enquiryRepo->getDatatableData($request);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }
}
