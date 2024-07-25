<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(){
        $jobs = Job::all()->groupBy('featured');
        return view('jobs.index',[
            'featuredJobs'=>$jobs[1],
            'jobs'=>$jobs[0],
            'tags'=>Tag::all()
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required|string',
            'salary'=>'required',
            'location'=>'required|string',
            'schedule'=>'required',
            'url'=>'required|url',
            'tags'=>'required'
        ]);

        $data['featured'] = $request->has('feature');
        // $data['employer_id']= Auth::user()->employer->id;
        // $job = Job::create(Arr::except($data,'tags'));
        $job = Auth::user()->employer->job()->create(Arr::except($data, 'tags'));

        $tags = explode(',',$data['tags']);
        foreach($tags as $tag){
            $job->tag($tag);
        }
        return redirect('/');
    }
}
