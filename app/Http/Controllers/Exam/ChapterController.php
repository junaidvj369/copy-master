<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Repositories\exam\ChapterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ChapterController extends Controller
{
    public $chapterRepo;

    public function __construct(ChapterRepository $chapterRepo) {
        $this->chapterRepo = $chapterRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chapter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = $this->chapterRepo->getCreateData();

            return view('chapter.add', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return redirect()->route('admin.chapter.index');
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
            $secretKey = $this->chapterRepo->create($request);
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
            $data = $this->chapterRepo->getEditData($id);
            if (empty($data['chapter'])) {
                \App\Custom\Flash::error('chapter not Found');

                return redirect()->route('admin.chapter.index');
            }

            return view('chapter.edit', $data);
        } catch (\Throwable $e) {
            $this->handleException($e);
            \App\Custom\Flash::error($e, 500);
            return redirect()->route('admin.chapter.index');
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
            $subject = $this->chapterRepo->update($id, $request);
            DB::commit();
            if (!$subject) {
                return $this->sendError('Chapter not found', 404);
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

            $subject = $this->chapterRepo->find($id);

            if (empty($subject)) {
                return $this->sendError('Chapter Not Found', 404);
            }

            $deleted = $this->chapterRepo->destroy($subject);

            return $this->sendResponse([], 'Chapter Deleted Successfully');
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }


    public function datatable(Request $request)
    {

        try {

            $responseData = $this->chapterRepo->getDatatableData($request);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }


    public function getExamData($examId)
    {
        try {

            $responseData = $this->chapterRepo->getExamData($examId);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }

    public function getChapterData($classId, $subjectId)
    {
        try {

            $responseData = $this->chapterRepo->getChapterData($classId, $subjectId);

            return response()->Json($responseData);
        } catch (\Throwable $e) {
            $this->handleException($e);
            return $this->sendError($e, 500);
        }
    }
}
