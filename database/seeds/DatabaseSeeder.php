<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{

    private $counter = 30;

    private $postsNumber = 10;

    private $url = 'https://randomuser.me/api/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $faker = Faker::create('pl_PL');

        $this->generateRoles();

        $this->generateUsers($faker);

        $this->generatePosts($faker);
    }


    private function generateUsers($faker)
    {
      DB::table('users')->insert([
          'firstName' => 'Przemysław',
          'lastName' => 'Chudziński',
          'email' => 'przemo@wp.pl',
          'gender' => 2,
          'password' => bcrypt('12345678'),
          'role_id' => 1
      ]);

      for($i = 0; $i < $this->counter; $i++){
          $data = [
              'firstName' => $faker->firstName,
              'lastName' => $faker->lastName,
              'email' => $faker->safeEmail,
              'gender' => mt_rand(1,2),
              'password' => bcrypt('12345678'),
              'avatar' => $this->getUserAvatar()
          ];
          DB::table('users')->insert($data);
      }
    }

    private function generateRoles()
    {
      DB::table('roles')->insert(['type' => 'admin']);
      DB::table('roles')->insert(['type' => 'user']);
    }

    private function getUserAvatar()
    {
      $data = json_decode(file_get_contents($this->url));
      return $data->results[0]->picture->large;
    }

    private function generatePosts($faker)
    {
      $users = DB::table('users')->get();
      foreach ($users as $user) {
        for($i = 0; $i < $this->postsNumber; $i++){
          DB::table('posts')->insert([
            'user_id' => $user->id,
            'content' => $faker->paragraph(3)
          ]);
        }
      }
    }
}
