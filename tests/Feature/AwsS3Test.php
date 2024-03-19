<?php

use Illuminate\Support\Facades\Storage;

test('aws storage is connected', function () {
    $array = Storage::directories();

    expect(in_array('test-folder', $array))
        ->toBeTrue();
});
