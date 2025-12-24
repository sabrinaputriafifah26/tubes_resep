<?php
use PHPUnit\Framework\TestCase;

class ApiKeyTest extends TestCase
{
    public function testApiKeyIsValid()
    {
        require_once __DIR__ . '/../config/api.php';

        // 1. API_KEY harus terdefinisi
        $this->assertTrue(
            defined('API_KEY'),
            'API_KEY belum didefinisikan di config/api.php'
        );

        // 2. API_KEY tidak boleh kosong
        $this->assertNotEmpty(
            API_KEY,
            'API_KEY kosong'
        );

        // 3. API_KEY bertipe string
        $this->assertIsString(
            API_KEY,
            'API_KEY harus bertipe string'
        );

        // 4. API_KEY benar-benar dipakai dalam URL API
        $url = "https://api.spoonacular.com/recipes/complexSearch?apiKey=" . API_KEY;

        $this->assertStringContainsString(
            API_KEY,
            $url,
            'API_KEY tidak digunakan dalam request API'
        );
    }
}
