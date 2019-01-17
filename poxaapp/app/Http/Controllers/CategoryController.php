<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//use Illuminate\Http\File;
//use Illuminate\Support\Facades\Storage;
use Auth;
use Session;
use Image;
use App\Category;
use Config;

class CategoryController extends Controller {
    
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    

    public function addCategory(Request $request) {


        if ($request->isMethod('post')) {
            //server side validation
            $validator = Validator::make($request->all(), [
                        'category_name' => 'required',
            ]);
            //server side errors
            if ($validator->fails()) {
                return redirect()->route('category.addcategory')
                                ->withErrors($validator)
                                ->withInput();
            }
            $data = $request->all();
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->featured = (isset($data['featured'])) ? $data['featured'] : 0;
            $category->status = 1;

            // Upload Image
            if ($request->hasFile('image')) {
                $filePath = public_path('media'); // exit;
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $large_image_path = $filePath . '/categories/large/' . $filename;
                    // Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    // Store image name in category table
                    $category->image = $filename;
                }
            } else {
                $category->image = '';
            }
            $category->save();
            return redirect()->route('category.viewcategory')->with('flash_message_success', 'Category added Successfully!');
        }
        $title = 'Add Category';
        $button_title = 'Add Category';
        $levels = Category::where(['parent_id' => 0])->get();
        $action = URL::route('category.addcategory');
        
        return view('admin.categories.add_category')->with(compact('button_title', 'title', 'levels', 'action'));
    }

    public function editCategory(Request $request, $id = null) {
        if ($request->isMethod('post')) {
            //server side validation
            $validator = Validator::make($request->all(), [
                        'category_name' => 'required',
            ]);
            //server side errors
            if ($validator->fails()) {
                return redirect()->route('category.addcategory')
                                ->withErrors($validator)
                                ->withInput();
            }
            $data = $request->all();
            if (!$request->has('featured')) {
                $data['featured'] = 0;
            }
            if ($request->hasFile('image')) {
                $filePath = public_path('media'); // exit;
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $large_image_path = $filePath . '/categories/large/' . $filename;
                    // Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    // Store image name in products table
                    $image = $filename;
                }
                $old_file_path = $filePath . '/categories/large/' . $request->old_image;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            } else {
                $image = $request->old_image;
            }

//            echo "<pre>"; print_r($data); die; 
            Category::where(['id' => $id])->update(['name' => $data['category_name'], 'parent_id' => $data['parent_id'], 'meta_description' => $data['meta_description'], 'meta_keywords' => $data['meta_keywords'], 'featured' => $data['featured'], 'image' => $image]);
            return redirect()->route('category.viewcategory')->with('flash_message_success', 'Category updated Successfully!');
        }
        $title = 'Edit Category';
        $button_title = 'Update Category';
        $categoryDetails = Category::where(['id' => $id])->first();
        $levels = Category::where(['parent_id' => 0])->get();
        $action = URL::route('category.editcategory', ['id' => $id]);
        return view('admin.categories.add_category')->with(compact('button_title', 'title', 'categoryDetails', 'levels', 'action'));
    }

    public function deleteCategory(Request $request, $id = null) {
        if (!empty($id)) {
            Category::where(['id' => $id])->update(['is_delete' => 0]);
            return redirect()->back()->with('flash_message_success', 'Category deleted Successfully!');
        }
    }

    public function updateStatusCategory(Request $request, $id = null, $status = null) {
        if (!empty($id)) {
            Category::where(['id' => $id])->update(['status' => $status]);
            return redirect()->back()->with('flash_message_success', 'Status updated Successfully!');
        }
    }

    public function viewCategories() {

        $categories = Category::get()->where('parent_id', 0)->where('is_delete', 1);
        $categories = json_decode(json_encode($categories));
        $parent_id = '';
//    	echo "<pre>"; print_r($categories); die;/**/
        return view('admin.categories.view_categories')->with(compact('categories', 'parent_id'))->with('no', 1);
        ;
    }

    public function viewChildCategories(Request $request, $id = null) {

        $categories = Category::get()->where('parent_id', $id)->where('is_delete', 1);
        $categories = json_decode(json_encode($categories));
        $parent_id = $id;
//    	echo "<pre>"; print_r($categories); die;/**/
        return view('admin.categories.view_categories')->with(compact('categories', 'parent_id'))->with('no', 1);
        ;
    }

    public static function getChiderenCount($id = null) {

        $categories_count = Category::get()->where('parent_id', $id)->where('is_delete', 1)->count();

//    	echo "<pre>"; print_r($categories); die;/**/
        return $categories_count;
    }

}
