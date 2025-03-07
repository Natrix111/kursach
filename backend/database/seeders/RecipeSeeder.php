<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        Recipe::create([
            'user_id' => 1,
            'title' => 'Яблочные пончики',
            'description' => 'Вкусные и сладкие яблочные пончики.',
            'ingredients' => ['яблоки', 'мука', 'сахар', 'яйцо'],
            'instructions' => 'Смешайте все ингредиенты и жарьте до золотистой корочки.',
            'images' => ["http://localhost/api/storage/recipes/applefritters.png"],
        ]);

        Recipe::create([
            'user_id' => 2,
            'title' => 'Клубный сэндвич',
            'description' => 'Сытный клубный сэндвич с курицей и овощами.',
            'ingredients' => ['хлеб', 'курица', 'помидоры', 'салат'],
            'instructions' => 'Сложите все ингредиенты между двумя кусками хлеба.',
            'images' => ["http://localhost/api/storage/recipes/clubsandwich.png"],
        ]);

        Recipe::create([
            'user_id' => 3,
            'title' => 'Эклеры',
            'description' => 'Нежные эклеры с кремом.',
            'ingredients' => ['мука', 'яйца', 'сливки'],
            'instructions' => 'Приготовьте тесто, выпекайте и заполните кремом.',
            'images' => ["http://localhost/api/storage/recipes/eclairs.png"],
        ]);

        Recipe::create([
            'user_id' => 1,
            'title' => 'Луковые кольца',
            'description' => 'Хрустящие луковые кольца в кляре.',
            'ingredients' => ['лук', 'мука', 'панировочные сухари'],
            'instructions' => 'Нарежьте лук, обваляйте в муке и обжарьте до золотистого цвета.',
            'images' => ["http://localhost/api/storage/recipes/onionrings.png"],
        ]);

        Recipe::create([
            'user_id' => 2,
            'title' => 'Йогурт с бананом и шоколадом',
            'description' => 'Полезный йогурт с бананом и шоколадом.',
            'ingredients' => ['йогурт', 'бананы', 'шоколад'],
            'instructions' => 'Смешайте йогурт с нарезанными бананами и тертым шоколадом.',
            'images' => ["http://localhost/api/storage/recipes/yogurtwithbananaandchocolate.png"],
        ]);
    }
}
