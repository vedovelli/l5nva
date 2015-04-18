<?php namespace App\Dave\Services\Repositories;

interface IUserRepository extends IRepository
{
    public function users($total, $search = null);

}