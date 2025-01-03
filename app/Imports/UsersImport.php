<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $data = [
                'name' => $row['name'],
                'user_status_id' => $row['status'],
            ];
    
            // Only add the password if it is not null
            if (!empty($row['password'])) {
                $data['password'] = Hash::make($row['password']);
            }
    
            User::query()->updateOrCreate(
                [
                    'email' => $row['email'],
                ],
                $data
            );
            // User::query()->updateOrCreate(
            //     [
            //         'email' => $row['email'],
            //     ],
            //     [
            //         'name' => $row['name'],
            //         'user_status_id'=> $row['status'],
            //         'password' => Hash::make($row['password']),
            //     ]

            // );
        }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'user_status_id' => 'required',
            'password' => 'nullable',
        ];
    }
}
