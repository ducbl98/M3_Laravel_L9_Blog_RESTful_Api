<?php


namespace App\Repositories\Eloquent;


use App\Repositories\Repository;

 abstract class EloquentRepository implements Repository
{
    protected $model;
    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model=app()->make($this->getModel());
    }

    abstract public function getModel();


     public function getAll()
     {
         return $this->model->all();
     }

     public function findById($id)
     {
         return $this->model->find($id);
     }

     public function create($data)
     {
         try {
             $object = $this->model->create($data);
         }catch (\Exception $exception){
             return null;
         }
         return $object;
     }

     public function update($data, $object)
     {
         $object->update($data);
     }

     public function destroy($object)
     {
         $object->delete();
     }
 }
