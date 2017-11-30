<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ImapAccount;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Colya',
                'email' => 'worldbeststar@outlook.com',
                'password' => bcrypt("Ahgifdk"),
                'remember_token' => str_random(10)
            ]
        );
        // $this->call(UsersTableSeeder::class);
        ImapAccount::create(
            [
                'fqdn'=>"domain.com",
                'port' => 993,
                'username' => 'username',
                'password' => 'password',
                // 'protocol' => enum(
                //     'SSL', 'TLS', 'STARTTLS'
                // ),
                'folder_name' => 'IMAP'
            ]
        );

    }
}
