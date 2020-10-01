<?php
use Illuminate\Support\Str;

return

[
    'type' =>[
    'participant_band_type'            => Str::slug('participants costs', '-'),
    'question_band_type'            => Str::slug('questions costs', '-'),
    'background_band_type'         => Str::slug('backgrounds costs', '-'),
    ]
];
