@extends('backend.master.master')
@php
use App\Order;
use App\User;
use App\Items;
use App\Brands;
use App\Item_order;
date_default_timezone_set("Asia/Rangoon");
$todayDate = date('Y-m-d',strtotime('today'));
$todayOrder=Order::where('orderdate','=',$todayDate)->count();
$customer=DB::table('model_has_roles')->where('role_id','=',1)->count();
$Brand=Brands::count();
$item=Items::count();
@endphp
@section('body')

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="icofont-dashboard"></i> Dashboard</h1>
            <p>Laravel Project By Arkar Mann Aung</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon icofont-prestashop"></i>
                <div class="info">
                    <h4>Today Order</h4>
                    <p><b> {{$todayOrder}} </b></p> 
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon icofont-ui-user-group"></i>
                <div class="info">
                    <h4>Customers</h4>
                    <p><b> {{$customer}} </b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon icofont-badge"></i>
                <div class="info">
                    <h4>Brands</h4>
                    <p><b> {{$Brand}} </b></p> 
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon icofont-box"></i>
                <div class="info">
                    <h4>Items</h4>
                    <p><b> {{$item}} </b></p> 
                    </div>
                </div>
            </div>  
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Monthly Sales</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                    </div>
                </div>
            </div>
    </div>
</main>

@endsection

@section('script')

<script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:"GET",
            url: '{{route('earning')}}',
            success:function(x){
                var send = JSON.parse(x);
                // console.log(send[11]);
                 var data = {
                labels: [   "January", "February", "March", "April",
                            "May","Jun","July","August","September",
                            "October","November","December"],
                datasets: [
                  {
                    label: "",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(253,0,0,1)",
                    data: [ send[0],send[1],send[2],send[3],
                            send[4],send[5],send[6],send[7],
                            send[8],send[9],send[10],send[11],]
                  }
                ]
              };
              
              var ctxl = $("#lineChartDemo").get(0).getContext("2d");
              var lineChart = new Chart(ctxl).Line(data);
            }
        })
    </script>

@endsection