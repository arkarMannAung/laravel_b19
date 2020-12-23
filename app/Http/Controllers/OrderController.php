<?php

namespace App\Http\Controllers;

use App\Order;
use App\Item_order;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->id);
        $orders=Order::where('user_id','=',Auth::user()->id)->get();
        return view('frontend.order.order_history',compact('orders'));
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
    public function store(Request $request)
    {
        //  
    DB::transaction(function() use ($request){
        $carts=$request->carts;
        $total=$request->total;
        if ($request->note) {
            $note=$request->note;
        }else{
            $note='none note';
        }
        
        $status='Order';
        $user_id=Auth()->user()->id;
        date_default_timezone_set("Asia/Rangoon");
        $orderdate = date('Y-m-d');
        $voucherno = 'AA'.time();//strtotime(date('h:i:s'));   
        // put database to order table
        $order = new Order;
        $order->total=$total;
        $order->orderdate=$orderdate;
        $order->voucherno=$voucherno;
        $order->note=$note;
        $order->status=$status;
        $order->user_id=$user_id;
        $order->save();

        // put database to item_order
        foreach ($carts as $cart) {
            $item_orders= new Item_order;
            $item_orders->qty= $cart["qty"];
            $item_orders->item_id= $cart["id"];
            $item_orders->order_id=$order->id;
            $item_orders->save();
        }
    });
    echo 'done';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        //
        $item_orders=Item_order::where('order_id','=',$request->id)->get();
        return view('frontend.order.order_detail',compact('item_orders'));
    }
}
