<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Category as Category;
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
