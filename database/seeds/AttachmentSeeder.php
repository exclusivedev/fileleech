<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Attachment;

class AttachmentSeeder extends Seeder
{
    public function run()
    {
        factory(Attachment::class, 10)->create()->each(function(Attachment $comment) {

        });
    }
}