<?php

namespace App\Controllers;

use App\Libraries\TableLib;
use App\Models\StaffModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Exceptions;

class Staff extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    protected $modelName = 'App\Models\StaffModel';
    protected $format    = 'json';

    public function index()
    {
        $order = $this->request->getVar('order');
        $order = array_shift($order);

        $modelList = model('StaffModel');
        $tableLib = new TableLib($modelList, 'Staff', [
            'id',
            'first_name',
            'last_name',
            'position',
            'office',
            'extn',
            'start_date',
            'salary'
        ]);
        $response = $tableLib->getResponse([
            'draw' => $this->request->getVar('draw'),
            'start' => $this->request->getVar('start'),
            'length' => $this->request->getVar('length'),
            'order' => $order['column'],
            'direction' => $order['dir'],
            'search' => $this->request->getVar('search')['value']
        ]);

        // $response =
        //     [
        //         'draw' => $this->request->getVar('draw'),
        //         'recordsTotal' => $modelList->countAll(),
        //         'recordsFiltered' => $modelList->countAll(),
        //         'data' => $modelList->findAll()
        //     ];
        return $this->respond($response);
    }




    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getVar('data');

        $data = array_shift($data);






        $this->model->insert([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'position' => $data['position'],
            'email' => $data['email'],
            'office' => $data['office'],
            'extn' => $data['extn'],
            'age' => $data['age'],
            'salary' => $data['salary'],
            'start_date' => $data['start_date']
        ]);


        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Create staff complete!',

            ],
            'data' => $data

        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        // die('2');
        // $data = $this->request->getRawInput();
        // echo "<pre>";
        // print_r($data);
        // die;

        // return $this->respond($data);

        // Lấy dữ liệu từ yêu cầu PUT
        $input = $this->request->getRawInput();



        // Lấy trường và giá trị để cập nhật
        $fieldData = $input['data'];
        $fieldData = array_shift($fieldData);






        // // // Kiểm tra dữ liệu đầu vào
        // $validationRules = [];

        // // Tạo quy tắc kiểm tra cho từng trường cụ thể
        // foreach ($fieldData as $field => $value) {
        //     switch ($field) {
        //         case 'first_name':
        //         case 'last_name':
        //         case 'position':
        //         case 'office':
        //         case 'extn':
        //             $validationRules[$field] = 'required';
        //             break;
        //         case 'email':
        //             $validationRules[$field] = 'required|valid_email';
        //             break;
        //         case 'age':
        //             $validationRules[$field] = 'required|numeric';
        //             break;
        //         case 'start_date':
        //             $validationRules[$field] = 'required|valid_date';
        //             break;
        //         case 'salary':
        //             $validationRules[$field] = 'required|numeric';
        //             break;
        //     }
        // }

        // if (!$this->validate($validationRules)) {
        //     return $this->fail($this->validator->getErrors());
        // }

        // // Cập nhật dữ liệu trong cơ sở dữ liệu
        // if ($this->model->update($id, $fieldData)) {
        //     return $this->respondUpdated(['status' => 'success', 'message' => 'Record updated successfully']);
        // } else {
        //     return $this->failServerError('Failed to update record');
        // }

        $this->model->update($id, $fieldData);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Update staff complete!',

            ],

            'data' => $fieldData

        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}
