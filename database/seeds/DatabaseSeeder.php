<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Category as Category;
use App\User as User;
use \DB as DB;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('CategoriesTableSeeder');
		$this->call('UsersTableSeeder');
	}

}

class UsersTableSeeder extends Seeder
{
	public function run()
	{

		$faker = Faker\Factory::create();

		DB::table('users')->delete();

		$user = new User();
		$user->name = 'Ved';
		$user->email = 'vedovelli@gmail.com';
		$user->password = Hash::make('123456');
		$user->save();

		for($i = 1; $i < 150; $i++)
		{
			$user = new User();
			$user->name = $faker->name;
			$user->email = $faker->email;
			$user->password = Hash::make('123456');
			$user->save();
		}
	}
}

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		/**
		* Query Builder
		*/
		DB::table('categories')->delete();

		/**
		* Faker library
		*/
		$faker = Faker\Factory::create();

		/**
		* Model
		*/
		for($i = 1; $i < 150; $i++)
		{
			$cat = new Category();
			$cat->name = $faker->word;
			$cat->save();
		}
	}
}
