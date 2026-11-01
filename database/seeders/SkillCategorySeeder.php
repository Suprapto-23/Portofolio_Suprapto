<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Hard Skill', 'Soft Skill', 'Tools'] as $i => $name) {
            SkillCategory::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'sort_order' => $i + 1, 'is_active' => true]
            );
        }
    }
}