<?php

namespace App\Http\Controllers\Crm;

use App\Core\DataTable\BaseDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class DataTableController extends Controller
{
    protected BaseDataTable $dataTable;

    public function __construct(Request $request)
    {
        $table = $request->route('table');

        if (!config()->has('datatable.tables.' . $table))
            abort(404);

        $class = config('datatable.tables.' . $table);
        $this->dataTable = (new $class);

        //TODO: Add permission check
//        if ($this->dataTable->checkPermission && (!auth('personal')->check() || !auth('personal')->user()->can('read ' . $table))) {
//            abort(403);
//        }
    }

    public function index(): AnonymousResourceCollection
    {
        $names = array_map(fn($col) => $col->name, $this->dataTable->dataTable->getColumns());
        $names = array_filter($names, fn($name) => $name !== 'actions');

        // ilişkileri otomatik olarak çöz
        $with = [];
        $rs = array_values(array_filter($names, fn($name) => str_contains($name, '.')));
        if (count($rs))
            $with = array_unique(array_map(fn($name) => explode('.', $name)[0], $rs));

        $builder = $this->dataTable->builder(with: $with);

        $builder->getCollection()->transform(fn($item) => $this->transform($item, $names, $rs));

        return JsonResource::collection($builder);
    }

    public function config(): JsonResponse
    {
        return $this->dataTable->config();
    }

    private function transform($item, array $names, array $rs): array
    {
        $data = $item->only($names);

        // description alanlarını otomatik olarak çöz
        $find = array_values(array_filter(array_keys($data), fn($key) => str_contains($key, '_description')));

        if (count($find)) {
            $col = str_replace('_description', '', $find[0]);
            $data[$find[0]] = $item->{$col}->description();
        }

        // ilişkileri otomatik olarak çöz
        foreach ($rs as $r) {
            $clone = clone $item;
            $parts = explode('.', $r);
            foreach ($parts as $part)
                $clone = $clone->{$part};
            $data[$r] = $clone;
        }

        return $data;
    }
}
