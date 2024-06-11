<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class StaffSeeder extends Seeder
{
    public function run()
    {
        

        $faker = Factory::create();

        $numberOfRecords = 10;
        // creare seeder random data user
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $data = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'position' => $faker->jobTitle,
                'email' => $faker->email,
                'office' => $faker->city,
                'extn' => $faker->randomNumber(4),
                'age' => $faker->numberBetween(20, 60),
                'salary' => $faker->numberBetween(30000, 80000),
                'start_date' => $faker->date('Y-m-d'),
            ];
            // Using Query Builder
            $this->db->table('staff')->insertBatch($data);
        };

        // Sử dụng Query Builder để chèn dữ liệu vào bảng
    }
}
