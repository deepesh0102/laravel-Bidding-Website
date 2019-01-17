<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use Config;
use DB;
use Log;
use App\ProductImage;

class ProductsController extends Controller
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
    
    
    
    
    public function addProduct(Request $request){

//        echo Config::get('constants.base_path'); exit();
    	if($request->isMethod('post')){
            
                
                $validator = Validator::make($request->all(), [
                            'category_id' => 'required',
                            'product_name' => 'required|unique:products',
                            'price' => 'required',
//                            'meta_description' => 'required',
                ]);
                //server side errors
                if ($validator->fails()) {
                    return redirect()->route('product.addproduct')
                                    ->withErrors($validator)
                                    ->withInput();
                }
                
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		if(empty($data['category_id'])){
    			return redirect()->back()->with('flash_message_error','Under Category is missing!');	
    		}
    		$product = new Product;
    		$product->category_id = $data['category_id'];
    		$product->product_name = $data['product_name'];
    		$product->slug = str_slug($data['product_name']);
    		$product->product_code = $data['product_code'];
    		$product->buy_now_price = $data['buy_now_price'];
    		$product->meta_description = $data['meta_description'];
    		$product->meta_keywords = $data['meta_keywords'];
    		if(!empty($data['description'])){
    			$product->description = $data['description'];
    		}else{
				$product->description = '';    			
    		}
    		$product->price = $data['price'];

    		$product->save();
    		/*return redirect()->back()->with('flash_message_success','Product has been added successfully!');->where(['is_delete' => 0]);*/
            return redirect()->route('product.viewproduct')->with('flash_message_success','Product has been added successfully!');
    	}
        $title = 'Add Product';
        $button_title = 'Add Product';
        $action = URL::route('product.addproduct');
    	$categories = Category::where(['parent_id'=>0,'is_delete'=>1])->get();
    	$categories_dropdown = "<option value='' selected disabled>Select</option>";
    	foreach($categories as $cat){
    		$categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id,'is_delete'=>1])->get();
    		foreach ($sub_categories as $sub_cat) {
    			$categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}
    	return view('admin.products.add_product')->with(compact('button_title', 'title', 'categories_dropdown', 'action'));
    }
    
    public function editProduct(Request $request, $id = null){
//        echo 'jdfklvlakdfv'; exit;
        if ($request->isMethod('post')) {
            //server side validation
            $validator = Validator::make($request->all(), [
                            'category_id' => 'required',
                            'product_name' => 'required',
//                            'product_name' => 'required|unique:products,product_name,'.$id,
                            'price' => 'required',
//                            'meta_description' => 'required',
            ]);
            //server side errors
            if ($validator->fails()) {
                return redirect()->route('product.editproduct',['id'=>$id])
                                ->withErrors($validator)
                                ->withInput();
            }
            $data = $request->all();
            


//            echo "<pre>"; print_r($data); die; 
            Product::where(['id' => $id])->update(['product_name' => $data['product_name'],'slug'=>str_slug($data['product_name']), 'category_id' => $data['category_id'], 'meta_description' => $data['meta_description'], 'meta_keywords' => $data['meta_keywords'], 'product_code' => $data['product_code'], 'buy_now_price' => $data['buy_now_price'], 'description'=>$data['description'], 'price'=>$data['price']]);
            return redirect()->route('product.viewproduct')->with('flash_message_success', 'Product updated Successfully!');
        }
        $title = 'Edit Product';
        $button_title = 'Update Product';
        $action = URL::route('product.editproduct', ['id' => $id]);
        $productDetails = Product::where(['id' => $id])->first();
        $categories = Category::where(['parent_id'=>0,'is_delete'=>1])->get();
    	$categories_dropdown = "<option value='' selected disabled>Select</option>";
    	foreach($categories as $cat){
                $categories_dropdown .= "<option value='".$cat->id."'";
                if($cat->id == $productDetails->category_id){
                     
                    $categories_dropdown .= "selected";
                }
                $categories_dropdown .=">".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id,'is_delete'=>1])->get();
    		foreach ($sub_categories as $sub_cat) {
    			$categories_dropdown .= "<option value = '".$sub_cat->id."'";
                        
                        if($sub_cat->id == $productDetails->category_id){
                     
                            $categories_dropdown .= "selected";
                        }
                        
                        $categories_dropdown .= ">&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}
 
        return view('admin.products.add_product')->with(compact('button_title', 'title', 'productDetails', 'categories_dropdown', 'action'));
        
        
        
    }
    
    
    public function viewProducts(){
        $products = Product::where(['is_delete'=>1])->get();
        /*$products = Product::with(['productImages' => function($query){
            
//            $query->where([ 'is_delete' => 1 ])->take(1);
            $query->where( 'is_delete', '=', 1 );
            
        }])->where(['is_delete'=>1])->get();*/
        
        foreach($products as $s){ 
            
            $s->load(['productImages' => function($q){ return $q->where([ 'is_delete' => 1 ])->orderBy('id', 'desc')->take(1);}
            
            ]);
            
            
        }
        
//        echo '<pre>';
//        print_r($products); 
        
//        $query = DB::getQueryLog();
//        print_r($query);
//        
//        exit();  
        $products = json_decode(json_encode($products));
        foreach($products as $key => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        //echo "<pre>"; print_r($products); die;
        return view('admin.products.view_products')->with(compact('products'));
    }
      
    public function updateStatusProduct(Request $request, $id = null, $status = null) {
        if (!empty($id)) {
            Product::where(['id' => $id])->update(['status' => $status]);
            return redirect()->back()->with('flash_message_success', 'Status updated Successfully!');
        }
    }
    
    public function deleteProduct(Request $request, $id = null){
        
        if (!empty($id)) {
            Product::where(['id' => $id])->update(['is_delete' => 0]);
            return redirect()->back()->with('flash_message_success', 'Product deleted Successfully!');
        }
        
    }
    
    
    
    public function copyProduct(Request $request){

//        dd($request);
//        echo Config::get('constants.base_path'); exit();
    	if($request->isMethod('post')){
            

                
    		$data = $request->all();
    		
    		$product = new Product;
    		$product->category_id = $data['category_id'];
    		$product->product_name = $data['product_name'];
    		$product->slug = str_slug($data['product_name']);
    		$product->product_code = $data['product_code'];
    		$product->buy_now_price = $data['buy_now_price'];
    		$product->meta_description = $data['meta_description'];
    		$product->meta_keywords = $data['meta_keywords'];
    		if(!empty($data['description'])){
    			$product->description = $data['description'];
    		}else{
				$product->description = '';    			
    		}
    		$product->price = $data['price'];
                
                $ProductImage = new ProductImage;
    		$ProductImage->image_name = $data['image_name'];

    		$product->save();
                
                $product->productImages()->save($ProductImage);
    		/*return redirect()->back()->with('flash_message_success','Product has been added successfully!');->where(['is_delete' => 0]);*/
            return redirect()->route('product.viewproduct')->with('flash_message_success','Product has been added successfully!');
    	}
        
    }
    
    
    
    
}
