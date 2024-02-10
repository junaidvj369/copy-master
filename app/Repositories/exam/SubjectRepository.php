<?php

namespace App\Repositories\exam;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectRepository 
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
        return Subject::class;
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
        $updateAbleFields = [
            'EXAM_ID' => $data['exam_id'],
            'SUBJECT_NAME' => $data['subject_name']
        ];
        $class = $this->model()::create($updateAbleFields);
        
        $oSuject = $this->model()::find($class->id);
        $oSuject->SUBJECT_ID = $oSuject->id;
        $oSuject->save();

        return $class;
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

        $main_query = $this->model()::select('id','EXAM_ID','SUBJECT_NAME','SUBJECT_ID')->with('exam');

        $main_query->orderBy($column[$order_column], $order_direction);

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
        $temp['subject_name'] = $detail->SUBJECT_NAME;

        $temp['actions'] = '<a href="' . route('admin.subject.edit', ['subject' => $detail->id]) . '" class="btn mb-1 btn-rounded btn-success" title="Edit">
       Edit
        </a>
        <a href="javascript:void(0)" data-route="' . route('admin.subject.destroy', ['subject' => $detail->id]) . '" class="btn btn-danger btn-rounded m-1 delete_subject
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

        $exam = Exam::all();
        $subject = $this->model()::find($id);

        return compact('subject','exam');
    }

    public function update($id, $data)
    {
        $oClass = $this->find($id);
        if (empty($oClass)) {
            return null;
        }

        $updateAbleFields = [
            'EXAM_ID' => $data['exam_id'],
            'SUBJECT_NAME' => $data['subject_name']
        ];

        $oClass->fill($updateAbleFields);
        $oClass->save();

        return $oClass;
    }

    public function destroy($secretKey)
    {
        $result = $secretKey->delete();
        return $result;
    }
}
