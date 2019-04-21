<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;


trait ApiResponser
{

    /**
     * @param $data
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse(array $data, int $code): JsonResponse
    {
        return response()
            ->json($data, $code);
    }


    /**
     * @param $message
     * @param $code
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code = 500): JsonResponse
    {
        return response()
            ->json([
                'error' => $message,
                'code' => $code
            ], $code);
    }

    /**
     * @param Collection $collection
     * @param int $code
     * @return JsonResponse
     */
    protected function showCollectionResponse(Collection $collection, int $code = 200, string $message = 'Success'): JsonResponse
    {
        return $this->successResponse([
            'data' => $collection,
            'result_message' => $message
        ], $code);

    }

    /**
     * @param Model $model
     * @param int $code
     * @param $message
     * @return JsonResponse
     */
    protected function showModelResponse(Model $model, int $code = 200, string $message = 'Success'): JsonResponse
    {
        return $this->successResponse([
            'data' => $model,
            'result_message' => $message
        ], $code);
    }

    /**
     * @param array $errorBag $message
     * @param int $code
     * @return JsonResponse
     */
    protected function validationErrorResponse(array $errorsArray, int $code = 200): JsonResponse
    {
        return response()
            ->json([
                'error' => $errorsArray,
                'code' => $code
            ], $code);
    }

}