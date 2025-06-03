<?php

namespace App\Core\DataTable;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface IDataTable
 */
interface IDataTable
{
    /**
     * @return DataTable
     */
    public function getOptions(): DataTable;

    /**
     * @return LengthAwarePaginator
     */
    public function builder(): LengthAwarePaginator;
}
