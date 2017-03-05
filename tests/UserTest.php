<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

	/**
	* Test to see if registering a new user works.
	*
	* @return void
	*/
    public function testNewUserRegistration()
	{
	    $this->visit('/register')
	         ->type('Taylor', 'name')
	         ->type('luker@gmail.com', 'email')
	         ->type('mytest', 'password')
	         ->type('mytest', 'password_confirmation')
	         ->press('Register');
	}

	 /**
     * See if login works
     *
     * @return void
     */
    public function testUserLogin()
    {
        $this->visit('/login')
             ->type('luke@gmail.com', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->seePageIs('/dashboard');
    }
}
