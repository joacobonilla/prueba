<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\PersonaController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Persona;

class PersonaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function alta_persona_exitosa()
    {
        $response = $this->post('/personas', [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'telefono' => '1234567890'
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Persona::all());
    }

    /**
     * @test
     */
    public function alta_persona_fallida_sin_nombre()
    {
        $response = $this->post('/personas', [
            'apellido' => 'Pérez',
            'telefono' => '1234567890'
        ]);

        $response->assertStatus(422);
        $this->assertCount(0, Persona::all());
    }

    /**
     * @test
     */
    public function baja_persona_exitosa()
    {
        $persona = Persona::factory()->create();
        $response = $this->delete("/personas/{$persona->id}");

        $response->assertStatus(204);
        $this->assertCount(0, Persona::all());
    }

    /**
     * @test
     */
    public function baja_persona_fallida_persona_no_encontrada()
    {
        $response = $this->delete('/personas/999');

        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function modificacion_persona_exitosa()
    {
        $persona = Persona::factory()->create();
        $response = $this->put("/personas/{$persona->id}", [
            'nombre' => 'María',
            'apellido' => 'González',
            'telefono' => '9876543210'
        ]);

        $response->assertStatus(200);
        $this->assertEquals('María', $persona->fresh()->nombre);
    }

    /**
     * @test
     */
    public function modificacion_persona_fallida_persona_no_encontrada()
    {
        $response = $this->put('/personas/999', [
            'nombre' => 'María',
            'apellido' => 'González',
            'telefono' => '9876543210'
        ]);

        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function listado_personas_exitoso()
    {
        Persona::factory()->count(5)->create();
        $response = $this->get('/personas');

        $response->assertStatus(200);
        $this->assertCount(5, $response->json());
    }

    /**
     * @test
     */
    public function busqueda_persona_exitosa()
    {
        $persona = Persona::factory()->create();
        $response = $this->get("/personas/{$persona->id}");

        $response->assertStatus(200);
        $this->assertEquals($persona->nombre, $response->json()['nombre']);
    }

    /**
     * @test
     */
    public function busqueda_persona_fallida_persona_no_encontrada()
    {
        $response = $this->get('/personas/999');

        $response->assertStatus(404);
    }
}
