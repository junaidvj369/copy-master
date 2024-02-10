<?php

namespace App\Repositories\Admin;

use App\Models\Enquiry;

class EnquiryRepository
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
        return Enquiry::class;
    }


    public function getDatatableData($request)
    {

        $data = convertRequest($request);

        $offset = $data['start'];
        $limit = $data['length'];
        $draw = $data['draw'];
        $search = $data['search']['value'];
        $order_column = $data['order.0.column'] ?? 0;
        $order_direction = $data['order.0.dir'] ?? 'desc';


        $column = $this->getSearchableColumns();

        $main_query = $this->model()::select('enquiries.id', 'service', 'service_types.name as service_type', 'enquiries.name', 'email', 'message', 'contact_no')
            ->leftJoin('service_types', 'service_types.id', '=', 'enquiries.service');

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
        $temp['email'] = $detail->email;
        $temp['contact_no'] = $detail->contact_no;
        $temp['service'] = $detail->service_type;
        $temp['message'] = $detail->message;

        return $temp;
    }

    public function getSearchableColumns()
    {
        return [
            0 => 'enquiries.id',
            1 => 'enquiries.name',
            2 => 'email',
            3 => 'contact_no',
            4 => 'service_types.name',
        ];
    }
}
