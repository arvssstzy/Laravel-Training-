<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function dashboard()
    {
      
        return view('dashboard'); // Return only the content for AJAX requests
        

    }
    public function create()
    {
      
        return view('create'); // Return only the content for AJAX requests
        

    }

    public function about()
    {
        // Return the view or content for the About page
        return view('headndetails');
    }

    public function contact()
    {
        // Return the view or content for the Contact page
        return view('contact');
    }
}
