<?php namespace App\Dave\Services\Repositories;

interface ICategoryRepository extends IRepository
{
    public function categories($total, $search = null);

}