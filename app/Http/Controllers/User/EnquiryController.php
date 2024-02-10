<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnquiryController extends Controller
{

    public function store(CreateEnquiryRequest $request)
    {
        try {
            DB::beginTransaction();
            $enquiry = Enquiry::create($request->all());
            DB::commit();
            return $this->sendResponse($enquiry);
        } catch (\Throwable $e) {
            DB::rollback();
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }
}
