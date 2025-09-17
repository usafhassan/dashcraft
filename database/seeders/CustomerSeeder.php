<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Persona;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $personas = Persona::all();
        $tags = Tag::all();

        $customers = [
            [
                'name' => 'John Anderson',
                'email' => 'john.anderson@email.com',
                'mobile' => '+1-555-0101',
                'address' => '123 Tech Street, San Francisco, CA 94105',
                'classification' => 'existing',
                'metadata' => [
                    'company' => 'TechCorp Inc.',
                    'industry' => 'Software Development',
                    'annual_revenue' => '$2.5M',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Mitchell',
                'email' => 'sarah.mitchell@email.com',
                'mobile' => '+1-555-0102',
                'address' => '456 Family Lane, Austin, TX 78701',
                'classification' => 'potential',
                'metadata' => [
                    'company' => 'Family Services LLC',
                    'industry' => 'Education',
                    'annual_revenue' => '$500K',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Robert Chen',
                'email' => 'robert.chen@email.com',
                'mobile' => '+1-555-0103',
                'address' => '789 Startup Blvd, Seattle, WA 98101',
                'classification' => 'conquest',
                'metadata' => [
                    'company' => 'InnovateNow',
                    'industry' => 'E-commerce',
                    'annual_revenue' => '$1.2M',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Emily Rodriguez',
                'email' => 'emily.rodriguez@email.com',
                'mobile' => '+1-555-0104',
                'address' => '321 Wellness Way, Denver, CO 80202',
                'classification' => 'existing',
                'metadata' => [
                    'company' => 'HealthFirst Clinic',
                    'industry' => 'Healthcare',
                    'annual_revenue' => '$800K',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Michael Thompson',
                'email' => 'michael.thompson@email.com',
                'mobile' => '+1-555-0105',
                'address' => '654 Senior Street, Phoenix, AZ 85001',
                'classification' => 'potential',
                'metadata' => [
                    'company' => 'Retirement Solutions',
                    'industry' => 'Financial Services',
                    'annual_revenue' => '$300K',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Lisa Wang',
                'email' => 'lisa.wang@email.com',
                'mobile' => '+1-555-0106',
                'address' => '987 Innovation Drive, Boston, MA 02101',
                'classification' => 'existing',
                'metadata' => [
                    'company' => 'FutureTech Labs',
                    'industry' => 'Artificial Intelligence',
                    'annual_revenue' => '$5M',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'David Johnson',
                'email' => 'david.johnson@email.com',
                'mobile' => '+1-555-0107',
                'address' => '147 Corporate Plaza, Chicago, IL 60601',
                'classification' => 'potential',
                'metadata' => [
                    'company' => 'Global Enterprises',
                    'industry' => 'Manufacturing',
                    'annual_revenue' => '$10M',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Jennifer Davis',
                'email' => 'jennifer.davis@email.com',
                'mobile' => '+1-555-0108',
                'address' => '258 Fitness Center, Miami, FL 33101',
                'classification' => 'conquest',
                'metadata' => [
                    'company' => 'FitLife Studios',
                    'industry' => 'Fitness & Wellness',
                    'annual_revenue' => '$600K',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Alex Kumar',
                'email' => 'alex.kumar@email.com',
                'mobile' => '+1-555-0109',
                'address' => '369 Digital Avenue, New York, NY 10001',
                'classification' => 'existing',
                'metadata' => [
                    'company' => 'Digital Solutions Inc.',
                    'industry' => 'Digital Marketing',
                    'annual_revenue' => '$1.8M',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'maria.garcia@email.com',
                'mobile' => '+1-555-0110',
                'address' => '741 Community Center, Los Angeles, CA 90001',
                'classification' => 'potential',
                'metadata' => [
                    'company' => 'Community First',
                    'industry' => 'Non-Profit',
                    'annual_revenue' => '$200K',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'James Wilson',
                'email' => 'james.wilson@email.com',
                'mobile' => '+1-555-0111',
                'address' => '852 Financial District, Dallas, TX 75201',
                'classification' => 'existing',
                'metadata' => [
                    'company' => 'Wealth Management Group',
                    'industry' => 'Financial Services',
                    'annual_revenue' => '$3.5M',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Rachel Green',
                'email' => 'rachel.green@email.com',
                'mobile' => '+1-555-0112',
                'address' => '963 Art Gallery Row, Portland, OR 97201',
                'classification' => 'conquest',
                'metadata' => [
                    'company' => 'Creative Studios',
                    'industry' => 'Arts & Design',
                    'annual_revenue' => '$400K',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Kevin Lee',
                'email' => 'kevin.lee@email.com',
                'mobile' => '+1-555-0113',
                'address' => '159 Gaming Street, Las Vegas, NV 89101',
                'classification' => 'potential',
                'metadata' => [
                    'company' => 'GameTech Solutions',
                    'industry' => 'Gaming Technology',
                    'annual_revenue' => '$1.5M',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Amanda Taylor',
                'email' => 'amanda.taylor@email.com',
                'mobile' => '+1-555-0114',
                'address' => '357 Education Lane, Nashville, TN 37201',
                'classification' => 'existing',
                'metadata' => [
                    'company' => 'Learning Academy',
                    'industry' => 'Education Technology',
                    'annual_revenue' => '$900K',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Carlos Mendez',
                'email' => 'carlos.mendez@email.com',
                'mobile' => '+1-555-0115',
                'address' => '468 Restaurant Row, New Orleans, LA 70112',
                'classification' => 'potential',
                'metadata' => [
                    'company' => 'Culinary Innovations',
                    'industry' => 'Food & Beverage',
                    'annual_revenue' => '$750K',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($customers as $customerData) {
            // Assign a random user as creator
            $customerData['created_by'] = $users->random()->id;
            
            $customer = Customer::firstOrCreate(
                ['email' => $customerData['email']],
                $customerData
            );

            // Assign random personas with confidence scores (only if not already assigned)
            if ($customer->personas()->count() === 0) {
                $randomPersonas = $personas->random(rand(1, 3));
                foreach ($randomPersonas as $persona) {
                    $customer->personas()->attach($persona->id, [
                        'confidence_score' => rand(60, 95),
                        'notes' => 'Auto-assigned during seeding',
                    ]);
                }
            }

            // Assign random tags (only if not already assigned)
            if ($customer->tags()->count() === 0) {
                $randomTags = $tags->random(rand(2, 5));
                foreach ($randomTags as $tag) {
                    $customer->tags()->attach($tag->id, [
                        'is_auto_applied' => $tag->auto_apply,
                        'notes' => 'Auto-assigned during seeding',
                    ]);
                }
            }
        }

        $this->command->info('Customers seeded successfully!');
        $this->command->info('Created ' . count($customers) . ' customers with personas and tags.');
    }
}