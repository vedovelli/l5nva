<?php namespace App\Dave\Services\Repositories;

use App\User as User;

class UserRepository implements IUserRepository
{
    public function users($total, $search = null)
    {
        if(is_null($total))
        {
            $users = User::all();
        } else {
            if(!is_null($search) && $search != '')
            {
                $users = User::where('name', 'like', '%'.$search.'%')->paginate($total);
            } else {
                $users = User::paginate($total);
            }
        }

        return $users;
    }

    public function usersForSelect()
    {
        $paginate = null;

        $usersOriginal = $this->users($paginate)->toArray(); // search == null && paginate == false

        foreach ($usersOriginal as $value) {
          $allUsers[$value['id']] = $value['name']; // formato para Form::select()
        }

        return $allUsers;
      }

      public function usersWithProjects()
      {
        $allUsers = [];

        /**
        * Seleciona todos os IDs de usuarios associadas a projetos
        */
        $usersWithProjs = DB::table('project_user')->distinct()->get(['user_id']);

        if(count($usersWithProjs) > 0)
        {
          /**
          * Reduz o array a apenas IDs
          */
          foreach ($usersWithProjs as $value) {
            $users[] = $value->user_id;
          }

          /**
          * Obtem uma Collection de objetos User
          */
          $usersOriginal = User::whereIn('id', $users)->get();

          /**
          * Formato amigável para Form::select()
          */
          foreach ($usersOriginal as $value) {
            $allUsers[$value['id']] = $value['name'];
          }
        }

        return $allUsers;
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