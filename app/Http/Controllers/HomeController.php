<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function menuPage()
    {
        $foodItems = MenuItem::where('category', 'Food')->latest()->get();
        $snackItems = MenuItem::where('category', 'Snacks')->latest()->get();
        $drinkItems = MenuItem::where('category', 'Drinks')->latest()->get();

        return view('pages.caffe.menu', compact('foodItems', 'snackItems', 'drinkItems'));
    }

    public function photosPage()
    {
        // Return the photos page view - update to correct gallery page view
        return view('pages.caffe.gallery');
    }

    public function aboutPage()
    {
        // Return the about page view - replace 'public.about' with your actual view
        return view('public.about');
    }

    public function ourTeamPage()
    {
        // Return the about our team page view - replace 'public.about.ourteam' with your actual view
        return view('public.about.ourteam');
    }

    public function videosPage()
    {
        // Return the videos page view - replace 'public.videos.index' with your actual view
        return view('public.videos.index');
    }
}
