<?php

namespace App\Core\DataTable;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class DataTable
 */
class DataTable
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @var array
     */
    protected array $columns;

    /**
     * @var array
     */
    protected array $filters;

    /**
     * @var array
     */
    protected array $custom_filters;

    /**
     * @param string $name
     * @return DataTable
     */
    public static function make(string $name = ""): static
    {
        return new static($name);
    }

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param Column $column
     * @return DataTable
     */
    public function addColumn(Column $column): static
    {
        $this->columns[] = $column;
        return $this;
    }

    /**
     * @param Filter $filter
     * @return DataTable
     */
    public function addFilter(Filter $filter): static
    {
        $this->filters[] = $filter;
        return $this;
    }

    /**
     * @param AllowedFilter $filter
     * @return $this
     */
    public function addCustomFilter(AllowedFilter $filter): static
    {
        $this->custom_filters[] = $filter;
        return $this;
    }

    /**
     * @param array $columns
     * @return DataTable
     */
    public function addColumns(array $columns): static
    {
        foreach ($columns as $column) {
            $this->addColumn($column);
        }
        return $this;
    }

    /**
     * @param array $filters
     * @return DataTable
     */
    public function addFilters(array $filters): static
    {
        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }
        return $this;
    }

    /**
     * @param array $custom_filters
     * @return $this
     */
    public function addCustomFilters(array $custom_filters): static
    {
        foreach ($custom_filters as $filter) {
            $this->addCustomFilter($filter);
        }
        return $this;
    }


    /**
     * @param EloquentBuilder|Relation|string $subject
     * @return LengthAwarePaginator
     */
    public function builder(EloquentBuilder|Relation|string $subject, $with = []): LengthAwarePaginator
    {
        $request = request();
        $filters = array_merge(array_map(fn($filter) => $filter->name, $this->filters), $this->custom_filters);
        $sortable = array_map(fn($column) => $column->name, array_filter($this->columns, fn($column) => $column->sortable));

        return QueryBuilder::for($subject)
            ->allowedFilters($filters)
            ->allowedSorts($sortable)
            ->defaultSort('-id')
            ->with($with)
            ->paginate(
                $request->input('page.size', 10),
                ['*'],
                'page',
                $request->input('page.page', 1)
            );
    }

    /**
     * @return JsonResponse
     */
    public function config(): JsonResponse
    {
        return response()->json([
            'cols' => array_map(fn($col) => $col->toArray(), $this->columns),
            'filters' => array_map(fn($filter) => $filter->toArray(), $this->filters),
            'name' => __($this->name),
        ]);
    }


    public function getColumns(): array
    {
        return $this->columns;
    }
}
