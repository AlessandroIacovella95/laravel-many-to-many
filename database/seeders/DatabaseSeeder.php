<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * SUserSeeder
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      TypeSeeder::class,
      ProjectSeeder::class,
      UserSeeder::class
    ]);
  }
}