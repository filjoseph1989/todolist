<?php

use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i = 0; $i < 10; $i++) {
        DB::table('todos')->insert([
          [
            'user_id'     => '1',
            'title'       => "Task {$i}",
            'description' => 'This is the sample description',
            'status'      => 'not-started',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
          ],
        ]);
      }
    }
}
