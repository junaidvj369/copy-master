<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceCreateRequest;
use App\Http\Requests\Admin\ServiceUpdateRequest;
use App\Repositories\Admin\ServiceTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceTypeController extends Controller
{
    public $serviceTypeRepo;

    public function __construct(ServiceTypeRepository $serviceTypeRepo)
    {
        $this->serviceTypeRepo = $serviceTypeRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('service.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = $this->serviceTypeRepo->getCreateData();

            return view('service.add', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return redirect()->route('admin.service.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $service = $this->serviceTypeRepo->create($request);
            DB::commit();
            return $this->sendResponse($service);
        } catch (\Throwable $e) {
            DB::rollback();
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = $this->serviceTypeRepo->getEditData($id);
            if (empty($data['service'])) {
                \App\Custom\Flash::error('service not Found');

                return redirect()->route('admin.service.index');
            }

            return view('service.edit', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            \App\Custom\Flash::error($e, 500);
            return redirect()->route('admin.service.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $service = $this->serviceTypeRepo->update($id, $request);
            DB::commit();
            if (!$service) {
                return $this->sendError('service not found', 404);
            }
            return $this->sendResponse($service);
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     try {

    //         $secretKey = $this->serviceTypeRepo->find($id);

    //         if (empty($secretKey)) {
    //             return $this->sendError('Exam Not Found', 404);
    //         }

    //         $deleted = $this->serviceTypeRepo->destroy($secretKey);

    //         return $this->sendResponse([], 'Exam Deleted Successfully');
    //     } catch (\Throwable $e) {
    //         $this->handleException($e);
    //         return $this->sendError($e, 500);
    //     }
    // }


    public function datatable(Request $request)
    {

        try {

            $responseData = $this->serviceTypeRepo->getDatatableData($request);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }
}
