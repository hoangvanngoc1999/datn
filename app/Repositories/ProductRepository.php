<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository extends BaseRepository
{
    /**
     * @return \App\Models\Product
     */
    public function getmodel()
    {
        return Product::class;
    }

    /**
     * Search
     *
     * @param Illuminate\Database\Eloquent\Builder $query  Eloquent query builder.
     * @param string                               $column Column name.
     * @param mixed                                $data   Data conditions (string|integer).
     *
     * @return Query
     */
    public function search(Builder $query, string $column, $data)
    {
        switch ($column) {
            case 'id':
                return $query->where($column, $data);
                break;
            case 'name':
                return $query->where($column, 'like', '%' . $data . '%');
                break;
            default:
                return $query;
                break;
        }
    }
}