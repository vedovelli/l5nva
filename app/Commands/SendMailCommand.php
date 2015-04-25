<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class SendMailCommand extends Command implements SelfHandling {

	protected $user;
	protected $project;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(\App\Project $project, \App\User $user)
	{
		$this->user = $user;
		$this->project = $project;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$user = $this->user;

		$project = $this->project;

		$user_name = $this->user->name;

	    $project_name = $this->project->name;

	    $link = url().'/projeto/'.$this->project->id.'/detalhes';

	    \Mail::send('emails.project_member', compact('user_name', 'project_name', 'link'), function($message) use ($user, $project)
	    {
	        $message->to($this->user->email, $this->user->name)->subject('[Dave Brubeck] Você foi adicionado como membro do projeto ' . $this->project->name);
	    });
	}

}
