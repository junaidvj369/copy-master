<?php

namespace App\Repositories\exam;

use App\Models\Chapter;
use App\Models\DmClass;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionRepository 
{
  
    /**
     * The base model used by this repository
     *
     * @author junaid
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }

    /**
     * Find the Admin By Id  or object
     *
     * @author junaid
     *
     *
     */
    public function find($id)
    {
        $modelName = $this->model();
        $model = null;
        if ($id instanceof $modelName) {

            $model = $id;
        } else {
            $model = $this->model()::find($id);
        }
        return $model;
    }

    public function getCreateData()
    {
        $exam = Exam::all();
        return compact('exam');
    }

    public function create($data)
    {
        $oChapter = Chapter::select('CHAPTER_NAME')->find($data->chapter_id);
        $updateAbleFields = [
            'EXAM_ID' => $data['exam_id'],
            'CLASS_ID' => $data['class_id'],
            'SUBJECT_ID' => $data['subject_id'],
            'CHAPTER_ID' => $data['chapter_id'],
            'CHAPTER_NAME' => $oChapter->CHAPTER_NAME,
            'QUESTIONS' => $data['question'],
            'OPTION_A' => $data['option_a'],
            'OPTION_B' => $data['option_b'],
            'OPTION_C' => $data['option_c'],
            'OPTION_D' => $data['option_d'],
            'ANSWER' => $data['answer'],
            'YEAR' => $data['year'],
            'PREVIOUS_FLAG' => $data['question_type'],
            'SOLUTION' => $data['solution'],
        ];
        $question = $this->model()::create($updateAbleFields);
        
        $oQuestion = $this->model()::find($question->id);
        $oQuestion->Q_ID = $question->id;
        $oQuestion->QUESTION_ID = $question->id;
        $oQuestion->save();

        return $oQuestion;
    }

    public function convertRequest($request)
    {
        if ($request instanceof Request) {
            $request = $request->all();
        }

        return $request;
    }

    public function getDatatableData($request)
    {
        // $service = resolve(BaseService::class);

        $data = $this->convertRequest($request);

        $offset = $data['start'];
        $limit = $data['length'];
        $draw = $data['draw'];
        $search = $data['search']['value'];
        $order_column = $data['order.0.column'] ?? 0;
        $order_direction = $data['order.0.dir'] ?? 'asc';


        $column = $this->getSearchableColumns();

        $main_query = $this->model()::select('id','EXAM_ID', 'CLASS_ID', 'SUBJECT_ID', 'CHAPTER_ID', 'CHAPTER_NAME','QUESTIONS','status')->with('exam','getClass','subject');

        $main_query->orderBy('id', 'DESC');

        $total_count = $main_query->count();

        if ($search) {
            $main_query->where(function ($query) use ($column, $search) {
                foreach ($column as $key => $q) {
                    $query->orWhere($q, 'like', '%' . $search . '%');
                }
            });
        }

        $filter_count = $main_query->count();

        if ($limit != -1) {
            $main_query->offset($offset);
            $main_query->limit($limit);
        }

        $list = $main_query->get();
        $result = $this->structureForDatatable($list);

        $response = [
            'draw' => $draw, 'recordsTotal' => $total_count, 'recordsFiltered' => $filter_count, 'data' => $result
        ];

        return $response;
    }

    public function structureForDatatable($data)
    {
        $finalData = array();
        foreach ($data as $index => $detail) {

            $finalData[] = $this->structureSingleData($detail);
        }

        return $finalData;
    }

    public function structureSingleData($detail)
    {
        $temp = array();

        $temp['exam_name'] = $detail->exam['EXAM_NAME'];
        $temp['class_name'] = $detail->getClass['CLASS_NAME'];
        $temp['subject_name'] = $detail->subject['SUBJECT_NAME'];
        $temp['chapter_name'] = $detail->CHAPTER_NAME;
        $temp['question'] = $detail->QUESTIONS;
        $temp['status'] = array_search($detail->status,config('krabbit.question_status'));;

        $temp['actions'] = '
        <a href="' . route('admin.question.show', ['question' => $detail->id]) . '" class="btn mb-1 btn-rounded btn-primary" title="View">
       View
        </a>
        <a href="' . route('admin.question.edit', ['question' => $detail->id]) . '" class="btn mb-1 btn-rounded btn-success" title="Edit">
       Edit
        </a>
        <a href="javascript:void(0)" data-route="' . route('admin.question.destroy', ['question' => $detail->id]) . '" class="btn btn-danger btn-rounded m-1 delete_question
        "
            title="Delete">
            Delete
        </a>
        ';

        return $temp;
    }

    public function getSearchableColumns()
    {
        return [
            0 => 'EXAM_ID',
            1 => 'CLASS_NAME',
        ];
    }

    public function getEditData($id)
    {

        $question = $this->model()::find($id);
        $exam = Exam::all();
        $subject = Subject::where('EXAM_ID',$question->EXAM_ID)->get();
        $class = DmClass::where('EXAM_ID',$question->EXAM_ID)->get();
        $chapter = Chapter::where('SUBJECT_ID',$question->SUBJECT_ID)->where('CLASS_ID',$question->CLASS_ID)->get();
        
        return compact('subject','exam','class','chapter','question');
    }

    public function update($id, $data)
    {
        $oQuestion = $this->find($id);
        if (empty($oQuestion)) {
            return null;
        }
        $oChapter = Chapter::select('CHAPTER_NAME')->find($data->chapter_id);

        $updateAbleFields = [
            'EXAM_ID' => $data['exam_id'],
            'CLASS_ID' => $data['class_id'],
            'SUBJECT_ID' => $data['subject_id'],
            'CHAPTER_ID' => $data['chapter_id'],
            'CHAPTER_NAME' => $oChapter->CHAPTER_NAME,
            'QUESTIONS' => $data['question'],
            'OPTION_A' => $data['option_a'],
            'OPTION_B' => $data['option_b'],
            'OPTION_C' => $data['option_c'],
            'OPTION_D' => $data['option_d'],
            'ANSWER' => $data['answer'],
            'YEAR' => $data['year'],
            'PREVIOUS_FLAG' => $data['question_type'],
            'SOLUTION' => $data['solution'],
        ];

        $oQuestion->fill($updateAbleFields);
        $oQuestion->save();

        return $oQuestion;
    }

    public function destroy($secretKey)
    {
        $result = $secretKey->delete();
        return $result;
    }

    public function getExamData($examId)
    {
        $data['class'] = DmClass::where('exam_id',$examId)->get();
        $data['subject'] = Subject::where('exam_id',$examId)->get();
        return $data;
    }

    public function showData($questionId)
    {
        $question = $this->model()::with('exam','getClass','subject')->where('id', $questionId)->first();

        return compact('question');
    }

    public function changeStatus($question,$data)
    {
        $question->status = $data->status;
        $question->save();
        return $question;
    }
}
