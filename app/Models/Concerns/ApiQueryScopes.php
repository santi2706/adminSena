<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait ApiQueryScopes
{
    abstract protected function apiQueryOptions(): array;

    public function scopeIncluded(Builder $query): Builder
    {
        $requested = request('included');
        $allowed = $this->apiQueryOptions()['included'];

        if (!is_string($requested) || empty($allowed)) {
            return $query;
        }

        $relations = array_intersect(
            array_map('trim', explode(',', $requested)),
            $allowed
        );

        if ($relations !== []) {
            $query->with($relations);
        }

        return $query;
    }

    public function scopeFilter(Builder $query): Builder
    {
        $filters = request('filter', []);
        $allowed = $this->apiQueryOptions()['filter'];

        if (!is_array($filters) || empty($allowed)) {
            return $query;
        }

        foreach ($filters as $field => $value) {
            if (in_array($field, $allowed, true) && is_scalar($value) && $value !== '') {
                $query->where($field, 'LIKE', '%' . $value . '%');
            }
        }

        return $query;
    }

    public function scopeSort(Builder $query): Builder
    {
        $requested = request('sort');
        $allowed = $this->apiQueryOptions()['sort'];

        if (!is_string($requested) || empty($allowed)) {
            return $query;
        }

        foreach (explode(',', $requested) as $field) {
            $field = trim($field);
            $direction = str_starts_with($field, '-') ? 'desc' : 'asc';
            $field = ltrim($field, '-');

            if (in_array($field, $allowed, true)) {
                $query->orderBy($field, $direction);
            }
        }

        return $query;
    }

    public function scopeGetOrPaginate(Builder $query)
    {
        $perPage = filter_var(request('perPage'), FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1, 'max_range' => 100],
        ]);

        return $perPage === false ? $query->get() : $query->paginate($perPage);
    }
}