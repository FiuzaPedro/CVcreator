<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Pedro Fiuza',
            'email' => 'pedro_fiuza@hotmail.com',
            'password' => 12345678,
            'phone' => 351916743567,
            'role' => 'Junior Full Stack Developer',
            'techskills' => 'HTML5,CSS3,Javascript,jQuery,Bootstrap,PHP,Laravel',
            'softskills' => 'Responsible,Persistent,Honest,Loyal',
            'linkedin' => 'https://www.linkedin.com/in/pedrofiuza79/',
            'photo' => 'profile_images/fiuza.jpg',
            'about' => "I am Pedro, an enthusiastic Web Developer and currently looking for a good opportunity on Web Development positions, either Back End or Front End.
Last year, I gained a lot of experience at a Junior FullStack Developer position and really enjoyed the ride. I hope you like my profile and this custom-made CV that employs some of the skills I improved lately."
        ]);
    }
}
