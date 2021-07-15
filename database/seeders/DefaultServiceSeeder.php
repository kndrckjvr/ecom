<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DefaultServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $users = collect(User::DEFAULT_USERS)->map(function ($user) {
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            return $user;
        })->all();

        User::insert($users);

        $services = collect(Service::DEFAULT_SERVICES)->map(function ($service) {
            $service['user_id'] = User::where('name', $service['user_id'])->first()->id;
            return $service;
        })->all();

        Service::insert($services);

        Schema::enableForeignKeyConstraints();
    }
}
