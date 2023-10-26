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
      TechnologySeeder::class,
      ProjectSeeder::class,
      ProjectTechnologySeeder::class,
      UserSeeder::class
    ]);
  }
}