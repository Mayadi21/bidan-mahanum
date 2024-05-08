<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Lifestyle', 'Fashion', 'Travel', 'Food', 'Health & Wellness',
            'Parenting', 'Technology', 'Business & Finance', 'Education',
            'Entertainment', 'DIY & Crafts', 'Social Issues', 'Photography',
            'Gardening', 'Home Decor', 'Pets', 'Relationships', 'Self Improvement',
            'Career Development', 'Finance & Investment', 'Real Estate',
            'Education & Learning', 'Art & Design', 'Fitness & Exercise',
            'Science & Innovation', 'Music', 'Literature & Writing', 'Motorsports',
            'Spirituality & Mindfulness', 'History'
        ];

        $categories_slug = [
            'lifestyle', 'fashion', 'travel', 'food', 'health-and-wellness',
            'parenting', 'technology', 'business-and-finance', 'education',
            'entertainment', 'diy-and-crafts', 'social-issues', 'photography',
            'gardening', 'home-decor', 'pets', 'relationships', 'self-improvement',
            'career-development', 'finance-and-investment', 'real-estate',
            'education-and-learning', 'art-and-design', 'fitness-and-exercise',
            'science-and-innovation', 'music', 'literature-and-writing', 'motorsports',
            'spirituality-and-mindfulness', 'history'
        ];

        foreach ($categories as $category) {
            Category::create([
                'category_name' => $category,
                'category_slug' => $categories_slug[array_search($category, $categories)],
                'category_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            ]);
        }
    }
}
