<?php
use PHPUnit\Framework\TestCase;

class ApiKeyTest extends TestCase
{
    /**
     * Test apakah API Key Spoonacular valid
     */
    public function testApiKeyIsValid()
    {
        // Ambil API Key dari config
        require_once __DIR__ . '/../config/api.php';

        $url = "https://api.spoonacular.com/recipes/complexSearch?apiKey=$apiKey&number=1";

        $response = @file_get_contents($url);

        // Pastikan response tidak false (request berhasil)
        $this->assertNotFalse(
            $response,
            "API Key tidak valid atau request ke API gagal"
        );

        // Decode JSON
        $data = json_decode($response, true);

        // Pastikan response mengandung data resep
        $this->assertArrayHasKey(
            'results',
            $data,
            "Response API tidak mengandung data hasil"
        );
    }
}
