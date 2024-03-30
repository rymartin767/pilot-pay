<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

test('aws storage is connected', function () {
    $array = Storage::directories();

    expect(in_array('test-folder', $array))
        ->toBeTrue();
});

test('IAM status will not grant public access to folder without policy', function () {
    $imagePath = 'test-folder/null.webp';
    $s3Url = Storage::disk('s3')->url($imagePath);
    
    $response = Http::get($s3Url);

    // Assert that the response status is 200 (OK)
    expect($response->status())->toBe(403);
});

test('images are available with bucket policy', function () {
    $imagePath = 'logos/atlas-air-300.webp';
    $s3Url = Storage::disk('s3')->url($imagePath);
    
    $response = Http::get($s3Url);

    // Assert that the response status is 200 (OK)
    expect($response->status())->toBe(200);
});
