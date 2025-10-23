<?php

test('Make a search', function () {
    // Obtener el token
    $response = $this->post('/api/token');
    $token = $response->json('access_token'); // Ajusta la clave si el token viene con otro nombre

    // Hacer la solicitud con el token en el header Authorization
    $response = $this->get('/api/search?search=ladygaga', [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertStatus(200);
});
