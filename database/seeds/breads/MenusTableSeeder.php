<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
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

        \DB::table('menus')->delete();

        \DB::table('menus')->insert(array (
                0 => 
                array (
                    'id' => 1,
                    'name' => 'admin',
                    'created_at' => '2020-08-01 12:51:43',
                    'updated_at' => '2020-08-01 12:51:43',
                ),
            ));
       } catch(Exception $e) {
         throw new Exception('Exception occur ' . $e);

         \DB::rollBack();
       }

       \DB::commit();
    }
}
