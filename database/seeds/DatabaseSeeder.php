<?php

use Illuminate\Database\Seeder;
use App\Entity\Post\Tag;
use App\Entity\Post\Category;
use App\Entity\Post\Post;
use App\Entity\Page;
use App\Entity\Menu;
use App\Entity\Post\TagRelationship;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Random generation
//        factory(Tag::class, 5)->create();
//        factory(Category::class, 5)->create();
//        factory(Post::class, 4)->create()->each(function ($post) {
//            return factory(TagRelationship::class)->create(['post_id' => $post->id]);
//        });
//        factory(Page::class, 2)->create();
//        factory(Menu::class, 2)->create();

        // Manual creating

        // Create Category
        factory(Category::class)->create([
            'name' => 'Первая категория',
            'slug' => 'novaya-categoriya',
            'description' => 'Краткое описание категории...'
        ]);

        // Create Posts
        factory(Post::class)->create(
            [
                'title' => 'Добро пожаловать!',
                'slug' => 'dobro-pojalovat',
                'content' => 'Моя первая запись которую желательно удалить после успешного попадания в администрационную панель,
                 а также не забыть изменить настройки при необходимости...',
                'category_id' => 1
            ]
        );

        // Create Page
        factory(Page::class)->create(
            [
                'title' => 'Добро пожаловать | Главная страница',
                'slug' => 'home',
                'content' => "<p>Моя первая страница которую желательно отредактировать после успешного попадания в администрационную панель,
                 а также не забыть изменить настройки при необходимости... </p><p><img src='https://img.freepik.com/free-vector/welcome-composition-with-flat-design_23-2147895653.jpg?size=338&ext=jpg' alt=''></p>",
            ]
        );

        // Create Menus

        factory(Menu::class)->create(
            [
                'type' => 0,
                'page_id' => 1,
                'title' => 'Главная'
            ]
        );

        factory(Menu::class)->create(
            [
                'type' => 1,
                'page_id' => null,
                'category_id' => 1,
                'title' => 'Категория'
            ]
        );

        // Settings
        $homePage = App\Entity\Project\Settings::where('name', 'home_page')->first();
        $homePage->update(['value' => 1]);

    }
}
