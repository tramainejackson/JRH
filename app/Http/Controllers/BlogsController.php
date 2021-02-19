<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class BlogsController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
    */
    public function __construct() {
        $this->middleware('auth')->except(['index']);
    }
	
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
		$blogs       = Blogs::paginate(12);
		$blogsTotal  = Blogs::all();
	    $blogsToShow = Blogs::showBlogs();
	    $today       =  Carbon::now();

	    if((Auth::user())) {
		    return view('blogs.index', compact('blogs', 'blogsTotal', 'today', 'blogsToShow'));
	    } else {
		    return view('blogs.index', compact('blogs', 'blogsTotal', 'today', 'blogsToShow'));
	    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
	    $today =  Carbon::now();

		return view('blogs.create', compact('today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    	$this->validate($request, [
		    'title'     => 'required|max:200',
		    'blog'      => 'required',
		    'link'      => 'nullable|max:1000',
		    'document'  => 'nullable|file',
		    'active'    => 'nullable',
		]);
	
		$blog = new Blogs();
	    $blog->title  = $request->title;
	    $blog->blog   = $request->blog;
	    $blog->link   = $request->link;
	    $blog->active = $request->active;

		if($request->hasFile('document')) {
			$document_file = $request->file('document');
			$blog->document = $path = $document_file->store('public/files');

			if($document_file->guessExtension() == 'png' || $document_file->guessExtension() == 'jpg' || $document_file->guessExtension() == 'jpeg' || $document_file->guessExtension() == 'gif' || $document_file->guessExtension() == 'bmp') {
				// Document is an image
				$image = Image::make($document_file->getRealPath())->orientate();
				$image->save(storage_path('app/'. $path));
			}
		}

		if($blog->save()) {
			return redirect()->action('BlogsController@edit', $blog)->with('status', 'Blog Added Successfully');
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
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blogs $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogs $blog) {
	    $this->validate($request, [
		    'title'     => 'required|max:200',
		    'blog'      => 'required',
		    'link'      => 'nullable|max:1000',
		    'document'  => 'nullable|file',
		    'active'    => 'nullable',
	    ]);

	    $blog->title    = $request->title;
	    $blog->link     = $request->link;
	    $blog->active   = $request->active;

	    // Check if file exist
	    $old_document = Storage::disk('public')->exists(str_ireplace('public', '', $blog->document));

	    if($old_document) {
		    $old_document = $blog->document;
	    }

	    if($request->hasFile('document')) {
		    $document_file = $request->file('document');
		    $blog->document = $path = $document_file->store('public/files');

		    if($document_file->guessExtension() == 'png' || $document_file->guessExtension() == 'jpg' || $document_file->guessExtension() == 'jpeg' || $document_file->guessExtension() == 'gif' || $document_file->guessExtension() == 'bmp') {
			    // Document is an image
			    $image = Image::make($document_file->getRealPath())->orientate();
			    $image->save(storage_path('app/'. $path));
		    }

		    if($old_document) {
			    Storage::delete($old_document);
		    }
	    }

	    if($blog->save()) {
		    return back()->with('status', 'Blog Updated Successfully');
	    }
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
