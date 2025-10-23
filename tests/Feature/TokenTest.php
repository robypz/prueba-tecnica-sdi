<?php

test('Request access token', function () {
    $response = $this->post('/api/token');

    $response->assertStatus(200);
});
