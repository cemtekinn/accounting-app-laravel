<?php

namespace App\Core\DataTable;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BaseDataTable
 */
abstract class BaseDataTable implements IDataTable
{
    /**
     * @var DataTable
     */
    public DataTable $dataTable;

    /**
     * @var bool
     */
    public bool $checkPermission = true;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dataTable = $this->getOptions();
    }

    /**
     * @return JsonResponse
     */
    public function config(): JsonResponse
    {
        return $this->dataTable->config();
    }

    /**
     * @param $model
     * @param array $with
     * @return LengthAwarePaginator
     */
    public function builder($model = null, array $with = []): LengthAwarePaginator
    {
        if ($model === null)
            $model = 'App\Models\\' . str_replace('DataTable', '', class_basename($this));

        return $this->dataTable->builder($model, $with);
    }
}
