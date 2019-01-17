<?php

namespace App\Http\Controllers;
use App\Http\Controllers\front\ProductController;
use Illuminate\Http\Request;
use Config;
use DateTime;
use App\BiddingPackage;

class HomeController extends Controller
{
    
    protected $productlisting;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductController $Product)
    {
        $this->productlisting = $Product;
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        echo Config::get('app.timezone');
        $date = new DateTime();
        echo $date->format('Y-n-j G:i:s (e)'); 
        $current_time_stamp = new \DateTime();

        $current_time_stamp = $current_time_stamp->getTimestamp();
//        $date = $date->format('Y (e)');
        $products = $this->productlisting->listProducts(4);
        
         foreach($products as $s){ 
            
            $s->load([
                
                'category',
                'bidingHistories'=> function ($query) {
                    
                    $query->orderBy('id', 'DESC')->take(1);
                
                },
                
                'auctions' =>  function ($query)use ($current_time_stamp){
               
               $query->where(['is_delete'=>1, 'auction_status'=>1, ['start_time', '<', $current_time_stamp],['is_sold', '=', 0], ['is_expired', '=', 1]  ])->take(1);
//               $query->where(['is_delete'=>1, 'auction_status'=>1, ['start_time', '<', $current_time_stamp], ['is_sold', '=', 0]  ])->take(1);
           }
            
            ]);
        }
        
        
        
        
        $products_collection = $products->pluck('id')->all();
        
        $productId = $products_collection;
        
        $two_products = $this->productlisting->listProducts(2);
//        echo '<pre>';
//        print_r($products); exit;
//        return view('home');
         return view('welcome')->with(compact('products', 'two_products', 'productId'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('product.home');

    }
    
    
    public function aboutUs(){
        
        return view('front.about_us');
        
    }
    
    
    public function packages(){
        
        $BiddingPackages = BiddingPackage::where(['status'=>1, 'is_delete'=>1])->get();
//        dd($BiddingPackages);
        return view('front.packages', compact('BiddingPackages'));
        
    }
    
    
    public function payment(Request $request){
        if($request->isMethod('post')){
//        $BiddingPackages = BiddingPackage::where(['status'=>1, 'is_delete'=>1])->get();
//        dd($BiddingPackages);
        $packageDetails = $request->all();
//        dd($packageDetails);
        }
        return view('front.payment', compact('packageDetails'));
        
    }
    
    
}
