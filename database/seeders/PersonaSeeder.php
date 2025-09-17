<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personas = [
            [
                'name' => 'Tech-Savvy Professional',
                'description' => 'Young professionals working in technology with high disposable income',
                'family_info' => [
                    'family_size' => '2-3',
                    'children_ages' => 'None or young',
                    'marital_status' => 'Single or newly married',
                ],
                'occupation_info' => [
                    'industry' => 'Technology',
                    'job_title' => 'Software Engineer, Product Manager, Designer',
                    'income_range' => '$80k-150k',
                    'education' => 'Bachelor\'s or Master\'s degree',
                ],
                'recreation_info' => [
                    'hobbies' => 'Gaming, Photography, Fitness',
                    'sports' => 'Indoor activities, Gym',
                    'entertainment' => 'Streaming services, Tech gadgets',
                ],
                'motivation_info' => [
                    'primary_goals' => 'Career growth, Work-life balance',
                    'values' => 'Innovation, Efficiency, Quality',
                    'pain_points' => 'Time management, Stress',
                ],
                'animals_info' => [
                    'pets' => 'Cat or small dog',
                    'pet_preferences' => 'Low maintenance pets',
                ],
                'favorite_teams' => [
                    'football' => 'Local team',
                    'basketball' => 'Warriors or Lakers',
                ],
                'color' => '#3B82F6',
                'is_active' => true,
            ],
            [
                'name' => 'Family-Oriented Parent',
                'description' => 'Parents focused on family values and children\'s well-being',
                'family_info' => [
                    'family_size' => '4-5',
                    'children_ages' => '5-15 years old',
                    'marital_status' => 'Married',
                ],
                'occupation_info' => [
                    'industry' => 'Education, Healthcare, Finance',
                    'job_title' => 'Teacher, Nurse, Accountant',
                    'income_range' => '$50k-100k',
                    'education' => 'Bachelor\'s degree',
                ],
                'recreation_info' => [
                    'hobbies' => 'Cooking, Reading, Family activities',
                    'sports' => 'Soccer, Swimming, Family sports',
                    'entertainment' => 'Family movies, Educational content',
                ],
                'motivation_info' => [
                    'primary_goals' => 'Children\'s education, Family security',
                    'values' => 'Family, Education, Stability',
                    'pain_points' => 'Time with family, Budget management',
                ],
                'animals_info' => [
                    'pets' => 'Dog or cat',
                    'pet_preferences' => 'Family-friendly pets',
                ],
                'favorite_teams' => [
                    'football' => 'Local high school team',
                    'soccer' => 'Children\'s soccer team',
                ],
                'color' => '#10B981',
                'is_active' => true,
            ],
            [
                'name' => 'Retired Enthusiast',
                'description' => 'Retired individuals with time and resources for hobbies and travel',
                'family_info' => [
                    'family_size' => '1-2',
                    'children_ages' => 'Adult children',
                    'marital_status' => 'Married or widowed',
                ],
                'occupation_info' => [
                    'industry' => 'Retired',
                    'job_title' => 'Former professional',
                    'income_range' => '$40k-80k',
                    'education' => 'Various backgrounds',
                ],
                'recreation_info' => [
                    'hobbies' => 'Gardening, Travel, Crafts',
                    'sports' => 'Golf, Walking, Swimming',
                    'entertainment' => 'Classic movies, Books, News',
                ],
                'motivation_info' => [
                    'primary_goals' => 'Health, Leisure, Legacy',
                    'values' => 'Tradition, Quality, Service',
                    'pain_points' => 'Health concerns, Technology adoption',
                ],
                'animals_info' => [
                    'pets' => 'Dog or cat',
                    'pet_preferences' => 'Companion animals',
                ],
                'favorite_teams' => [
                    'football' => 'Traditional teams',
                    'baseball' => 'Classic teams',
                ],
                'color' => '#F59E0B',
                'is_active' => true,
            ],
            [
                'name' => 'Young Entrepreneur',
                'description' => 'Ambitious young adults starting their own businesses',
                'family_info' => [
                    'family_size' => '1-2',
                    'children_ages' => 'None',
                    'marital_status' => 'Single or dating',
                ],
                'occupation_info' => [
                    'industry' => 'Startups, Consulting, E-commerce',
                    'job_title' => 'Founder, CEO, Consultant',
                    'income_range' => 'Variable, $30k-200k+',
                    'education' => 'Bachelor\'s or self-taught',
                ],
                'recreation_info' => [
                    'hobbies' => 'Networking, Learning, Travel',
                    'sports' => 'Fitness, Outdoor activities',
                    'entertainment' => 'Podcasts, Business content',
                ],
                'motivation_info' => [
                    'primary_goals' => 'Business growth, Financial freedom',
                    'values' => 'Innovation, Risk-taking, Success',
                    'pain_points' => 'Funding, Time management, Uncertainty',
                ],
                'animals_info' => [
                    'pets' => 'Minimal or none',
                    'pet_preferences' => 'Low maintenance',
                ],
                'favorite_teams' => [
                    'football' => 'Local team',
                    'basketball' => 'Warriors',
                ],
                'color' => '#8B5CF6',
                'is_active' => true,
            ],
            [
                'name' => 'Health-Conscious Individual',
                'description' => 'People focused on wellness, fitness, and healthy living',
                'family_info' => [
                    'family_size' => '1-3',
                    'children_ages' => 'Various',
                    'marital_status' => 'Various',
                ],
                'occupation_info' => [
                    'industry' => 'Healthcare, Fitness, Wellness',
                    'job_title' => 'Doctor, Trainer, Nutritionist',
                    'income_range' => '$60k-120k',
                    'education' => 'Professional degree',
                ],
                'recreation_info' => [
                    'hobbies' => 'Yoga, Hiking, Cooking healthy meals',
                    'sports' => 'Running, Cycling, Swimming',
                    'entertainment' => 'Health documentaries, Fitness apps',
                ],
                'motivation_info' => [
                    'primary_goals' => 'Health, Longevity, Wellness',
                    'values' => 'Health, Nature, Balance',
                    'pain_points' => 'Time for exercise, Healthy food access',
                ],
                'animals_info' => [
                    'pets' => 'Dog (active breeds)',
                    'pet_preferences' => 'Active, healthy pets',
                ],
                'favorite_teams' => [
                    'football' => 'Local team',
                    'running' => 'Marathon events',
                ],
                'color' => '#EF4444',
                'is_active' => true,
            ],
        ];

        foreach ($personas as $personaData) {
            Persona::create($personaData);
        }

        $this->command->info('Personas seeded successfully!');
    }
}