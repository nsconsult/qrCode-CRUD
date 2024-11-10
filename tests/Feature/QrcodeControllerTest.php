<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Qrcode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QrcodeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de l'affichage de la liste des QR codes.
     */
    public function testIndexReturnsPaginatedQrcodes()
    {
        Qrcode::factory()->count(3)->create();

        $response = $this->getJson('/api/qrcodes');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'author', 'data', 'created_at', 'updated_at'],
            ],
        ]);
    }

    /**
     * Test de création d'un QR code avec des données valides.
     */
    public function testStoreCreatesQrcodeWithValidData()
    {
        $data = [
            'author' => 'Test Author',
            'data' => 'Test Data',
        ];

        $response = $this->postJson('/api/qrcodes', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment($data);
        $this->assertDatabaseHas('qrcodes', $data);
    }

    /**
     * Test de création d'un QR code avec des données invalides.
     */
    public function testStoreFailsWithInvalidData()
    {
        $data = [
            'author' => '', // Champ author vide
            'data' => '',   // Champ data vide
        ];

        $response = $this->postJson('/api/qrcodes', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['author', 'data']);
    }

    /**
     * Test de l'affichage d'un QR code spécifique.
     */
    public function testShowReturnsSpecificQrcode()
    {
        $qrcode = Qrcode::factory()->create();

        $response = $this->getJson("/api/qrcodes/{$qrcode->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $qrcode->id,
            'author' => $qrcode->author,
            'data' => $qrcode->data,
        ]);
    }

    /**
     * Test de mise à jour d'un QR code avec des données valides.
     */
    public function testUpdateModifiesQrcodeWithValidData()
    {
        $qrcode = Qrcode::factory()->create();

        $data = [
            'author' => 'Updated Author',
            'data' => 'Updated Data',
        ];

        $response = $this->putJson("/api/qrcodes/{$qrcode->id}", $data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
        $this->assertDatabaseHas('qrcodes', $data);
    }

    /**
     * Test de mise à jour d'un QR code avec des données invalides.
     */
    public function testUpdateFailsWithInvalidData()
    {
        $qrcode = Qrcode::factory()->create();

        $data = [
            'author' => '', // Champ author vide
            'data' => '',   // Champ data vide
        ];

        $response = $this->putJson("/api/qrcodes/{$qrcode->id}", $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['author', 'data']);
    }

    /**
     * Test de suppression d'un QR code.
     */
    public function testDestroyDeletesQrcode()
    {
        $qrcode = Qrcode::factory()->create();

        $response = $this->deleteJson("/api/qrcodes/{$qrcode->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('qrcodes', ['id' => $qrcode->id]);
    }
}
