<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NavigationTest extends TestCase
{
    /**
     * A basic test to see if root lands on homepage.
     *
     * @return void
     */
    public function testHomepage()
    {
        $this->visit('/')
         ->seePageIs('/login');
    }

    /**
     * See if login works
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->visit('/login')
             ->type('luke@gmail.com', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->seePageIs('/dashboard');
    }

    /**
     * See if land on Facebook.
     *
     * @return void
     */
    public function testFacebookPage()
    {
        $this->visit('/facebook')
             ->type('luke@gmail.com', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->seePageIs('/facebook');
    }

    /**
     * See if login then go to twitter
     *
     * @return void
     */
    public function testTwitterPage()
    {
        $this->visit('/login')
             ->type('luke@gmail.com', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->visit('/twitter')
             ->seePageIs('/twitter');
    }

    /**
     * See if login then go to instagram
     *
     * @return void
     */
    public function testInstagramPage()
    {
        $this->visit('/login')
             ->type('luke@gmail.com', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->visit('/instagram')
             ->seePageIs('/instagram');
    }


    /**
     * See if login then go to settings
     *
     * @return void
     */
    public function testSettingsPage()
    {
        $this->visit('/login')
             ->type('luke@gmail.com', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->visit('/settings')
             ->seePageIs('/settings');
    }

}
