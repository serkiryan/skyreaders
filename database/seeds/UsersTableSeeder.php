<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 100)->create();
        $books = App\Book::all();
        App\User::all()->each(function ($user) use ($books) {
            $booksId = $books->random(rand(0, 25))->pluck('id')->toArray();
            foreach ($booksId as $bookId) {
                $user->books()->attach(
                    $bookId , ['created_at' => date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days'))]
                ); 
            }
        });
    }
}
