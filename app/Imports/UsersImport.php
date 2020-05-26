<?php

namespace App\Imports;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class UsersImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    const USER_TYPE = 't';
    const GENDER = [
        'Male' => 'm',
        'Female' => 'f',
        ' ' => null
    ];

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        info($row);
        return new User([
            'username'      => $this->generateUsername($row[0], $row[2]),
            'first_name'    => $row[0],
            'middle_name'   => $row[1],
            'last_name'     => $row[2],
            'gender'        => self::GENDER[$row[3]],
            'phone_number'  => $row[4],
            'email'         => $row[5],
            'user_type'     => $this::USER_TYPE,
            'password'      => Hash::make($row[2]),
        ]);
    }

    /**
     * Generate username based off of first name and last name
     *
     * @param string $firstname
     * @param string $lastname
     * @return void
     */
    private function generateUsername($firstname, $lastname)
    {
        // get first letters of first name
        $shorthand = implode("", array_map( function($fn) {
            return substr($fn, 0, 1);
        }, explode(' ', strtolower($firstname))));

        $username = $shorthand.str_replace(' ', '', strtolower($lastname));

        // check username exist
        $i = User::whereUsername($username)->count();
        while (User::whereUsername($username)->exists()) {
            $i++;
            $username = $username . $i;
        }

        return $username;
    }
}
