<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseService
{
    protected $url;
    protected $key;
    protected $bucket;

    public function __construct()
    {
        // Tomamos directamente del .env
        $this->url = rtrim(env('SUPABASE_URL'), '/');
        $this->key = env('SUPABASE_KEY');
        $this->bucket = trim(env('SUPABASE_BUCKET'), '/');
    }

    /**
     * Subir un archivo a Supabase
     *
     * @param string $path      Ruta dentro del bucket (ej: productos/imagen.jpg)
     * @param string $fileContent Contenido binario del archivo
     * @param string $contentType Tipo MIME (ej: image/jpeg)
     * @return array|string
     */
    public function uploadFile($path, $fileContent, $contentType = 'image/jpeg')
    {
        $path = ltrim($path, '/');
        $fullUrl = "{$this->url}/storage/v1/object/{$this->bucket}/{$path}";

        $response = Http::withHeaders([
            'apikey' => $this->key,
            'Authorization' => 'Bearer ' . $this->key,
            'Content-Type' => $contentType,
        ])->withBody($fileContent, $contentType)
          ->put($fullUrl);

        return $response->json() ?: $response->body();
    }

    /**
     * Obtener URL pública del archivo subido
     *
     * @param string $path
     * @return string
     */
    public function getPublicUrl($path)
    {
        $path = ltrim($path, '/');
        return "{$this->url}/storage/v1/object/public/{$this->bucket}/{$path}";
    }
}
