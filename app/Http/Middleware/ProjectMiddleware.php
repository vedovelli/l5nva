<?php namespace App\Http\Middleware;

use Closure;

class ProjectMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$response = $next($request);


		/**
		* Alguma verificacao aqui! Utilizando dados passados com o $request
		*/


		return $response;
	}

}
