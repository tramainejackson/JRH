<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

class BlogsController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
    */
    public function __construct() {
        $this->middleware('auth');
    }
	
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
		$blogs = Blogs::paginate(12);
		$blogsTotal = Blogs::all();
		$settings = Settings::find(1);
        return view('blogs.index', compact('settings', 'blogs', 'blogsTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
		return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
			'name' => 'required',
			'title' => 'required|max:100',
		]);
	
		$blogs = new Blogs();
	    $blogs->title = $request->title;
		
		if($request->hasFile('name')) {
			$path = "";
			foreach($request->file('name') as $document) {
				if($document->guessExtension() == 'png' || $document->guessExtension() == 'jpg' || $document->guessExtension() == 'jpeg' || $document->guessExtension() == 'gif' || $document->guessExtension() == 'bmp') {
					// Document is an image
					$imgPath = $document->store('public/files');
					$path .= $imgPath;
					$path .= "; ";
					$image = Image::make($document->getRealPath())->orientate();
					$image->save(storage_path('app/'. $imgPath));
				} else {
					$path .= $document->store('public/files');
					$path .= "; ";
				}
			}
			
			//Find the lasy simi-colon and remove it
			$lastColon = strrpos($path, ";");
			$blogs->name = substr_replace($path, "", $lastColon, 1);
		}

		if($blogs->save()) {
			return redirect()->action('BlogsController@edit', $blogs)->with('status', 'Blog Added Successfully');
		}

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blogs $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs $blogs) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogs $blog) {
        return view('blogs.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blogs $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogs $blogs) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blogs $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog) {
		$blog = Blogs::find($blog);
        $blog->delete();
		
		return redirect()->action('BlogsController@index', $blog)->with('status', 'Blog Deleted Successfully');
    }
}
