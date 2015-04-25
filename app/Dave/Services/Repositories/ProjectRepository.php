<?php namespace App\Dave\Services\Repositories;

use Illuminate\Foundation\Bus\DispatchesCommands;

use App\Project as Project;
use App\User as User;
use App\Category as Category;
use \DB as DB;

class ProjectRepository implements IProjectRepository
{
  use DispatchesCommands;

  public function projects($search = null, $categories = null, $orderby = null, $paginate = true)
  {
    $result = null;

    if($paginate)
    {
      if(!is_null($search) && !empty($search))
      {
        return Project::where('name', 'like', "%$search%")->paginate(env('PAGINATION_ITEMS', 10));
      }

      if(!is_null($categories) && !empty($categories))
      {
        $projectsFromCategories = DB::table('category_project')->whereIn('category_id', $categories)->distinct()->get(['project_id']);

        $projectIds = [];

        foreach ($projectsFromCategories as $value) {
          $projectIds[] = $value->project_id;
        }

        return Project::whereIn('id', $projectIds)->paginate(env('PAGINATION_ITEMS', 10));
      }

      if(!is_null($orderby) && !empty($orderby))
      {

        $order = explode('|', $orderby);

        return Project::orderBy($order[0], $order[1])->paginate(env('PAGINATION_ITEMS', 10));
      }

      return Project::paginate(env('PAGINATION_ITEMS', 10));
    }

    return Project::where('name', 'like', "%$search%")->get();
  }

  public function projectsUserIsMember($userid)
  {
    $userInProjects = DB::table('project_user')->where('user_id', '=', $userid)->get(['project_id']);

    $wherein = [];

    foreach ($userInProjects as $value) {
      $wherein[] = $value->project_id;
    }

    return Project::whereIn('id', $wherein)->get();
  }

  public function projectsForSelect()
  {
    $projecs = [];

    $collection = Project::all();

    $i = 0;

    foreach ($collection as $value) {
      $projects[$i]['id'] = $value->id;
      $projects[$i]['text'] = $value->name;
      $i++;
    }

    return $projects;
  }

  public function show($id)
  {
    return Project::find($id);
  }

  public function store($request)
  {
    $project = new Project();
    $project->fill($request);
    $project->save();

    foreach ($request['members'] as $user_id) {
      $user = User::find($user_id);
      $project->members()->save($user);
      // $this->sendMail($user, $project);
      $this->dispatch(
        new \App\Commands\SendMailCommand($project, $user)
      );
    }

    foreach ($request['categories'] as $category_id) {
      $category = Category::find($category_id);
      $project->categories()->save($category);
    }

    return $project;
  }

  // private function sendMail($user, $project)
  // {

  //   $user_name = $user->name;

  //   $project_name = $project->name;

  //   $link = url().'/projeto/'.$project->id.'/detalhes';

  //   \Mail::send('emails.project_member', compact('user_name', 'project_name', 'link'), function($message) use ($user, $project)
  //   {
  //       $message->to($user->email, $user->name)->subject('[Dave Brubeck] Você foi adicionado como membro do projeto ' . $project->name);
  //   });
  // }

  public function update($id, $request)
  {
    $project = Project::find($id);
    $project->fill($request);
    $project->save();

    foreach ($project->members as $member) {
      $project->members()->detach($member);
    }

    foreach ($request['members'] as $user_id) {
      $user = User::find($user_id);
      $project->members()->save($user);
    }

    foreach ($project->categories as $category) {
      $project->categories()->detach($category);
    }

    foreach ($request['categories'] as $category_id) {
      $category = Category::find($category_id);
      $project->categories()->save($category);
    }

    return $project;
  }

  public function destroy($id)
  {
    $project = Project::find($id);
    $project->delete();
    return true;
  }
}