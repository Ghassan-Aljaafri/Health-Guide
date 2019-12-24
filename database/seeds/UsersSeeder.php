<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User();
        $u->name = "admin";
        $u->email = "admin@hg.local";
        $u->password = bcrypt("1234");
        $u->save();
        $u->assignRole('admin');

        $u = new User();
        $u->name = "admin2";
        $u->email = "admin2@hg.local";
        $u->password = bcrypt("1234");
        $u->save();
        $u->assignRole('admin');

        $u = new User();
        $u->name = "patient";
        $u->email = "patient@hg.local";
        $u->password = bcrypt("1234");
        $u->save();
        $u->assignRole('patient');

        $u = new User();
        $u->name = "patient2";
        $u->email = "patient2@hg.local";
        $u->password = bcrypt("1234");
        $u->save();
        $u->assignRole('patient');

        $u = new User();
        $u->name = "nutritionist";
        $u->email = "nutritionist@hg.local";
        $u->password = bcrypt("1234");
        $u->save();
        $u->assignRole('nutritionist');

        $u = new User();
        $u->name = "nutritionist2";
        $u->email = "nutritionist2@hg.local";
        $u->password = bcrypt("1234");
        $u->save();
        $u->assignRole('nutritionist');
    }
}
