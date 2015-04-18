<?php namespace App\Dave\Services\Repositories;

use App\User as User;

class UserRepository implements IUserRepository
{
    public function users($total, $search = null)
    {
        if(!is_null($search) && $search != '')
        {
            $users = User::where('name', 'like', '%'.$search.'%')->paginate($total);
        } else {
            $users = User::paginate($total);
        }

        return $users;
    }

    public function store($request)
    {
        $user = new User();

        $user->fill($request);

        $user->save();

        return $user;
    }

    public function show($id)
    {
        $user = User::find($id);

        if(is_null($user))
        {
            return null;
        }

        return $user;
    }

    public function update($request, $id)
    {
        $user = User::find($id);

        $user->fill($request);

        $user->save();

        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if(is_null($user))
        {
            return null;
        }

        return $user->delete();

    }
}