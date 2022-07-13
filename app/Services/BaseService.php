<?php

namespace App\Services;

use Illuminate\Container\Container as App;
use App\Exceptions\DDException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
        /**
     * @var Repository
     */
    protected $repository;

    /**
     * Contructor
     */
    public function __construct()
    {
        $this->app = new App();
        $this->setRepositoryClass();
    }

    /**
     * Get repository
     *
     * @return void
     */
    abstract public function getRepository();

    /**
     * Set repository
     *
     * @return void
     */
    public function setRepositoryClass()
    {
        $repository = $this->app->make($this->getRepository());
        if (!$repository instanceof BaseRepository) {
            throw new DDException("Class {$this->getRepository()} must be an instance of App\\Repositories\\BaseRepository");
        }

        $this->repository = $repository;
    }

        /**
     * Get list model.
     *
     * @param array   $data           Data conditions.
     * @param array   $select         Data select.
     * @param array   $relations      Relationship.
     * @param array   $relationCounts Relation count.
     * @param boolean $isReturnQuery  Is return query.
     *
     * @return Collection $entities
     */
    public function list(array $data, array $select = ['*'], array $relations = [], array $relationCounts = [], bool $isReturnQuery = false)
    {
        return $this->repository->list($data, $select, $relations, $relationCounts, $isReturnQuery);
    }

    /**
     * Create model.
     *
     * @param array $data Data create.
     *
     * @return Model
     */
    public function create(array $data)
    {
        $entity = $this->repository->create($data);

        return $entity;
    }

    /**
     * Update model.
     *
     * @param  Model $entity Model.
     * @param  array $data   Data update.
     *
     * @return  Model
     */
    public function update(Model $entity, array $data = [])
    {
        $this->repository->update($entity, $data);

        return $entity;
    }

    /**
     * Delete model.
     *
     * @param Model $entity Model.
     *
     * @return statement
     */
    public function destroy($entity)
    {
        return $this->repository->delete($entity);
    }

    /**
     * Get model detail.
     *
     * @param Model $entity    Model.
     * @param array $relations Relationship.
     *
     * @return Model
     */
    public function detail(Model $entity, array $relations = [])
    {
        return $this->repository->detail($entity, $relations);
    }
    
    /**
     * Update or create model.
     *
     * @param array $condition Condition.
     * @param array $data      Data update.
     *
     * @return Model
     */
    public function updateOrCreate(array $condition = [], array $data = [])
    {
        return $this->repository->updateOrCreate($condition, $data);
    }

    /**
     * Synchro model relation with data.
     *
     * @param Model  $entity   Model.
     * @param string $relation Relationship.
     * @param array  $data     Data sync.
     *
     * @return statement
     */
    public function sync(Model $entity, string $relation, array $data = [])
    {
        return $this->repository->sync($entity, $relation, $data);
    }

    /**
     * Get model count.
     *
     * @return integer
     */
    public function count()
    {
        return $this->repository->count();
    }

    /**
     * Get model total.
     *
     * @param string $field Column name.
     * @return integer
     */
    public function total(string $field)
    {
        return $this->repository->total($field);
    }

    /**
     * Insert multiple values.
     *
     * @param array $data Data insert.
     * @return integer
     */
    public function insert(array $data)
    {
        return $this->repository->insert($data);
    }

    /**
     * Group model by column.
     *
     * @param string $field Column name.
     *
     * @return Collection
     */
    public function groupBy(string $field)
    {
        return $this->repository->groupBy($field);
    }

    /**
     * Find model by id.
     *
     * @param mixed $id        Id (string|int).
     * @param array $relations Relationship.
     *
     * @return Model
     */
    public function findOrFail($id, array $relations = [])
    {
        return $this->repository->findOrFail($id, $relations);
    }

    /**
     * Find model by id.
     *
     * @param mixed $id        Id (string|int).
     * @param array $relations Relationship.
     *
     * @return Model
     */
    public function find($id, array $relations = [])
    {
        return $this->repository->find($id, $relations);
    }

    /**
     * Find by condition
     *
     * @param array $condition Condition to search.
     * @param array $relations Relationship.
     *
     * @return object $entities
     */
    public function findByCondition(array $condition, array $relations = [])
    {
        return $this->repository->findByCondition($condition, $relations);
    }

    /**
     * Get all data.
     *
     * @return List of Model
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Get model's fillable attribute.
     *
     * @return array
     */
    public function getFillable()
    {
        return $this->repository->getFillable();
    }

    /**
     * Batch update.
     *
     * @param array $condition Condition.
     * @param array $data      Data.
     * @return mixed
     */
    public function batchUpdate(array $condition, array $data)
    {
        return $this->repository->batchUpdate($condition, $data);
    }

    /**
     * Cache the query result.
     *
     * @param string $method    Method name.
     * @param mixed  ...$params Param.
     *
     * @return mixed cached query result
     */
    public function cache(string $method, ...$params)
    {
        return $this->repository->cache($method, ...$params);
    }

    /**
     * Delete mutiple item.
     *
     * @param array $ids List id to delete.
     *
     * @return boolean
     */
    public function deleteMulti(array $ids = [])
    {
        return $this->repository->deleteMulti($ids);
    }
}
?>