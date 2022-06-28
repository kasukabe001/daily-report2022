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
        DB::table('users')->insert([
            'name' => 'Administrator',
            'affiliation' => '業務日報管理機構',
            'email' => 'admin@email.com',
            'password' => '$2y$10$ANKJEp3tb.HkhzY1Z6sHdOT4BAKHLwf7f2e/bvl/DAHgMhqUfv1lu',
            'admin_flg' => '1'
        ]);
    }
}
