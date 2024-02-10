<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Repositories\exam\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public $questionRepo;

    public function __construct(QuestionRepository $questionRepo) {
        $this->questionRepo = $questionRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('question.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = $this->questionRepo->getCreateData();

            return view('question.add', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return redirect()->route('admin.question.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $secretKey = $this->questionRepo->create($request);
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
    public function show($questionId)
    {
        try {
            $data = $this->questionRepo->showData($questionId);
            if (empty($data['question'])) {
                \App\Custom\Flash::error('Question not found');

                return redirect()->route('admin.question.index');
            }

            return view('question.show', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            \App\Custom\Flash::error($e, 500);
            return redirect()->route('admin.question.index');
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
            $data = $this->questionRepo->getEditData($id);
            if (empty($data['question'])) {
                \App\Custom\Flash::error('Question not Found');

                return redirect()->route('admin.question.index');
            }

            return view('question.edit', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            \App\Custom\Flash::error($e, 500);
            return redirect()->route('admin.question.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $question = $this->questionRepo->update($id, $request);
            DB::commit();
            if (!$question) {
                return $this->sendError('Question not found', 404);
            }
            return $this->sendResponse($question);
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

            $question = $this->questionRepo->find($id);

            if (empty($question)) {
                return $this->sendError('Question Not Found', 404);
            }

            $deleted = $this->questionRepo->destroy($question);

            return $this->sendResponse([], 'Question Deleted Successfully');
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }


    public function datatable(Request $request)
    {

        try {

            $responseData = $this->questionRepo->getDatatableData($request);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }


    public function getExamData($examId)
    {
        try {

            $responseData = $this->questionRepo->getExamData($examId);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }

    public function changeStatus(Request $request)
    {
        try {

            $question = $this->questionRepo->find($request->question_id);

            if (empty($question)) {
                return $this->sendError('Question Not Found', 404);
            }

            $changeStatus = $this->questionRepo->changeStatus($question,$request);

            return $this->sendResponse([], 'Question Status updated Successfully');
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }
}
