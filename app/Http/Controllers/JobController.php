<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Tag::all(),
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $attributes = $request->only([
            'title', 
            'salary', 
            'location', 
            'schedule',
            'url',
            'tags'
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return redirect('/');
    }
}
