<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CSAlumniSeeder extends Seeder
{
    public function run(): void
    {
        // 1. First, fix specific key users identified in the screenshot
        $specificUsers = [
            [
                'name' => 'Vivek Menon',
                'role' => 'alumni',
                'picture' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=256&h=256&auto=format&fit=crop'
            ],
            [
                'name' => 'Siddharth V',
                'role' => 'alumni',
                'picture' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=300&h=300'
            ],
            [
                'name' => 'Department of Computer Science',
                'role' => 'department',
                'picture' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=300&h=300'
            ]
        ];

        foreach ($specificUsers as $spec) {
            $user = User::where('name', 'LIKE', '%' . $spec['name'] . '%')->first();
            if ($user && $user->profile) {
                $user->profile->update(['profile_picture' => $spec['picture']]);
            }
        }

        // 2. Generic Fix: Replace ANY broken local path with a random professional photo
        // This stops the "Broken Image" icons for all other users
        $fallbackPhotos = [
            'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=300&h=300',
            'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=300&h=300',
            'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=300&h=300',
            'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=300&h=300'
        ];

        $profiles = Profile::whereNotNull('profile_picture')
            ->where('profile_picture', 'NOT LIKE', 'http%')
            ->get();

        foreach ($profiles as $index => $profile) {
            $profile->update([
                'profile_picture' => $fallbackPhotos[$index % count($fallbackPhotos)]
            ]);
        }

        // 3. Ensure the core demo alumni exist (Original logic)
        $alumni = [
            [
                'name' => 'Siddharth V.',
                'email' => 'siddharth@example.com',
                'department' => 'Computer Science',
                'profile_picture' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=300&h=300'
            ],
            [
                'name' => 'Priya Sharma',
                'email' => 'priya@example.com',
                'department' => 'Computer Science',
                'profile_picture' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=300&h=300'
            ]
        ];

        foreach ($alumni as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => 'alumni',
                    'status' => 'approved'
                ]
            );

            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'department' => $data['department'],
                    'profile_picture' => $data['profile_picture']
                ]
            );
        }
    }
}
