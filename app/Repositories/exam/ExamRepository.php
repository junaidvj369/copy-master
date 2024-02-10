<?php

namespace App\Repositories\exam;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamRepository 
{
    public function __construct()
    {
        //
    }

    /**
     * The base model used by this repository
     *
     * @author junaid
     *
     * @return string
     */
    public function model()
    {
        return Exam::class;
    }

    /**
     * Find the Admin By Id  or object
     *
     * @author junaid
     *
     * @param \App\Models\SecretKey|integer $id
     *
     * @return \App\Models\SecretKey|null
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
        return [];
    }

    public function create($data)
    {
        //dd($data);
        $updateAbleFields = [
            'EXAM_NAME' => $data['exam_name']
        ];
        //$inputData = $data->only($updateAbleFields);
        $exam = $this->model()::create($updateAbleFields);
        
        $oExam = $this->model()::find($exam->id);
        $oExam->EXAM_ID = $oExam->id;
        $oExam->save();

        return $exam;
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

        $main_query = $this->model()::select('id','EXAM_ID','EXAM_NAME');

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

        $temp['exam_id'] = $detail->EXAM_ID;
        $temp['exam_name'] = $detail->EXAM_NAME;

        $temp['actions'] = '<a href="' . route('admin.exam.edit', ['exam' => $detail->id]) . '" class="btn mb-1 btn-rounded btn-success" title="Edit">
       Edit
        </a>
        <a href="javascript:void(0)" data-route="' . route('admin.exam.destroy', ['exam' => $detail->id]) . '" class="btn btn-danger btn-rounded m-1 delete_exam
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
            1 => 'EXAM_NAME',
        ];
    }

    public function getEditData($id)
    {

        $exam = $this->model()::find($id);


        return compact('exam');
    }

    public function update($id, $data)
    {
        $secretKey = $this->find($id);
        if (empty($secretKey)) {
            return null;
        }

        $updateAbleFields = [
            'EXAM_NAME' =>  $data->exam_name
        ];

        $secretKey->fill($updateAbleFields);
        $secretKey->save();

        return $secretKey;
    }

    public function destroy($secretKey)
    {
        $result = $secretKey->delete();
        return $result;
    }
}
