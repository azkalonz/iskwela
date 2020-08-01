<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
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

        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
                0 => 
                array (
                    'id' => 1,
                    'key' => 'browse_admin',
                    'table_name' => NULL,
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                1 => 
                array (
                    'id' => 2,
                    'key' => 'browse_bread',
                    'table_name' => NULL,
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                2 => 
                array (
                    'id' => 3,
                    'key' => 'browse_database',
                    'table_name' => NULL,
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                3 => 
                array (
                    'id' => 4,
                    'key' => 'browse_media',
                    'table_name' => NULL,
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                4 => 
                array (
                    'id' => 5,
                    'key' => 'browse_compass',
                    'table_name' => NULL,
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                5 => 
                array (
                    'id' => 6,
                    'key' => 'browse_menus',
                    'table_name' => 'menus',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                6 => 
                array (
                    'id' => 7,
                    'key' => 'read_menus',
                    'table_name' => 'menus',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                7 => 
                array (
                    'id' => 8,
                    'key' => 'edit_menus',
                    'table_name' => 'menus',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                8 => 
                array (
                    'id' => 9,
                    'key' => 'add_menus',
                    'table_name' => 'menus',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                9 => 
                array (
                    'id' => 10,
                    'key' => 'delete_menus',
                    'table_name' => 'menus',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                10 => 
                array (
                    'id' => 11,
                    'key' => 'browse_roles',
                    'table_name' => 'roles',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                11 => 
                array (
                    'id' => 12,
                    'key' => 'read_roles',
                    'table_name' => 'roles',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                12 => 
                array (
                    'id' => 13,
                    'key' => 'edit_roles',
                    'table_name' => 'roles',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                13 => 
                array (
                    'id' => 14,
                    'key' => 'add_roles',
                    'table_name' => 'roles',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                14 => 
                array (
                    'id' => 15,
                    'key' => 'delete_roles',
                    'table_name' => 'roles',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                15 => 
                array (
                    'id' => 16,
                    'key' => 'browse_users',
                    'table_name' => 'users',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                16 => 
                array (
                    'id' => 17,
                    'key' => 'read_users',
                    'table_name' => 'users',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                17 => 
                array (
                    'id' => 18,
                    'key' => 'edit_users',
                    'table_name' => 'users',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                18 => 
                array (
                    'id' => 19,
                    'key' => 'add_users',
                    'table_name' => 'users',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                19 => 
                array (
                    'id' => 20,
                    'key' => 'delete_users',
                    'table_name' => 'users',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                20 => 
                array (
                    'id' => 21,
                    'key' => 'browse_settings',
                    'table_name' => 'settings',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                21 => 
                array (
                    'id' => 22,
                    'key' => 'read_settings',
                    'table_name' => 'settings',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                22 => 
                array (
                    'id' => 23,
                    'key' => 'edit_settings',
                    'table_name' => 'settings',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                23 => 
                array (
                    'id' => 24,
                    'key' => 'add_settings',
                    'table_name' => 'settings',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                24 => 
                array (
                    'id' => 25,
                    'key' => 'delete_settings',
                    'table_name' => 'settings',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                25 => 
                array (
                    'id' => 26,
                    'key' => 'browse_hooks',
                    'table_name' => NULL,
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
                26 => 
                array (
                    'id' => 27,
                    'key' => 'browse_schools',
                    'table_name' => 'schools',
                    'created_at' => '2020-08-01 13:09:01',
                    'updated_at' => '2020-08-01 13:09:01',
                ),
                27 => 
                array (
                    'id' => 28,
                    'key' => 'read_schools',
                    'table_name' => 'schools',
                    'created_at' => '2020-08-01 13:09:01',
                    'updated_at' => '2020-08-01 13:09:01',
                ),
                28 => 
                array (
                    'id' => 29,
                    'key' => 'edit_schools',
                    'table_name' => 'schools',
                    'created_at' => '2020-08-01 13:09:01',
                    'updated_at' => '2020-08-01 13:09:01',
                ),
                29 => 
                array (
                    'id' => 30,
                    'key' => 'add_schools',
                    'table_name' => 'schools',
                    'created_at' => '2020-08-01 13:09:01',
                    'updated_at' => '2020-08-01 13:09:01',
                ),
                30 => 
                array (
                    'id' => 31,
                    'key' => 'delete_schools',
                    'table_name' => 'schools',
                    'created_at' => '2020-08-01 13:09:01',
                    'updated_at' => '2020-08-01 13:09:01',
                ),
                31 => 
                array (
                    'id' => 32,
                    'key' => 'browse_classes',
                    'table_name' => 'classes',
                    'created_at' => '2020-08-01 13:19:38',
                    'updated_at' => '2020-08-01 13:19:38',
                ),
                32 => 
                array (
                    'id' => 33,
                    'key' => 'read_classes',
                    'table_name' => 'classes',
                    'created_at' => '2020-08-01 13:19:38',
                    'updated_at' => '2020-08-01 13:19:38',
                ),
                33 => 
                array (
                    'id' => 34,
                    'key' => 'edit_classes',
                    'table_name' => 'classes',
                    'created_at' => '2020-08-01 13:19:38',
                    'updated_at' => '2020-08-01 13:19:38',
                ),
                34 => 
                array (
                    'id' => 35,
                    'key' => 'add_classes',
                    'table_name' => 'classes',
                    'created_at' => '2020-08-01 13:19:38',
                    'updated_at' => '2020-08-01 13:19:38',
                ),
                35 => 
                array (
                    'id' => 36,
                    'key' => 'delete_classes',
                    'table_name' => 'classes',
                    'created_at' => '2020-08-01 13:19:39',
                    'updated_at' => '2020-08-01 13:19:39',
                ),
            ));
       } catch(Exception $e) {
         throw new Exception('Exception occur ' . $e);

         \DB::rollBack();
       }

       \DB::commit();
    }
}
