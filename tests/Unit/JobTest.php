<?php


use Tests\TestCase;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;

it('belongs to an employer', function () {
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_id' => $employer->id,
    ]);

    expect($job->employer->is($employer))->toBeTrue();
});

it('can have tags', function() {
   $job = Job::factory()->create();

   $job->tag('frontend');

   expect($job->tags)->toHaveCount(1);

});
