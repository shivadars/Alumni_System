<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$alumni = \App\Models\User::where('role', 'alumni')->with('profile')->get();
file_put_contents('alumni_data.json', $alumni->toJson(JSON_PRETTY_PRINT));
echo "Data written to alumni_data.json\n";
