<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Items;
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
        // dd('jdjdjd');
      
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
//backend order panel
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_list()
    {
        // dd(Auth::user()->id);
        return view('backend.order.order');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request, Order $order)
    {
        //
        $order=Order::find($request->id);
        $user=User::find($order->user_id);
        return view('backend.order.order_detail',compact('order','user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, Order $order)
    {
        //
        // dd($request->status);
        $order=Order::find($request->id);
        $order->status=$request->status;
        $order->save();
        return redirect()->route('order_list');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function nav(Request $request, Order $order)
    {
        //
        session_start();
        $key = $request->key;
        $value = $request->value;

        $_SESSION[$key]=$value;
        echo 'done';
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, Order $order)
    {
        //
        session_start();
        $start = $request->start;
        $end = $request->end;
        if ($start==''&&$end=='') {
            unset($_SESSION['startDate']);
            unset($_SESSION['endDate']);
            unset($_SESSION['all']);
            echo 'today';
        }elseif ($start=='all'&&$end=='all') {
            $_SESSION['all']='all';
            unset($_SESSION['startDate']);
            unset($_SESSION['endDate']);
            echo 'all';
        }else{
            $_SESSION['startDate']=$start;
            $_SESSION['endDate']=$end;       
            echo 'search';
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function earning(Request $request, Order $order)
    {
        //
    // 1 jan
    $janStart = date('Y-m-d', strtotime('first day of january'));
    $janEnd = date('Y-m-d',strtotime('last day of january'));
    $janResult=Order::whereBetween('orderdate', [$janStart, $janEnd])->sum('total');
    // 2 february
    $febStart = date('Y-m-d', strtotime('first day of february'));
    $febEnd = date('Y-m-d',strtotime('last day of february'));
    $febResult=Order::whereBetween('orderdate', [$febStart, $febEnd])->sum('total');
    // 3 march
    $marchStart = date('Y-m-d', strtotime('first day of march'));
    $marchEnd = date('Y-m-d',strtotime('last day of march'));
    $marchResult=Order::whereBetween('orderdate', [$marchStart, $marchEnd])->sum('total');
    // 4 april
    $aprilStart = date('Y-m-d', strtotime('first day of april'));
    $aprilEnd = date('Y-m-d',strtotime('last day of april'));
    $aprilResult=Order::whereBetween('orderdate', [$aprilStart, $aprilEnd])->sum('total');
    // 5 may
    $mayStart = date('Y-m-d', strtotime('first day of may'));
    $mayEnd = date('Y-m-d',strtotime('last day of may'));
    $mayResult=Order::whereBetween('orderdate', [$mayStart, $mayEnd])->sum('total');
    // 6 june
    $junStart = date('Y-m-d', strtotime('first day of june'));
    $junEnd = date('Y-m-d',strtotime('last day of june'));
    $junResult=Order::whereBetween('orderdate', [$junStart, $junEnd])->sum('total');
    // 7 july
    $julStart = date('Y-m-d', strtotime('first day of july'));
    $julEnd = date('Y-m-d',strtotime('last day of july'));
    $julResult=Order::whereBetween('orderdate', [$julStart, $julEnd])->sum('total');
    // 8 august
    $augStart = date('Y-m-d', strtotime('first day of august'));
    $augEnd = date('Y-m-d',strtotime('last day of august'));
    $augResult=Order::whereBetween('orderdate', [$augStart, $augEnd])->sum('total');
    // 9 september
    $sepStart = date('Y-m-d', strtotime('first day of september'));
    $sepEnd = date('Y-m-d',strtotime('last day of september'));
    $sepResult=Order::whereBetween('orderdate', [$sepStart, $sepEnd])->sum('total');
    // 10 october
    $octStart = date('Y-m-d', strtotime('first day of october'));
    $octEnd = date('Y-m-d',strtotime('last day of october'));
    $octResult=Order::whereBetween('orderdate', [$octStart, $octEnd])->sum('total');
    // 11 november
    $novStart = date('Y-m-d', strtotime('first day of november'));
    $novEnd = date('Y-m-d',strtotime('last day of november'));
    $novResult=Order::whereBetween('orderdate', [$octStart, $octEnd])->sum('total');

    // 12 december
    $decStart = date('Y-m-d', strtotime('first day of december'));
    $decEnd = date('Y-m-d',strtotime('last day of december'));
    $decResult=Order::whereBetween('orderdate', [$decStart, $decEnd])->sum('total');

    $total = array(
        $janResult,$febResult,$marchResult,$aprilResult,
        $mayResult,$junResult,$julResult,$augResult,
        $sepResult,$octResult,$novResult,$decResult,
    );

    echo json_encode($total);
    }
//backend order panel

}
