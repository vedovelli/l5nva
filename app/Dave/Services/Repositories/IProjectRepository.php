<?php namespace App\Dave\Services\Repositories;

interface IProjectRepository extends IRepository
{
  public function projects($search = null);
}