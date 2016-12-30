<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name_ru' => 'Государственные',
            'name_kz' => 'Мемлекеттік'
        ]);
        Category::create([
            'name_ru' => 'Международные',
            'name_kz' => 'Халықаралық'
        ]);
        Category::create([
            'name_ru' => 'Профессиональные',
            'name_kz' => 'Кәсіби'
        ]);
        Category::create([
            'name_ru' => 'Религиозные',
            'name_kz' => 'Діни'
        ]);
        Category::create([
            'name_ru' => 'Памятные даты',
            'name_kz' => 'Ұмытылмас даталар'
        ]);
    }
}
