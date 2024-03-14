<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MahasiswaController extends ResourceController
{
    protected $modelName    = 'App\Models\Mahasiswa';
    protected $format       = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data_mahasiswa' => $this->model->orderBy('id', 'DESC')->findAll()
        ];

        return $this->respond($data, 200);
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
        $data = [
            'message' => 'success',
            'mahasiswa_byid' => $this->model->find($id)
        ];

        if ($data['mahasiswa_byid'] == null) {
            return $this->failNotFound('Data tidak ditemukan');
        }
        return $this->respond($data, 200);
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
        $rules = $this->validate([
            'nama'      => 'required',
            'nim'       => 'required|numeric',
            'jurusan'   => 'required',
        ]);
        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->model->insert([
            'nama'      => esc($this->request->getVar('nama')),
            'nim'       => esc($this->request->getVar('nim')),
            'jurusan'   => esc($this->request->getVar('jurusan'))
        ]);

        $response = [
            'message' => "data berhasil ditambahkan"
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
        $rules = $this->validate([
            'nama'      => 'required',
            'nim'       => 'required|numeric',
            'jurusan'   => 'required',
        ]);
        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->model->update($id, [
            'nama'      => esc($this->request->getVar('nama')),
            'nim'       => esc($this->request->getVar('nim')),
            'jurusan'   => esc($this->request->getVar('jurusan'))
        ]);

        $response = [
            'message' => "data berhasil diubah"
        ];

        return $this->respond($response, 200);
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

        $response = [
            'message' => "data berhasil dihapus"
        ];

        var_dump($id);
        return $this->respond($response, 200);
    }
}
