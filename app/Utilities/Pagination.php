<?php
namespace App\Utilities;

trait Pagination
{
    /**
     * Genera un arreglo con el contenido necesario para realizar la paginación.
     *
     * @param $model
     *
     * @return array
     */
    protected function makePaginationArray($model)
    {
        return [
            'pagination' => [
                'total' => $model->total(),
                'per_page' => $model->perPage(),
                'current_page' => $model->currentPage(),
                'last_page' => $model->lastPage(),
                'from' => $model->firstItem(),
                'to' => $model->lastItem()
            ],
            'data' => $model
        ];
    }

}