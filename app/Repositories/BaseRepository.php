<?php

namespace App\Repositories;

use App\Exceptions\DDException;
use Carbon\Carbon;
use DB;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;
use Str;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Contructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->app = new App();
        $this->setModelClass();
    }
        /**
     * Get model
     *
     * @return void
     */
    abstract public function getModel();

    /**
     * Set model
     *
     * @return Model
     */
    public function setModelClass()
    {
        $model = $this->app->make($this->getModel());
        if (!$model instanceof Model) {
            throw new DDException("Class {$this->getModel()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Get list model.
     *
     * @param array   $data           Data conditions.
     * @param array   $select         Select.
     * @param array   $relations      Relationship.
     * @param array   $relationCounts Relation count.
     * @param boolean $isReturnQuery  Is return query.
     *
     * @return Collection $entities
     */
    public function list(array $data, array $select = ['*'], array $relations = [], array $relationCounts = [], bool $isReturnQuery = false)
    {
        $data = collect($data);
        $config = config('constant');

        // select list column
        $entities = $this->model->select($select ?? ['*']);

        // load realtion counts
        if (count($relationCounts)) {
            $entities = $entities->withCount($relationCounts);
        }

        // load relations
        if (count($relations)) {
            $entities = $entities->with($relations);
        }
        // filter list by condition
        $condition = $data->has('condition') && $config['encode_condition'] ? (array) json_decode(base64_decode($data['condition'])) : $data;

        if (count($condition) && method_exists($this, 'search')) {
            foreach ($condition as $key => $value) {
                $entities = $this->search($entities, $key, $value);
            }
        }

        // order list
        $orderBy = $data->has('sort') && in_array($data['sort'], $this->model->sortable) ? $data['sort'] : $this->model->getKeyName();
        $entities = $entities->orderBy($orderBy, $data->has('sortType') && $data['sortType'] == 1 ? 'asc' : 'desc');

        // return query instead of collection or pagging
        if ($isReturnQuery) {
            return $entities;
        }

        // limit result
        // $limit = $data->has('limit') ? (int) $data['limit'] : $config['paginate'];

        // if ($limit) {
        //     return $entities->paginate($limit);
        // }

        // return $entities->get();
    }

    /**
     * Create model.
     *
     * @param array $data Data store.
     *
     * @return Model
     */
    public function create(array $data = [])
    {
        return $this->model->create($data);
    }

    /**
     * Get model detail.
     *
     * @param Model $entity    Data model.
     * @param array $relations Relations.
     *
     * @return Model
     */
    public function detail(Model $entity, array $relations = [])
    {
        if (count($relations)) {
            return $entity->load($relations);
        }

        return $entity;
    }

    /**
     * Update model.
     *
     * @param Model $entity Model.
     * @param array $data   Data update.
     *
     * @return Model
     */
    public function update(Model $entity, array $data = [])
    {
        $entity->update($data);
        return $entity;
    }

    /**
     * Update or create model.
     *
     * @param array $condition Conditions updateOrCreate.
     * @param array $data      Data update.
     *
     * @return Model
     */
    public function updateOrCreate(array $condition = [], array $data = [])
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    /**
     * Delete model.
     *
     * @param Model $entity Model.
     *
     * @return boolean
     */
    public function delete($entity)
    {
        $result = $this->find($entity);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
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
        return $this->model->whereIn('id', $ids)->delete();
    }

    /**
     * Synchro model relation with data.
     *
     * @param Model  $entity   Model.
     * @param string $relation Relation.
     * @param array  $data     Data sync.
     *
     * @return void
     */
    public function sync(Model $entity, string $relation, array $data = [])
    {
        $entity->$relation()->sync($data);
    }

    /**
     * Get model count.
     *
     * @return integer
     */
    public function count()
    {
        return $this->model->count();
    }
    
    /**
     * Get model total.
     *
     * @param string $field Column name.
     * @return integer
    */
    public function total(string $field)
    {
        return $this->model->sum($field);
    }

    /**
     * Insert multiple values.
     *
     * @param array $data Data insert.
     * @return mixed
     */
    public function insert(array $data)
    {
        $data = array_map(function ($item) {
            $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');

            return $item;
        }, $data);

        return $this->model->insert($data);
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
        $raw = $field . ', count(' . $field . ') as ' . $field . '_count';

        return $this->model->select(FacadesDB::raw($raw))->groupBy($field)->get();
    }

    /**
     * Find model by id.
     *
     * @param mixed $id        Id to find.
     * @param array $relations Relations.
     *
     * @return Model
     */
    public function findOrFail($id, array $relations = [])
    {
        $entity = $this->model->findOrFail($id);

        if (count($relations)) {
            return $entity->load($relations);
        }

        return $entity;
    }

    /**
     * Find model by id.
     *
     * @param mixed $id        Id to find.
     * @param array $relations Relations.
     *
     * @return Model
     */
    public function find($id, array $relations = [])
    {
        $entity = $this->model->find($id);

        if (count($relations)) {
            return $entity->load($relations);
        }

        return $entity;
    }

    /**
     * Find by condition .
     *
     * @param array $condition Condition to search.
     * @param array $relations Relations.
     *
     * @return object $entities
     */
    public function findByCondition(array $condition, array $relations = [])
    {
        $entities = $this->model->select($this->model->selectable);

        if (count($relations)) {
            $entities = $entities->with($relations);
        }
        if (count($condition)) {
            foreach ($condition as $key => $value) {
                $entities = $this->search($entities, $key, $value);
            }
        }

        return $entities;
    }

    /**
     * Get all data.
     *
     * @return List of Model
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get model's fillable attribute.
     *
     * @return array
     */
    public function getFillable()
    {
        return $this->model->getFillable();
    }
}
?>