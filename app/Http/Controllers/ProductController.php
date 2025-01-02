<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Models\ProductPrice;
use App\Models\ProductInfo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $PermissionRole = PermissionRole::getPermission('Product', Auth::user()->role_id);
        $permissionAdd = PermissionRole::getPermission('Add Product', Auth::user()->role_id);
        $permissionEdit = PermissionRole::getPermission('Edit Product', Auth::user()->role_id);
        $permissionDelete = PermissionRole::getPermission('Delete Product', Auth::user()->role_id);
        $permissionRoles = PermissionRole::all();
      // Dump the permissions and stop execution
        // dd([
        //     'PermissionAdd' => $data['PermissionAdd'],
        //     'PermissionEdit' => $data['PermissionEdit'],
        //     'PermissionDelete' => $data['PermissionDelete'],
        //     'PermissionRoles' => $data['PermissionRoles'],
        // ]);
        if(!$PermissionRole){
            abort(404);
        }

        // Fetch all products
        $products = Product::all();
        // Fetch all product categories
        $productCategories = Product::with('subCategory')->get();
        // Fetch all product specification
        $productSpecification = Product::with('productInfo')->get();

    
        // Initialize an array to hold product prices
        $productPrices = [];
    
        // Loop through each product to get the latest price
        foreach ($products as $product) {
            $latestPrice = ProductPrice::where('pro_id', $product->id)
                ->orderBy('created_at', 'desc') // Order by created_at in descending order
                ->first(); // Get the first result
    
            // Store the latest price in the array with the product ID as the key
            $productPrices[$product->id] = $latestPrice;
        }
        // dd($productPrices);
    
        // Fetch all product info and brands
        $productsInfo = ProductInfo::all();
   

        // Fetch the brand using the getProductBrand method
        $brandName = ProductBrand::all(); 
    
        // Prepare data for the view
        $data = [
            'products' => $products,
            'product_prices' => $productPrices,
            'products_info' => $productsInfo,
            'brandName' => $brandName,
            'productCategories'=> $productCategories,
            'productInfo' => $productSpecification,
            'PermissionAdd' => $permissionAdd,
            'PermissionEdit' => $permissionEdit,
            'PermissionDelete' => $permissionDelete,
            'PermissionRoles' => $permissionRoles,
        ];
    
        // Return the view with the data
        return view('product', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['subCategories'] = SubCategory::all();
        $data['brands'] = ProductBrand::all();
        return view('products.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0', // Stock must be a non-negative integer
            'price' => 'required|numeric|min:0', // Price must be a non-negative number
            'weight' => 'nullable|numeric|min:0', // Weight can be null or a non-negative number
            'specification' => 'nullable|string', // Specification can be null or a string
            'size' => 'nullable|string', // Size can be null or a string
            'descriptions' => 'nullable|string', // Description can be null or a string
        ]);

        
        // Fetch the subcategory to get its name
        $subCategory = SubCategory::findOrFail($request->sub_cat_id);
        $prefix = strtoupper(substr($subCategory->name, 0, 3)); // Get the first 3 letters of the subcategory name
           // Fetch the last product code with the same prefix
        $lastProduct = Product::where('code', 'LIKE', "{$prefix}-%")->orderBy('code', 'desc')->first();
        
        // Generate the new product code
        if ($lastProduct) {
            // Extract the numeric part and increment it
            $lastCodeNumber = (int) substr($lastProduct->code, strlen($prefix) + 1); // Get the number after the prefix
            $newCodeNumber = $lastCodeNumber + 1; // Increment the number
        } else {
            $newCodeNumber = 1; // Start from 1 if no products exist with this prefix
        }

        // Create the new product code
        $newCode = "{$prefix}-{$newCodeNumber}"; // Example: "PHO-1"
        // dd($request->all());
        $product = new Product();
        $product->name = $request->name;
        $product->code = $newCode;
        $product->stock = $request->stock;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->brand_id = $request->brand;
        
         // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file(key: 'image')->store('products', 'public'); // Store in 'public/products'
            $product->image = $imagePath; // Save the path to the database
        }

        // Save the product
        $product->save();


            $productPrice = new ProductPrice();
            $productPrice->pro_id = $product->id; // Link to the product
            $productPrice->price = $request->price; // Price value
            $productPrice->save();

            $productInfo = new ProductInfo();
            $productInfo->pro_id = $product->id; // Link to the product
            $productInfo->weight = $request->weight; // Weight
            $productInfo->discount = $request->discount;
            $productInfo->tax = $request->tax;
            $productInfo->specification = $request->specification; // Specification	
            $productInfo->size = $request->size; // Size
            $productInfo->descriptions = $request->descriptions; // Description
            $productInfo->save();

     

        // Redirect or return response
        return redirect()->route('product')->with('success', 'Product created successfully!');
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
        //
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::all();
        $brands = ProductBrand::all();
        $productPrice = Product::getProductPrice($id);
        $productInfo = Product::getProductInfo($id);
      
        $data = [
            'product' => $product,
             'subCategories'=> $subCategories,
            'brands' => $brands,
            'productPrice' => $productPrice,
            'productInfo' => $productInfo	
        ];

        return view('products.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // Find the product by ID
        $product = Product::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0', // Stock must be a non-negative integer
            'price' => 'required|numeric|min:0', // Price must be a non-negative number
            'weight' => 'nullable|numeric|min:0', // Weight can be null or a non-negative number
            'specification' => 'nullable|string', // Specification can be null or a string
            'size' => 'nullable|string', // Size can be null or a string
            'descriptions' => 'nullable|string', // Description can be null or a string
            'image' => 'nullable|image|max:2048', // Optional image validation
        ]);
     
        
        // Update product attributes
        $product->name = $request->name;
        $product->stock = $request->stock;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if necessary (optional)
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public'); // Store in 'public/products'
            $product->image = $imagePath; // Save the path to the database
        }

        // Save the product
        $product->save();

         // Update the product price
    $productPrice = ProductPrice::where('pro_id', $product->id)->first();
    if ($productPrice) {
        $productPrice->price = $request->price; // Update price value
        $productPrice->save();
    } else {
        // If no price record exists, create a new one
        $productPrice = new ProductPrice();
        $productPrice->pro_id = $product->id; // Link to the product
        $productPrice->price = $request->price; // Price value
        $productPrice->save();
    }

        // Update the product info
        $productInfo = ProductInfo::where('pro_id', $product->id)->first();
        if ($productInfo) {
            $productInfo->weight = $request->weight; // Update weight
            $productInfo->discount = $request->discount;
            $productInfo->tax = $request->tax;
            $productInfo->specification = $request->specification; // Update specification	
            $productInfo->size = $request->size; // Update size
            $productInfo->descriptions = $request->descriptions; // Update description
            $productInfo->save();
        } else {
            // If no info record exists, create a new one
            $productInfo = new ProductInfo();
            $productInfo->pro_id = $product->id; // Link to the product
            $productInfo->weight = $request->weight; // Weight
            $productInfo->discount = $request->discount;
            $productInfo->tax = $request->tax;
            $productInfo->specification = $request->specification; // Specification	
            $productInfo->size = $request->size; // Size
            $productInfo->descriptions = $request->descriptions; // Description
            $productInfo->save();
        }

        // Optionally, you can return a response or redirect
        return redirect()->route('product')->with('success', 'Product updated successfully.');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
            
            // Delete related ProductInfo if it exists
        $productInfo = $product->info; // Assuming you have a relationship defined
        if ($productInfo) {
            $productInfo->delete();
        }

            // Check if the product has an associated image
        if ($product->image) {
            // Delete the old image from storage
            Storage::disk('public')->delete($product->image);
        }

        // Delete all related ProductPrice records
        $product->prices()->delete(); // This will delete all related prices

        // Finally, delete the product
        $product->delete();

  
        return redirect()->route('product')->with('success', 'Product deleted successfully!');
    }
}
