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
}
