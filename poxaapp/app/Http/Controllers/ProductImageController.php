<?php

namespace App\Http\Controllers;

use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Config;
use Auth;
use Session;
use Image;

class ProductImageController extends Controller
{
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
//    public function index()
    {
  
//        dd(Auth::user()->name);
        $productImages = ProductImage::where(['product_id'=>$id, 'is_delete'=>1])->get();
        $productImages = json_decode(json_encode($productImages));
        
//        echo "<pre>"; print_r($productImages); die;
        return view('admin.products.view_product_images')->with(compact('productImages'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
       
       if($request->isMethod('post')){
           
            //server side validation
            $validator = Validator::make($request->all(), [
                                'product_id' => 'required',
                                'image_name' => 'required',
                                
                    ]);
            //server side errors
            if ($validator->fails()) {
                return redirect()->route('product.addproductimage',['id'=>$id])
                                ->withErrors($validator)
                                ->withInput();
            }
            
                $data = $request->all();
//    		echo "<pre>"; print_r($data); die;
    		
    		$ProductImage = new ProductImage;
    		$ProductImage->product_id = $data['product_id'];
    		
                // Upload Image
                if ($request->hasFile('image_name')) {
                    $filePath = Config::get('constants.image_base_path'); // exit;
                    $image_tmp = Input::file('image_name');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $large_image_path = $filePath . '/products/large/' . $filename;
                        $medium_image_path = $filePath . '/products/medium/' . $filename;
                        $small_image_path = $filePath . '/products/small/' . $filename;
                        // Resize Images
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                        // Store image name in category table
                        $ProductImage->image_name = $filename;
                    }
                } else {
                    $ProductImage->image_name = '';
                }

    		//echo "<pre>"; print_r($ProductImage); die;
    		$ProductImage->save();

            
           return redirect()->route('product.viewproductimage',['id'=>$id])->with('flash_message_success','Product Image has been added successfully!');
            
            
        }
        
        $title = 'Add Product Image';
        $button_title = 'Add Product Image';
        $action = URL::route('product.addproductimage', ['id' => $id]);
        $productId=$id;
        return view('admin.products.add_product_image')->with(compact('button_title', 'title', 'productId', 'action'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        
        if (!empty($id)) {
            ProductImage::where(['id' => $id])->update(['is_delete' => 0]);
            return redirect()->back()->with('flash_message_success', 'Product Image deleted Successfully!');
        }
    }
}
