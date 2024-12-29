<?php

namespace App\HttpClients;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class PostHttpClient
{
    private ?string $token = null;

    public static function make(): self
    {
        return new self();
    }

    public function login(): self
    {
        if (!$this->token) {
            $response = Http::post('http://127.0.0.1:8000/api/auth/login', [
                'email' => config('wind.email'),
                'password' => config('wind.password'),
            ]);

            if ($response->ok()) {
                $this->token = $response['access_token'];
            } else {
                throw new Exception('Login failed: ' . $response->body());
            }
        }

        return $this;
    }

    public function handleRequest(string $method, string $url, array $data = []): Response
    {
        $this->login(); // Убедиться, что токен получен

        return match (strtolower($method)) {
            'get' => Http::withToken($this->token)->get($url,!empty($data) ? $data : []),
            'post' => Http::withToken($this->token)->post($url, $data),
            'patch' => Http::withToken($this->token)->patch($url, $data),
            'delete' => Http::withToken($this->token)->delete($url),
            default => throw new InvalidArgumentException("Unsupported HTTP method: $method")
        };
    }

    public function index(array $query = []): Response
    {
        return $this->handleRequest('get', 'http://127.0.0.1:8000/api/posts/', $query);
    }

    public function show($id): Response
    {
        return $this->handleRequest('get', "http://127.0.0.1:8000/api/posts/$id");
    }

    public function store(array $data): Response
    {
        return $this->handleRequest('post', 'http://127.0.0.1:8000/api/posts/', $data);
    }

    public function update($id, array $data): Response
    {
        return $this->handleRequest('patch', "http://127.0.0.1:8000/api/posts/$id", $data);
    }

    public function destroy($id): Response
    {
        return $this->handleRequest('delete', "http://127.0.0.1:8000/api/posts/$id");
    }

}
