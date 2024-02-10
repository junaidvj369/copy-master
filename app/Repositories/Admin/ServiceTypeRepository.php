<?php

namespace App\Repositories\Admin;

use App\Models\ServiceType;

class ServiceTypeRepository
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
        return ServiceType::class;
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
        $updateAbleFields = [
            'name' =>  $data->name,
            'status' =>  $data->status,
        ];
        $exam = $this->model()::create($updateAbleFields);
        return $exam;
    }


    public function getDatatableData($request)
    {
        // $service = resolve(BaseService::class);

        $data = convertRequest($request);

        $offset = $data['start'];
        $limit = $data['length'];
        $draw = $data['draw'];
        $search = $data['search']['value'];
        $order_column = $data['order.0.column'] ?? 0;
        $order_direction = $data['order.0.dir'] ?? 'desc';


        $column = $this->getSearchableColumns();

        $main_query = $this->model()::select('id', 'name', 'status');

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

        $temp['id'] = $detail->id;
        $temp['name'] = $detail->name;
        $temp['status'] = $this->getPurchaseMode($detail->status);

        $temp['actions'] = '<a href="' . route('admin.service.edit', ['service' => $detail->id]) . '" class="btn mb-1 btn-rounded btn-success" title="Edit">
       Edit
        </a>
        ';

        return $temp;
    }

    public function getPurchaseMode($purchaseMode)
    {
        if ($purchaseMode == 1) {
            return '<div class="badge badge-light-info fw-bolder"> Active </div>';
        } else {
            return '<div class="badge badge-light-dark fw-bolder"> Inactive </div>';
        }
    }

    public function getSearchableColumns()
    {
        return [
            0 => 'id',
            1 => 'name',
        ];
    }

    public function getEditData($id)
    {

        $service = $this->model()::find($id);


        return compact('service');
    }

    public function update($id, $data)
    {
        $service = $this->find($id);
        if (empty($service)) {
            return null;
        }

        $updateAbleFields = [
            'name' =>  $data->name,
            'status' =>  $data->status ? $data->status : 0,
        ];

        $service->fill($updateAbleFields);
        $service->save();

        return $service;
    }
}
