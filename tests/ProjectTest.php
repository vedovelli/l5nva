<?php

class ProjectTest extends TestCase {

	public function testIndex()
	{
		$this->call('GET', '/projeto');

		$this->assertResponseOk();

		$this->assertViewHas('projects');
	}
}
