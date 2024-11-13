<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function skillsAudit()
    {
        return view('skills-audit');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function spektralsatz()
    {
        return view('spektralsatz');
    }

    public function jobOpening()
    {
        return view('job-opening');
    }

    public function projects()
    {
        return view('projects');
    }

    public function raw($slug)
    {
        return view($slug)->with('layout', 'raw');
    }
}
