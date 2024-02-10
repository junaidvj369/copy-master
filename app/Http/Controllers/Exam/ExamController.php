<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Repositories\exam\ExamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public $examRepo;

    public function __construct(ExamRepository $examRepo) {
        $this->examRepo = $examRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exam.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = $this->examRepo->getCreateData();

            return view('exam.add', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return redirect()->route('admin.exam.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $secretKey = $this->examRepo->create($request);
            DB::commit();
            return $this->sendResponse($secretKey);
        } catch (\Throwable $e) {
            DB::rollback();
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
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
            $data = $this->examRepo->getEditData($id);
            if (empty($data['exam'])) {
                \App\Custom\Flash::error('Exam not Found');

                return redirect()->route('admin.exam.index');
            }

            return view('exam.edit', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            \App\Custom\Flash::error($e, 500);
            return redirect()->route('admin.exam.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $secretKey = $this->examRepo->update($id, $request);
            DB::commit();
            if (!$secretKey) {
                return $this->sendError('Exam not found', 404);
            }
            return $this->sendResponse($secretKey);
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
    public function destroy($id)
    {
        try {

            $secretKey = $this->examRepo->find($id);

            if (empty($secretKey)) {
                return $this->sendError('Exam Not Found', 404);
            }

            $deleted = $this->examRepo->destroy($secretKey);

            return $this->sendResponse([], 'Exam Deleted Successfully');
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }


    public function datatable(Request $request)
    {

        try {

            $responseData = $this->examRepo->getDatatableData($request);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }
}
