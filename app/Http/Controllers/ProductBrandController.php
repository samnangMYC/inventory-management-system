<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    //
    public function index(){
        $data['productBrands'] = ProductBrand::all();
        
        return view('product-brand',$data);
    }
    
    public function create()
    {
        $data['productBrands'] = ProductBrand::all();
        return view("product-brand.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string',
             'url' => 'required|string',
        ]);
        // dd($request->all());
           // Create a new category
        $productBrands = new ProductBrand();
        $productBrands->name = $request->name;
        $productBrands->contact = $request->contact;
        $productBrands->url = $request->url;
        $productBrands->save();

    
        // Redirect to the categories index with a success message
        return redirect()->route('product-brand.index')->with('success', 'Sub Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $data['productBrands'] = ProductBrand::findOrFail($id);
 
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
         $subCategories = ProductBrand::findOrFail($id);

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
        $subCategories = ProductBrand::findOrFail($id);

        // Delete the category
        $subCategories->delete();

        // Redirect back to the categories index with a success message
        return redirect()->route('sub-category')->with('success', 'SubCategory deleted successfully!');
    
    }
}
