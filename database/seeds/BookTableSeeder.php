<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Storage::disk('local')->delete(Storage::allFiles());
        App\Genre::create([
                'name' => 'science',
        ]);

        App\Genre::create([
            'name' => 'maths',
        ]);

        App\Genre::create([
            'name' => 'cookbook'
        ]);

        factory(App\Book::class, 30)->create()->each(function($book){
            $link = str_random(12) . '.jpg';
            $file = file_get_contents('https://picsum.photos/250/250?image=' . rand(1,100));
            Storage::disk('local')->put($link, $file);
            $book->genre()->associate(rand(1,2));

            $book->picture()->create([
                'title' => 'Default',
                'link' => $link
            ]);

            $authors = App\Author::pluck('id')->shuffle()->slice(0,rand(1,3))->all();


            $book->authors()->attach($authors);

            $book->save();
        });
    }
}
