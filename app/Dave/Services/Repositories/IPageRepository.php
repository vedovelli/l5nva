<?php namespace App\Dave\Services\Repositories;

interface IPageRepository extends IRepository
{
  public function pages($search = null);
}