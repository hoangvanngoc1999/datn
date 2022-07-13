<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService extends BaseService
{
    /**
    * @var \App\Repositories\CategoryRepository $categoryRepository.
    */
    protected $categoryRepository;

    /**
     * CategoryService construct
     *
     * @param \App\Repositories\CategoryRepository $categoryRepository Category repository.
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        parent::__construct();
    }

    /**
     * @return \App\Repositories\CategoryRepository
     */
    public function getRepository()
    {
        return CategoryRepository::class;
    }
}