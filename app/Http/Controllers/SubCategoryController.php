<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRole;
use App\Models\Role;

class SubCategoryController extends Controller
{
    public function index()
    {
        $PermissionRole = PermissionRole::getPermission('Sub Category', Auth::user()->role_id);
        $data['PermissionAdd'] = PermissionRole::getPermission('Add Sub Category', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Sub Category', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRole::getPermission('Delete Sub Category', Auth::user()->role_id);
        $data['PermissionRoles'] = PermissionRole::all();
        if(!$PermissionRole){
            abort(404);
        }
        $data["subCategories"] = SubCategory::all(); // Fetch all subcategories

        return view('sub-category', $data); // Return a view
    }

    public function create()
    {
        $data['categories'] = Category::all();
        return view("subCategory.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'nullable|string',
            'cat_id' => 'required|integer',
        ]);
        // dd($request->all());
           // Create a new category
        $subCategories = new SubCategory();
        $subCategories->name = $request->name;
        $subCategories->descriptions = $request->descriptions;
        $subCategories->cat_id = $request->cat_id;
        $subCategories->save();
    
        // Redirect to the categories index with a success message
        return redirect()->route('sub-category.index')->with('success', 'Sub Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $data["subCategories"] = SubCategory::findOrFail($id);
        $catId = $data["subCategories"]->cat_id;
        $data['categories'] = Category::all();
        $data['selectedCategory'] = Category::getCategory($catId);
        // $category = Category::where('id', $id)->first();
 
        // dd($category);
        return view('subCategory.edit',$data);
        
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
         $subCategories = SubCategory::findOrFail($id);

        // Update the category
        $subCategories->update($request->only('name', 'descriptions'));

        // Redirect back to the categories index with a success message
        return redirect()->route(route: 'sub-category.index')->with('success', 'SubCategory updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the category by ID
        $subCategories = SubCategory::findOrFail($id);

        // Delete the category
        $subCategories->delete();

        // Redirect back to the categories index with a success message
        return redirect()->route('sub-category')->with('success', 'SubCategory deleted successfully!');
    
    }
}
