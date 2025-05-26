<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listings from the file
        $jobListings = include database_path('seeders/data/job_listings.php');

        // Get user_ids from User model
        $userIds = User::pluck('id')->toArray();

        foreach ($jobListings as &$listing) { // use '&' to pass it as reference
            // Assign user id to listing
            $listing['user_id'] = $userIds[array_rand($userIds)];

            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert job listings
        DB::table('job_listings')->insert($jobListings);

        echo 'Jobs created successfully';
    }
}
