<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Repositories\exam\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SubjectController extends Controller
{
    public $subjectRepo;

    public function __construct(SubjectRepository $subjectRepo) {
        $this->subjectRepo = $subjectRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subject.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = $this->subjectRepo->getCreateData();

            return view('subject.add', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return redirect()->route('admin.subject.index');
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
            $subject = $this->subjectRepo->create($request);
            DB::commit();
            return $this->sendResponse($subject);
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
            $data = $this->subjectRepo->getEditData($id);
            if (empty($data['subject'])) {
                \App\Custom\Flash::error('Subject not Found');

                return redirect()->route('admin.subject.index');
            }

            return view('subject.edit', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            \App\Custom\Flash::error($e, 500);
            return redirect()->route('admin.subject.index');
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
            $subject = $this->subjectRepo->update($id, $request);
            DB::commit();
            if (!$subject) {
                return $this->sendError('Subject not found', 404);
            }
            return $this->sendResponse($subject);
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

            $subject = $this->subjectRepo->find($id);

            if (empty($subject)) {
                return $this->sendError('Subject Not Found', 404);
            }

            $deleted = $this->subjectRepo->destroy($subject);

            return $this->sendResponse([], 'Subject Deleted Successfully');
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }


    public function datatable(Request $request)
    {

        try {

            $responseData = $this->subjectRepo->getDatatableData($request);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }
}
