<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    /**
    * @var \App\Repositories\ProductRepository $productRepository.
    */
    protected $productRepository;

    /**
     * ProductService construct
     *
     * @param \App\Repositories\ProductRepository $productRepository Product repository.
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    /**
     * @return \App\Repositories\ProductRepository
     */
    public function getRepository()
    {
        return ProductRepository::class;
    }
}