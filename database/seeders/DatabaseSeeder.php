<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Livrable;
use App\Models\Organization;
use App\Models\Phase;
use App\Models\PhaseUser;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Store default users

        $admin = User::create([
            'name' => 'Younes',
            'prenom' => 'Zahfouf',
            'photo' => 'Hlt8qIQsfhoBjwp1pIlAGfYGbd1at1IOCKd0pM8P.png',
            'phone_number' => '+212649486542',
            'email' => 'youneszahfouf@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $directeur = User::create([
            'name' => 'directeur',
            'prenom' => 'directeur',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'directeur@gmail.com',
            'password' => Hash::make('directeur'),
        ]);

        $secretaire = User::create([
            'name' => 'secretaire',
            'prenom' => 'secretaire',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'secretaire@gmail.com',
            'password' => Hash::make('secretaire'),
        ]);

        $chef_projet = User::create([
            'name' => 'cheff',
            'prenom' => 'project',
            'photo' => 'avatarchef.png',
            'phone_number' => '+212625601921',
            'email' => 'chef_projet@gmail.com',
            'password' => Hash::make('chef'),
        ]);

        $comptable = User::create([
            'name' => 'comptable',
            'prenom' => 'comptable',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'comptable@gmail.com',
            'password' => Hash::make('comptable'),
        ]);

        $user_1 = User::create([
            'name' => 'John',
            'prenom' => 'Doe',
            'photo' => '1.png',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'jhon@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user_2 = User::create([
            'name' => 'Jane',
            'prenom' => 'Smith',
            'photo' => '2.png',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'jane@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user_3 = User::create([
            'name' => 'Alex',
            'prenom' => 'Johnson',
            'photo' => '3.png',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'alex@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Create Application roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'directeur']);
        Role::create(['name' => 'secretaire']);
        Role::create(['name' => 'chef_projet']);
        Role::create(['name' => 'comptable']);
        Role::create(['name' => 'engineer']);
        Role::create(['name' => 'technician']);

        // Assigning roles to Application users
        $admin->assignRole('admin');
        $directeur->assignRole('directeur');
        $secretaire->assignRole('secretaire');
        $chef_projet->assignRole('chef_projet');
        $comptable->assignRole('comptable');
        $user_1->assignRole('engineer');
        $user_2->assignRole('engineer');
        $user_3->assignRole('engineer');

        // Organisations seeding

        Organization::create([
            "address" =>  "Casablanca",
            "contactEmail" => "iam@iam.com",
            "contactPhone" => "0623-327-7626",
            "name" =>  "IAM",
            "website"  => "https://www.iam.ma/index.aspx",
            "cover" => "https://www.iam.ma/ImagesMarocTelecom/Phototh%C3%A8que/Images-grandes/maroc-telecom-bleu-fr-grande.jpg"
        ]);

        Organization::create([
            "address" =>  "Usa",
            "contactEmail" => "ibm@ibm.com",
            "contactPhone" => "+1-23-324-7326",
            "name" =>  "IBM",
            "website"  => "https://www.ibm.com",
            "cover" => "https://upload.wikimedia.org/wikipedia/commons/f/fc/IBM_logo_in.jpg"
        ]);

        Organization::create([
            "address" =>  "Canada",
            "contactEmail" => "kptal@kpda.com",
            "contactPhone" => "+1-23-324-7326",
            "name" =>  "Kp Capital",
            "website"  => "https://www.kpcapital.com",
            "cover" => "https://cdn.logojoy.com/wp-content/uploads/2018/05/01104823/1454.png"
        ]);


        Project::create([
            "name" => "project 1" ,
            "des" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged" ,
            "status" => "In" ,
            "org" => 1 ,
            "budget" => 300000 ,
            "progress" => 20 ,
            "chef" => 4 ,
            "start_date" => "2022-11-25" ,
            "end_date" => "2022-10-24"
        ]);

        Phase::create([
            "name"=> "Create React App Project 1",
            "description"=>  "Developing a web application using Create React App 1",
            "startDate"=> "2023-05-01",
            "endDate"=>  "2023-06-30",
            "budgetPercentage"=>  20,
            "project" => 1
        ]);

        Phase::create([
            "name"=> "Create React App Project 2",
            "description"=>  "Developing a web application using Create React App 2",
            "budgetPercentage"=>  20,
            "project" => 1
        ]);

        Livrable::create([
            "name" => "Initial UI Design",
            "description" => "Mockup of UI design"  ,
            "filePath" => "https://drive.google.com/file/d/1WmrfNa5xVll-eZIhHDiIIPwf1STtx9eW/view" ,
            "External" => true ,
            "phase" => 1
        ]);


        Livrable::create([
            "name" => "API Integration",
            "description" => "Integration with backend API endpoints"  ,
            "filePath" => "https://drive.google.com/file/d/1WmrfNa5xVll-eZIhHDiIIPwf1STtx9eW/view" ,
            "External" => true ,
            "phase" => 1
        ]);


        Livrable::create([
            "name" => "React Component",
            "description" => "Developing reusable React components"  ,
            "filePath" => "https://drive.google.com/file/d/1WmrfNa5xVll-eZIhHDiIIPwf1STtx9eW/view" ,
            "External" => true ,
            "phase" => 1
        ]);

        PhaseUser::create([
            "phase" =>  1 ,
            "user" => 6
        ]);

        PhaseUser::create([
            "phase" =>  1 ,
            "user" => 7
        ]);
        PhaseUser::create([
            "phase" =>  1 ,
            "user" => 8
        ]);


        PhaseUser::create([
            "phase" =>  2 ,
            "user" => 6
        ]);

        PhaseUser::create([
            "phase" =>  2 ,
            "user" => 7
        ]);



    }
}
