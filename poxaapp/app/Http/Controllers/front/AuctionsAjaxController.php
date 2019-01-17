<?php
/*Add namespace in your controller*/
namespace App\Http\Controllers\front;

use App\auctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use App\bidingHistories;
use App\User;
use App\Auction;
use Config;
use DB;
use Log;
use DateTime;

class AuctionsAjaxController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\auctions  $auctions
     * @return \Illuminate\Http\Response
     */
    public function show(auctions $auctions) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\auctions  $auctions
     * @return \Illuminate\Http\Response
     */
    public function edit(auctions $auctions) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\auctions  $auctions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, auctions $auctions) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\auctions  $auctions
     * @return \Illuminate\Http\Response
     */
    public function destroy(auctions $auctions) {
        //
    }

    /**
     * Add the specified resource to storage.
     *
     * @param  \App\auctions  $auctions
     * @return \Illuminate\Http\Response
     */
    public function addBidd(Request $request) {

        if ($request->ajax()) {

//             $bidingHistories = bidingHistories::where(['is_delete'=>1, 'product_id'=>$product_id, 'auction_id'=>$auction_id])->with([
//            
//                    'user'=> function($q){
//                     $q->select('id','name');
//                    },
//
//                ])->get();

            $bidingHistories = new bidingHistories;
            $bidingHistories->product_id = $request->product_id;
            $bidingHistories->user_id = $request->user_id;
            $bidingHistories->auction_id = $request->auction_id;
//            $bidingHistories->product_price = $request->product_price;
            $bidingHistories->username = $request->user_name;
            $bidingHistories->price = ($request->price + $request->product_price);
            $bidingHistories->bid_type = 1; //0:Auto Bid; 1:Bid
//            $id = DB::table('users')->insertGetId(
//    ['email' => 'john@example.com', 'votes' => 0]
//);

            /*
             * Implemented logic in Auction
                max auction time 120 secounds
                120-25 secounds_diff time increase by 10 secounds maximum 120 secounds;
                25-0 seocunds diff  time increase by 5 secounds maximum 25 secounds
            */


            $end_time = $request->auction_end_time;
            $now = time();
            $secounds_diff = $end_time - $now;
            $time = 0;
            if ($secounds_diff < 120 && $secounds_diff > 25) {

                $diff_120 = 120 - $secounds_diff;

                if ($diff_120 <= 10) {

                    $time =  $diff_120;
                    
                } else {

                    $time =  10;
                }
            }else if ($secounds_diff < 25) {


                $diff_25 = 25 - $secounds_diff;



                if ($diff_25 <= 5) {

                        $time =  $diff_25;
                } else {

                    $time =  5;
                }
            }



            if ($bidingHistories->save()) {
                User::where('id', $request->user_id)->decrement('bids', 1);
                Product::where('id', $request->product_id)->increment('price', $request->price);
                Auction::where('id', $request->auction_id)->increment('end_time', $time);
//                Auction::where('id', $request->auction_id)->increment('end_time', $request->time);

                return response()->json([
                            'success' => true,
                            'state' => 'CA',
                            'bidingHistories' => $bidingHistories,
                            'status' => 200
                ]);
//                return response()->json(array('success' => true, 'last_insert_id' => $data->id ), 200);
            }
        }
    }

    /**
     * List all the products
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return Collection
     */
    public function listProducts(int $limit = null) {


        $products = Product::all()->take($limit);




        foreach ($products as $s) {

            $s->load(['productImages' => function($q) {
                    return $q->where(['is_delete' => 1])->orderBy('id', 'desc')->take(1);
                }
            ]);
        }

        return $products;
    }

    /**
     * Get the product
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSingleProduct(Request $request) {
        $slug = $request->slug;
        $current_time_stamp = new DateTime();

        $current_time_stamp = $current_time_stamp->getTimestamp();
//        $product = Product::where(['slug' => $slug])->get();
        $listproducts = $this->listProducts(3);
        $products = Product::with([
                    'productImages' => function($query) {

                        $query->where(['is_delete' => 1]);
//            $query->where( 'is_delete', '=', 1 );
                    },
                    'category',
                    'bidingHistories' => function ($query)use ($current_time_stamp) {

                        $query->where(['is_delete' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(10);
                    },
                    'auctions' => function ($query)use ($current_time_stamp) {

                        $query->where(['is_delete' => 1, 'auction_status' => 1, ['start_time', '<', $current_time_stamp],['is_sold', '=', 0], ['is_expired', '=', 1]])->take(1);
//               $query->where(['is_delete'=>1, 'auction_status'=>1, ['start_time', '<', $current_time_stamp], ['is_sold', '=', 0]  ])->take(1);
                    }
                ])->where(['slug' => $slug])->first();
//        dd($products);

        return response()->json([
                    'success' => true,
                    'products' => $products,
                    'listproducts' => $listproducts,
                    'time' => $current_time_stamp,
                    'status' => 200
        ]);
//        return view('front.products.product', compact('products','listproducts'));
    }

    public function showMultipleProduct(Request $request) {
        $ids = unserialize($request->productId);
//        dd($ids);
        $current_time_stamp = new DateTime();

        $current_time_stamp = $current_time_stamp->getTimestamp();
//        $product = Product::where(['slug' => $slug])->get();

        $products = Product::with([
                    'productImages' => function($query) {

                        $query->where(['is_delete' => 1]);
//            $query->where( 'is_delete', '=', 1 );
                    },
                    'category',
                    'bidingHistories' => function ($query)use ($current_time_stamp) {

                        $query->where(['is_delete' => 1, 'status' => 1])->orderBy('id', 'DESC');
                    },
                    'auctions' => function ($query)use ($current_time_stamp) {

                        $query->where(['is_delete' => 1, 'auction_status' => 1, ['start_time', '<', $current_time_stamp],['is_sold', '=', 0], ['is_expired', '=', 1]]);
//               $query->where(['is_delete'=>1, 'auction_status'=>1, ['start_time', '<', $current_time_stamp], ['is_sold', '=', 0]  ])->take(1);
                    }
                ])->whereIn('id', $ids)->get();
//        dd($products);

        return response()->json([
                    'success' => true,
                    'products' => $products,
                    'time' => $current_time_stamp,
                    'status' => 200
        ]);
//        return view('front.products.product', compact('products','listproducts'));
    }

    public function updatewinner(Request $request) {

        if ($request->ajax()) {
            $current_time_stamp = new DateTime();

            $current_time_stamp = $current_time_stamp->getTimestamp();
//            dd($request); exit;
            if ($request->filled('bidding_history_id')) {
                //

                if ($request->bidding_history_id == 0 && $request->last_bidding_user_id == 0) {

                    Auction::where('id', $request->auction_id)->update(['is_expired' => 0]);
                    $msg = 'expired';
                    $winer_user_id = 0;
                } else {

                    User::where('id', $request->user_id)->decrement('bids', 1);
                    Product::where('id', $request->product_id)->update(['winer_user_id' => $request->user_id]);
                    Auction::where('id', $request->auction_id)->update(['is_sold' => 1]);
                    bidingHistories::where('id', $request->bidding_history_id)->update(['is_winner' => 1]);
                    $msg = 'winner';
                    $winer_user_id = 1;
                }
            } else {

                $winer_user_id = 2;
                $msg = 'Nothing updated';
            }
            return response()->json([
                        'success' => true,
                        'msg' => $msg,
                        'time' => $current_time_stamp,
                        'winer_user_id' => $winer_user_id,
                        'status' => 200
            ]);
        }
    }

}
