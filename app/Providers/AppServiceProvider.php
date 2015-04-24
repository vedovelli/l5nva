<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		\View::share('datepicker', function($options = [])
		{
			$opt = array_merge([
				'name' => 'nomeQualquer',
				'id' => 'idQualquer',
				'value' => date('d/m/Y'),
			], $options);
			return view('components.datepicker')->with('options', $opt);
		});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);

		$this->app->bind(
			'App\Dave\Services\Repositories\ICategoryRepository',
			'App\Dave\Services\Repositories\CategoryRepository'
		);

		$this->app->bind(
			'App\Dave\Services\Repositories\IUserRepository',
			'App\Dave\Services\Repositories\UserRepository'
		);

		$this->app->bind(
			'App\Dave\Services\Repositories\IProjectRepository',
			'App\Dave\Services\Repositories\ProjectRepository'
		);

		$this->app->bind(
			'App\Dave\Services\Repositories\ISectionRepository',
			'App\Dave\Services\Repositories\SectionRepository'
		);

		$this->app->bind(
			'App\Dave\Services\Repositories\IPageRepository',
			'App\Dave\Services\Repositories\PageRepository'
		);
	}

}
