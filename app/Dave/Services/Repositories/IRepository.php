<?php namespace App\Dave\Services\Repositories;

interface IRepository
{
    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}