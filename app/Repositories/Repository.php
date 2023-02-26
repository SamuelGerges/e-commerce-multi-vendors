<?php

namespace App\Repositories;

use App\Http\Interfaces\RepositryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositryInterface
{

    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        // TODO: Implement all() method.
        return $this->model->all();
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
        $record = $this->model->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
        return $this->model->findOrFail($id);

    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
