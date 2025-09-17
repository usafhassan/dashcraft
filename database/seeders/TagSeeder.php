<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            // Opportunity Tags
            [
                'name' => 'High Value Customer',
                'description' => 'Customers with high spending potential',
                'type' => 'opportunity',
                'color' => '#10B981',
                'priority' => 90,
                'is_active' => true,
                'auto_apply' => true,
                'activation_rules' => [
                    [
                        'field' => 'classification',
                        'operator' => 'equals',
                        'value' => 'existing',
                    ],
                ],
            ],
            [
                'name' => 'Resell Opportunities',
                'description' => 'Customers likely to purchase additional products',
                'type' => 'opportunity',
                'color' => '#059669',
                'priority' => 80,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Leases Due',
                'description' => 'Customers with leases expiring soon',
                'type' => 'opportunity',
                'color' => '#047857',
                'priority' => 85,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Upsell Potential',
                'description' => 'Customers ready for premium products',
                'type' => 'opportunity',
                'color' => '#065F46',
                'priority' => 75,
                'is_active' => true,
                'auto_apply' => false,
            ],

            // Activation Tags
            [
                'name' => 'Email Subscriber',
                'description' => 'Customers subscribed to email communications',
                'type' => 'activation',
                'color' => '#3B82F6',
                'priority' => 60,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Social Media Follower',
                'description' => 'Customers following on social media',
                'type' => 'activation',
                'color' => '#2563EB',
                'priority' => 55,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Newsletter Reader',
                'description' => 'Customers who read newsletters regularly',
                'type' => 'activation',
                'color' => '#1D4ED8',
                'priority' => 50,
                'is_active' => true,
                'auto_apply' => false,
            ],

            // Behavioral Tags
            [
                'name' => 'Frequent Buyer',
                'description' => 'Customers who make regular purchases',
                'type' => 'behavioral',
                'color' => '#8B5CF6',
                'priority' => 70,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Price Sensitive',
                'description' => 'Customers who respond to discounts and promotions',
                'type' => 'behavioral',
                'color' => '#7C3AED',
                'priority' => 65,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Brand Loyal',
                'description' => 'Customers with strong brand preference',
                'type' => 'behavioral',
                'color' => '#6D28D9',
                'priority' => 60,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Early Adopter',
                'description' => 'Customers who try new products first',
                'type' => 'behavioral',
                'color' => '#5B21B6',
                'priority' => 75,
                'is_active' => true,
                'auto_apply' => false,
            ],

            // Demographic Tags
            [
                'name' => 'Tech Enthusiast',
                'description' => 'Customers interested in technology',
                'type' => 'demographic',
                'color' => '#F59E0B',
                'priority' => 50,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Family Oriented',
                'description' => 'Customers focused on family needs',
                'type' => 'demographic',
                'color' => '#D97706',
                'priority' => 45,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Senior Citizen',
                'description' => 'Customers aged 65 and above',
                'type' => 'demographic',
                'color' => '#B45309',
                'priority' => 40,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Young Professional',
                'description' => 'Customers in early career stages',
                'type' => 'demographic',
                'color' => '#92400E',
                'priority' => 45,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Urban Dweller',
                'description' => 'Customers living in urban areas',
                'type' => 'demographic',
                'color' => '#78350F',
                'priority' => 35,
                'is_active' => true,
                'auto_apply' => false,
            ],

            // Special Tags
            [
                'name' => 'VIP Customer',
                'description' => 'High-priority customers requiring special attention',
                'type' => 'opportunity',
                'color' => '#DC2626',
                'priority' => 95,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'At Risk',
                'description' => 'Customers at risk of churning',
                'type' => 'behavioral',
                'color' => '#EF4444',
                'priority' => 90,
                'is_active' => true,
                'auto_apply' => false,
            ],
            [
                'name' => 'Referral Source',
                'description' => 'Customers who refer others',
                'type' => 'behavioral',
                'color' => '#F97316',
                'priority' => 80,
                'is_active' => true,
                'auto_apply' => false,
            ],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        $this->command->info('Tags seeded successfully!');
    }
}