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
        $alumni = [
            [
                'name' => 'Siddharth V.',
                'email' => 'siddharth@example.com',
                'department' => 'Computer Science',
                'graduation_year' => '2022',
                'roll_number' => 'CS18BTech2022',
                'company' => 'OpenAI',
                'location' => 'San Francisco, CA',
                'skills' => 'PyTorch, Transformers, LLMs, C++',
                'bio' => 'Research Engineer at OpenAI. Passionate about scaling laws and AI efficiency.',
                'profile_picture' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=300&h=300'
            ],
            [
                'name' => 'Priya Sharma',
                'email' => 'priya@example.com',
                'department' => 'Computer Science',
                'graduation_year' => '2018',
                'roll_number' => 'CS14BTech1102',
                'company' => 'Google',
                'location' => 'Mountain View, CA',
                'skills' => 'Go, Kubernetes, Distributed Systems',
                'bio' => 'Senior SDE at Google Cloud. Building the next generation of cloud infrastructure.',
                'profile_picture' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=300&h=300'
            ],
            [
                'name' => 'Rahul Ravindran',
                'email' => 'rahul@example.com',
                'department' => 'Computer Science',
                'graduation_year' => '2016',
                'roll_number' => 'CS12BTech0881',
                'company' => 'Amazon',
                'location' => 'Kochi, Kerala',
                'skills' => 'Java, AWS, Microservices',
                'bio' => 'Principal Architect at Amazon. Focused on logistics and large-scale backend systems.',
                'profile_picture' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=300&h=300'
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
                    'graduation_year' => $data['graduation_year'],
                    'roll_number' => $data['roll_number'],
                    'company' => $data['company'],
                    'location' => $data['location'],
                    'skills' => $data['skills'],
                    'bio' => $data['bio'],
                    'profile_picture' => $data['profile_picture']
                ]
            );
        }
    }
}
