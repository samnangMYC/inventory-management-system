<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); // Fetch all categories
        // dd(session()->all());
        return view("categories", compact('categories')); // Pass categories to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'nullable|string',
        ]);
           // Create a new category
        Category::create($request->all());
    

        // Redirect to the categories index with a success message
        return redirect()->route('categories')->with('success', 'Category created successfully.');
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
    public function edit($id)
    {   
        $category = Category::findOrFail($id);
        // $category = Category::where('id', $id)->first();
 
        // dd($category);
        return view('categories.edit',compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'required|string',
        ]);
         // Find the category by ID
         $category = Category::findOrFail($id);

        // Update the category
        $category->update($request->only('name', 'descriptions'));

        // Redirect back to the categories index with a success message
        return redirect()->route('categories')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect back to the categories index with a success message
        return redirect()->route('categories')->with('success', 'Category deleted successfully!');
    
    }
}
