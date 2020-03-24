<?php

use Tests\BaseTestCase;
use App\Models\User;

class DatabaseTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setup();
    }

    public function testCreateNewUser()
    {
        $request = [
            'fullname' => 'Cuong Ngo',
            'email' => 'cuongngo@gmail.com',
            'password' => '1234567890',
            'gender' => 'male',
        ];

        $user = new User();
        $newUser = $user->insert($request);

        $this->assertNotEmpty($newUser);
    }
}
