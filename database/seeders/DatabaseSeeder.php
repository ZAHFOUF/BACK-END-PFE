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
use Spatie\Permission\Models\Permission ;
use Spatie\Permission\Models\Role;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // store roles of the application



        // Create Application roles
       $admin =  Role::create(['name' => 'admin']);
       $directeur =  Role::create(['name' => 'directeur']);
       $secretaire =  Role::create(['name' => 'secretaire']);
       $chef_projet =  Role::create(['name' => 'chef_projet']);
       $comptable =   Role::create(['name' => 'comptable']);
       $engineer =  Role::create(['name' => 'engineer']);
       $technician = Role::create(['name' => 'technician']);

       // Create Application Permission that gonna be a long

       // users
       Permission::create(['name' => "create-user"]);
       Permission::create(['name' => "edit-user"]);
       Permission::create(['name' => "delete-user"]);
       Permission::create(['name' => "read-user"]);

        // Organizations
        Permission::create(['name' => "create-org"]);
        Permission::create(['name' => "edit-org"]);
        Permission::create(['name' => "delete-org"]);
        Permission::create(['name' => "read-org"]);

        // Projects
        Permission::create(['name' => "create-project"]);
        Permission::create(['name' => "edit-project"]);
        Permission::create(['name' => "delete-project"]);
        Permission::create(['name' => "read-project"]);
        Permission::create(['name' => "read-his-project"]);


        // Phases
        Permission::create(['name' => "create-phase"]);
        Permission::create(['name' => "edit-phase"]);
        Permission::create(['name' => "delete-phase"]);
        Permission::create(['name' => "read-phase"]);

        // Livrables
        Permission::create(['name' => "create-livrable"]);
        Permission::create(['name' => "edit-livrable"]);
        Permission::create(['name' => "delete-livrable"]);
        Permission::create(['name' => "read-livrable"]);

        // Roles
        Permission::create(['name' => "create-role"]);
        Permission::create(['name' => "edit-role"]);
        Permission::create(['name' => "delete-role"]);
        Permission::create(['name' => "read-role"]);

        // settings
        Permission::create(['name' => "refrech-db"]);



       // affect permission to roles app

       $directeur->givePermissionTo(['read-user']);
       $secretaire->givePermissionTo(['read-user']);
       $chef_projet->givePermissionTo(['read-user']);


       $directeur->givePermissionTo(['read-org' , 'edit-org' ,"delete-org" ]);
       $secretaire->givePermissionTo(["create-org" , 'read-org' , 'edit-org']);


       $directeur->givePermissionTo(['read-project' , 'edit-project' ,"delete-project" ]);
       $chef_projet->givePermissionTo(["read-his-project" ]);

       $secretaire->givePermissionTo(["create-project" , 'read-project' , 'edit-project']);


       $chef_projet->givePermissionTo(['read-phase' , 'edit-phase' ,"delete-phase" , "create-phase" ]);
       $directeur->givePermissionTo(['read-phase' ]);
       $secretaire->givePermissionTo(["read-phase" ]);
       $chef_projet->givePermissionTo(['read-livrable' , 'edit-livrable' ,"create-livrable" , "delete-livrable" ]);
       $directeur->givePermissionTo(['read-livrable' ]);
       $secretaire->givePermissionTo(["read-livrable" ]);


        // give to admin all permissions
        $permissions = Permission::all('*');
        $admin->givePermissionTo($permissions);











        // Store default users

        $user_1 = User::create([
            'name' => 'Younes',
            'prenom' => 'Zahfouf',
            'photo' => 'Hlt8qIQsfhoBjwp1pIlAGfYGbd1at1IOCKd0pM8P.png',
            'phone_number' => '+212649486542',
            'email' => 'youneszahfouf@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $user_2 = User::create([
            'name' => 'directeur',
            'prenom' => 'directeur',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'directeur@gmail.com',
            'password' => Hash::make('directeur'),
        ]);

        $user_3 = User::create([
            'name' => 'secretaire',
            'prenom' => 'secretaire',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'secretaire@gmail.com',
            'password' => Hash::make('secretaire'),
        ]);

        $user_4 = User::create([
            'name' => 'cheff',
            'prenom' => 'project',
            'photo' => 'avatarchef.png',
            'phone_number' => '+212625601921',
            'email' => 'chef_projet@gmail.com',
            'password' => Hash::make('chef'),
        ]);

        $user_5 = User::create([
            'name' => 'comptable',
            'prenom' => 'comptable',
            'photo' => 'nothing',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'comptable@gmail.com',
            'password' => Hash::make('comptable'),
        ]);

        $user_6 = User::create([
            'name' => 'John',
            'prenom' => 'Doe',
            'photo' => '1.png',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'jhon@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user_7 = User::create([
            'name' => 'Jane',
            'prenom' => 'Smith',
            'photo' => '2.png',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'jane@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user_8 = User::create([
            'name' => 'Alex',
            'prenom' => 'Johnson',
            'photo' => '3.png',
            'phone_number' => fake()->phoneNumber(),
            'email' => 'alex@gmail.com',
            'password' => Hash::make('password'),
        ]);


          // affect roles in his roles
          $user_1->assignRole('admin');
          $user_2->assignRole('directeur');
          $user_3->assignRole('secretaire');
          $user_4->assignRole('chef_projet');
          $user_5->assignRole('comptable');
          $user_6->assignRole('engineer');
          $user_7->assignRole('engineer');
          $user_8->assignRole('engineer');





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
