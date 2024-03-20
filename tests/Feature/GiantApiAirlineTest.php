<?php

use Illuminate\Support\Facades\Http;

test('giant api returns airlines', function () {
    $token = config('auth.giant_api_token');
    $api = Http::withToken($token)->get('https://api-v1.giantpilots.com/v1/airlines');

    expect($api['data'][0])->toHaveKeys(['id', 'sector', 'name', 'icao', 'iata']);
});
