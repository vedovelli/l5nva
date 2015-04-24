<?php

class HomeTest extends TestCase {

	public function testRedirectDashboard()
	{
		$response = $this->call('GET', '/');

		$this->assertRedirectedTo('dashboard');
	}

}
