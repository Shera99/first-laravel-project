<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    protected $model;

    protected function sendErr()
    {
        return $this->sendError('Not Found', 404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $limit = (int) $request->get('limit', 10);
        $offset = (int) $request->get('offset', 0);

        $result = $this->model->limit($limit)->offset($offset)->get();

        if (!$result) {
            return $this->sendErr();
        }

        return $this->sendResponse($result, 'OK', 200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id) {
        $query = $this->model->find($id);

        if(empty($query)) {
            return $this->sendErr();
        }

        return $this->sendResponse($query, 'OK', 200);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
//    public function update(int $id, Request $request)
//    {
//        $query = $this->repository->getEdit($id);
//
//        if(empty($query)) {
//            return $this->sendErr();
//        }
//
//        $data = $request->validated();
//
//        $query->update($data);
//
//        return $this->sendResponse(null, 'Updated', 204);
//    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $query = $this->model->find($id);

        if(empty($query)) {
            return $this->sendErr();
        }

        $delete = $query->where('id', $id)->delete();

        if($delete) {
            return $this->sendResponse(null, 'Deleted', 204);
        } else {
            return $this->sendError('Error deleting!!!',404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validated();

        $this->model->create($data);

        return $this->sendResponse(null, 'Created', 201);
    }
}
