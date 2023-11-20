<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */


    public function test_new_users_can_register(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
        ->post('/user_detail', [
            'name' =>  'Test',
            'email' => 'sample+'.rand(0,100).'@gmail.com',
            'building_no' =>  'fasdf',
            'street_name' =>  'dasdf',
            'city' =>  'fasf',
            'state' =>  'fasf',
            'country' =>  'pood',
            'pincode' =>  '123456'
        ]);


        $response->assertStatus(200);
    }
}
