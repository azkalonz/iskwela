<?php

use Illuminate\Database\Seeder;

class Data_typesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
     try {
        \DB::beginTransaction();

        \DB::table('data_types')->delete();

        \DB::table('data_types')->insert(array (
                0 => 
                array (
                    'id' => 1,
                    'name' => 'users',
                    'slug' => 'users',
                    'display_name_singular' => 'School User',
                    'display_name_plural' => 'School Users',
                    'icon' => 'voyager-person',
                    'model_name' => 'App\\Models\\User',
                    'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                    'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                    'created_at' => '2020-08-01 12:51:42',
                    'updated_at' => '2020-08-01 13:26:11',
                ),
                1 => 
                array (
                    'id' => 2,
                    'name' => 'menus',
                    'slug' => 'menus',
                    'display_name_singular' => 'Menu',
                    'display_name_plural' => 'Menus',
                    'icon' => 'voyager-list',
                    'model_name' => 'TCG\\Voyager\\Models\\Menu',
                    'policy_name' => NULL,
                    'controller' => '',
                    'description' => '',
                    'generate_permissions' => 1,
                    'server_side' => 0,
                    'details' => NULL,
                    'created_at' => '2020-08-01 12:51:42',
                    'updated_at' => '2020-08-01 12:51:42',
                ),
                2 => 
                array (
                    'id' => 3,
                    'name' => 'roles',
                    'slug' => 'roles',
                    'display_name_singular' => 'Role',
                    'display_name_plural' => 'Roles',
                    'icon' => 'voyager-lock',
                    'model_name' => 'TCG\\Voyager\\Models\\Role',
                    'policy_name' => NULL,
                    'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                    'description' => '',
                    'generate_permissions' => 1,
                    'server_side' => 0,
                    'details' => NULL,
                    'created_at' => '2020-08-01 12:51:42',
                    'updated_at' => '2020-08-01 12:51:42',
                ),
                3 => 
                array (
                    'id' => 4,
                    'name' => 'schools',
                    'slug' => 'schools',
                    'display_name_singular' => 'School',
                    'display_name_plural' => 'Schools',
                    'icon' => NULL,
                    'model_name' => 'App\\Models\\School',
                    'policy_name' => NULL,
                    'controller' => NULL,
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                    'created_at' => '2020-08-01 13:08:59',
                    'updated_at' => '2020-08-01 13:08:59',
                ),
                4 => 
                array (
                    'id' => 6,
                    'name' => 'classes',
                    'slug' => 'classes',
                    'display_name_singular' => 'Class',
                    'display_name_plural' => 'Classes',
                    'icon' => 'voyager-logbook',
                    'model_name' => 'App\\Models\\Classes',
                    'policy_name' => NULL,
                    'controller' => NULL,
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                    'created_at' => '2020-08-01 13:19:36',
                    'updated_at' => '2020-08-01 13:19:36',
                ),
            ));
       } catch(Exception $e) {
         throw new Exception('Exception occur ' . $e);

         \DB::rollBack();
       }

       \DB::commit();
    }
}
