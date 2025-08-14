<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contents;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $content = Contents::all();
        return view('admin.pages.index',compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
              return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

         'title'    => 'required|string|max:255',
         'slug'     => 'required|string|max:255|unique:contents,slug',
         'subtitle' => 'nullable|string|max:255',
         'details'  => '|string',
         'img'      => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
         
                $content = new Contents;
                $content->title = $request->input('title');
                $content->slug = Str::slug($request->input('slug'));
                $content->subtitle = $request->input('subtitle');
                $content->details = $request->input('details');
                $content->extra = $request->input('extra');
                $content->meta = $request->input('meta'); 
           
         if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service/'), $filename);
            $content->img = 'uploads/service/' . $filename; // Store the relative file path
              }

   // Step 4: Handle meta, extra, faq, and howto arrays (convert to JSON)
   if ($request->has('meta')) {
       $content->meta = json_encode($request->input('meta'));
   }
   if ($request->has('extra')) {
       $content->extra = json_encode($request->input('extra'));
   }
 
   $content->save();
    return redirect('admin/pages')->with('message', 'Page created successfully');        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { 
        $pages = Contents::find($id);
        return view('admin.pages.edit',compact('pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


   $request->validate([
        'title'    => 'required|string|max:255',
        'slug'     => [
            'required',
            'string',
            'max:255',
            Rule::unique('contents', 'slug')->ignore($id),
        ],
        'subtitle' => 'nullable|string|max:255',
        'details'  => 'nullable|string',
        'img'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    
    $content = Contents::findOrFail($id);
    $content->title = $request->input('title');
    $content->slug = Str::slug($request->input('slug'));
    $content->subtitle = $request->input('subtitle');
    $content->details = $request->input('details');

    if ($request->has('meta')) {
        $content->meta = json_encode($request->input('meta'));
    }
    if ($request->has('extra')) {
        $content->extra = json_encode($request->input('extra'));
    }

    if ($request->hasFile('img')) {
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/service/'), $filename);
        $content->img = 'uploads/service/' . $filename;
    }

    $content->save();

    return redirect('admin/pages')->with('message', 'Page updated successfully');

                }

  
  
  
    public function destroy(string $id)
    {
                    $content = Contents::findOrFail($id);

                    $content->delete();
                     return redirect('admin/pages')->with('message', 'Page deleted successfully');
    }
}
