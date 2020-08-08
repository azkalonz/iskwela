<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
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

        \DB::table('admins')->delete();

        \DB::table('admins')->insert(array (
                0 => 
                array (
                    'id' => 1,
                    'role_id' => 1,
                    'name' => 'iSkwela SuperAdmin',
                    'email' => 'superadmin@iskwela.net',
                    'avatar' => 'users/default.png',
                    'password' => '$2y$10$f6WCNVXm60vOBts7fPRet.TmLKNCw60joJL/BRdTIMZqYOoQdngnq',
                    'remember_token' => NULL,
                    'settings' => NULL,
                    'created_at' => '2020-08-01 12:54:04',
                    'updated_at' => '2020-08-01 12:54:04',
                ),
            ));
       } catch(Exception $e) {
         throw new Exception('Exception occur ' . $e);

         \DB::rollBack();
       }

       \DB::commit();
    }
}
