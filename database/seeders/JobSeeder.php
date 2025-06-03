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

        // Get the Test User ID
        $testUserId = User::where('email', 'test@test.com')->value('id');

        // Get all other user ids from User model except for the Test User
        $userIds = User::where('email', '!=', 'test@test.com')->pluck('id')->toArray();

        foreach ($jobListings as $index => &$listing) { // use '&' to pass it as reference

            if($index < 2){
                // Assign the first two listings to the Test User
                $listing['user_id'] = $testUserId;
            }else{
                // Assign user id to listing
                $listing['user_id'] = $userIds[array_rand($userIds)];
            }

            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert job listings
        DB::table('job_listings')->insert($jobListings);

        echo 'Jobs created successfully';
    }
}
