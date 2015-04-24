<?php

class CategoryTest extends TestCase {

	public function testIndex()
	{
		// $mock = Mockery::mock('App\Dave\Services\Repositories\ICategoryRepository');

		// $mock->shouldReceive('categories')->once()->with(['total' => '10']);

		// $this->app->instance('App\Dave\Services\Repositories\ICategoryRepository', $mock);

		$this->call('GET', '/categoria');

		$this->assertResponseOk();

		$this->assertViewHas('categories');
	}

	public function testStore()
	{
		$this->call('POST', 'categoria/salvar', ['name' => 'Categoria Teste Teste']);

		$this->assertRedirectedToRoute('category.index');
	}

}
