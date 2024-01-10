<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $images = [
            [
                'url' => 'https://cdn.i-scmp.com/sites/default/files/d8/images/canvas/2021/11/11/d0b5cf74-e27c-4c73-be42-5f030b5d64f0_f9a0e910.jpg',
                'title' => 'Image 1 Title',
                'desc' => 'Description for Image 1',
                'navigationUrl' => 'https://example.com/page1',
                'buttonText' => 'See More',
            ],
            [
                'url' => 'https://api.time.com/wp-content/uploads/2019/10/00.-twice-e18486e185b5e18482e185b5-8e1848ce185b5e186b8-feel-special_a-twice_e1848fe185b3e186afe18485e185b5e186ab.jpg',
                'title' => 'Image 2 Title',
                'desc' => 'Description for Image 2',
                'navigationUrl' => 'https://example.com/page2',
                'buttonText' => 'Learn More',

            ],
            [
                'url' => 'https://i.pinimg.com/originals/ca/12/b1/ca12b14c900ae8b286732964e3e917ae.jpg',
                'title' => 'Image 3 Title',
                'desc' => 'Description for Image 3',
                'navigationUrl' => 'https://example.com/page3',
                'buttonText' => 'Join Now',
            ],
            // Add more image details as needed
        ];

        return view('home.index', [
            'images' => $images
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
