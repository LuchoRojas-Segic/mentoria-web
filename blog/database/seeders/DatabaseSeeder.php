<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::truncate();
         Category::truncate();

         $user = User::factory()->create();

         $personal = Category::create([
             'name' => 'Personal',
             'slug' => 'personal'
         ]);

         $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        $hobbies = Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies'
        ]);

        Post::create([
            'category_id' => $work->id ,
            'user_id' => $user->id,
            'slug' => 'my-first-blog',
            'title' => 'My first blog',
            'resumen' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio libero similique cumque, quod impedit sequi tempore dolore quia nobis commodi minus. Consequatur asperiores iusto officia voluptas porro. Commodi, perspiciatis harum',
        ]);
    }
}
