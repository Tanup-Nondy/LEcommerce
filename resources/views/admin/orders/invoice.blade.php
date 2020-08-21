<!DOCTYPE html>
<html>
<head>
  <title>Invoice - {{$order->id}}</title>
  <link rel="stylesheet" href="{{asset('css/shared_admin_style.css')}}">
  <style>
    .content-wrapper{
      background: #FFF;
    }
    .invoice_header{
      background: #f7f7f7;
      padding: 10px 20px 10px 20px;
      border-bottom: 1px solid gray;
    }
    .invoice_right_top h3{
      padding-right: 20px;
      margin-top: 20px;
      color: #ec5d01;
      font-size: 55px!important;
      font-family: serif;
    }
    .invoice_left_top {
      border-left: 4px solid #ec5d00;
      padding-left: 20px;
      padding-top: 20px;
    }
    thead {
      background: #ec5d01;
      color: #FFF;
    }
    .authority h5{
      margin-top: -10px;
      color: #ec5d01;
    }
    .thanks h4{
      color: #ec5d01;
      font-size: 25px;
      font-weight: normal;
      font-family: serif;
      margin-top: 20px;
    }
    .site_address p{
      line-height: 6px;
      font-weight: 300;
    }
  </style>
</head>
<body>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="invoice_header">
            <div class="float-left site-logo">
            <img src="{{asset('images/favicon.png')}}" alt="">
          </div>
          <div class="float-right site_address">
            <h4>LEcommerce</h4>
            <p>Karnakathi, Barisal-8200</p>
            <p>Phone: <a href="#"> 01944821015</a></p>
            <p>Email: <a href="mailto:info@lecommerce.com">info@lecommerce.com</a></p>
          </div>
          <div class="clearfix"></div>
        </div>
          <div class="invoice_description">
           <div class="invoice_left_top float-left mt-2">
              <h1>Invoice To</h1>
              <h3>{{$order->name}}</h3>
              <div class="address">
                <p>
                  <strong>Address: </strong>
                  {{$order->shipping_address}}
                </p>
                <p>Phone: <a href="#"> 01944821015</a></p>
            <p>Email: <a href="mailto:{{$order->email}}">{{$order->email}}</a></p>
              </div>
            </div>
            <div class="invoice_right_top float-right">
              <h3>Invoice #{{$order->name}}</h3>
              <p>
                  {{$order->created_at}}
              </p>
            </div>
            <div class="clearfix"></div>
          </div> 
          
        <div class="mt-2">
          
          <h3>Products</h3>
          <?php
            $carts=App\CartModel::where('order_id',$order->id)->get();
          ?>
          @if($carts->count() >0)
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Product Title</th>
                  <th>Product Quantity</th>
                  <th>Unit Price</th>
                  <th>Sub Total</th>
                </tr>
              </thead>
              <tbody>
                <?php $total=0;?>
                @foreach($carts as $cart)
                <tr>
                  
                  <td>{{$loop->index + 1}}</td>
                  
                  <td>{{$cart->product->title}}
                  </td>
                  <td>
                    {{$cart->pro_qty}}
                  </td>
                  <td>{{$cart->product->price}}$</td>
                  <td>
                    <?php $total+=$cart->product->price*$cart->pro_qty;?>
                    {{$cart->product->price*$cart->pro_qty}}$</td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="3"></td>
                  <td>Discount</td>
                  <td colspan="2">
                    <strong>{{$order->custom_discount}}$</strong>
                  </td>
                </tr><tr>
                  <td colspan="3"></td>
                  <td>Shipping Charge</td>
                  <td colspan="2">
                    <strong>{{$order->shipping_charge}}$</strong>
                  </td>
                </tr><tr>
                  <td colspan="3"></td>
                  <td>Total Price</td>
                  <td colspan="2">
                    <strong>{{$total+$order->shipping_charge-$order->custom_discount}}$</strong>
                  </td>
                </tr>
              </tbody>
            </table>
          @endif
          <div class="thanks mt-3">
            <h4>Thank you for your business !!</h4>
          </div>
          <div class="authority float-right mt-5">
            <p>----------------------------------------</p>
            <h5>Authority Signature:</h5>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
</body>
</html>
