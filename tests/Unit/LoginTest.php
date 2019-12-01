<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddlewaruse;
use Illuminate\Foundation\Testing\DatabaseTransaction;
use App\User;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoginEstado()
    {
       
       $response = $this->get('/')
       ->dumpHeaders()
       ->dump()
       ->assertStatus(200);

    }
    public function testVistaLoginc()
    {
       
       $response = $this->get('/')
       ->assertSeeInOrder(['Acceder','Control de acceso al sistema']);
    }

    public function testeLoginConError()
    {
        $response = $this->post(route('login'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('usuario');
    }
    
}
