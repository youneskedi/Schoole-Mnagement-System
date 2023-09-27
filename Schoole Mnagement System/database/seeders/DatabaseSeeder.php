<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Asignment;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone_number' => '+90239402304',
            'password' => '1212',
            'img' => '1.png' ,
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'phone_number' => '+90239402304',
            'password' => '1212',
            'img' => '2.png' ,
            'role' => 'student',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'phone_number' => '+90239402304',
            'password' => '1212',
            'img' => '3.png' ,
            'role' => 'teacher',
        ]);

        for ($i = 1 ; $i<=5 ; $i++){
            User::factory()->create([
                'img' => $i .'.png' ,
                'phone_number' => '+90239402304',
                'password' => '1212' ,
                'role' => 'admin' ,
            ]);
        }

        for ($i = 1 ; $i<=5 ; $i++){
            User::factory()->create([
                'img' => $i .'.png' ,
                'phone_number' => '+90239402304',
                'password' => '1212' ,
                'role' => 'teacher' ,
            ]);
        }

        for ($i = 1 ; $i<=5 ; $i++){
            User::factory()->create([
                'img' => $i .'.png' ,
                'phone_number' => '+90239402304',
                'password' => '1212' ,
                'role' => 'student' ,
            ]);
        }

        $courses2 = [];
        $courses = [ ''  , 'Laravel' , 'React Js' , 'JavaScript', 'Vue Js' , 'Angular', 'Java' ] ;
        for ($i = 1 ; $i<=6 ; $i++){
             $course =Course::factory()->create([
                'img' => $i .'.png' ,
                'title' => $courses[$i] ,
            ]);
             array_push($courses2 , $course);
        }

        $sessions1 = [];
        $sessions2 = [[]];
        for ($i = 1 ; $i<6 ; $i++)
        {
            for ($j=1 ; $j<5 ; $j++){
                $session = Session::factory()->create([
                    'title' => 'Session ' . $j ,
                    'course_id' => $courses2[$i]
                ]);
                array_push($sessions1 , $session);
                $sessions2[]=$sessions1;
            }
        }


        for ($i = 1 ; $i<6 ; $i++)
        {
            for ($j=1 ; $j<5 ; $j++)
                Asignment::factory()->create([
                'title' => 'asignment ' . $j ,
                'course_id' => $i ,
                'desc' => 'Build A Complete Project In Laravel Using Laravel Ui Auth And Relastionship and Models... ' ,
            ]);
        }

    }
}
