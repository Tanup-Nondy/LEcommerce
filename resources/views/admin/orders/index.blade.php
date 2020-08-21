@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
        <div class="card-header">
          Manage Divisions
        </div>
        <div class="card-body">
          @if(session('success'))
          <div class="alert alert-info">
            
              <p>{{session('success')}}</p>
            
          </div>
          @endif
          <table id="datatable" class="table table-hover table-striped ">
            <thead>
              <tr>
                <th>#</th>
                <th>Order Id</th>
                <th>Order's Name</th>
                <th>Order's Phone No</th>
                <th>Order's Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{$loop->index +1}}</td>
                <td>#LE{{$order->id}}</td> 
                <td>{{$order->name}}</td>
                <td>{{$order->phone}}</td>
                <td>
                  <p>
                    @if($order->is_seen_by_admin)
                      <button class="btn btn-success btn-sm">Seen</button>

                    @else
                      <button class="btn btn-danger btn-sm">Unseen</button>
                    @endif
                  </p>  
                  <p>
                    @if($order->is_completed)
                      <button class="btn btn-success btn-sm">Completed</button>

                    @else
                      <button class="btn btn-danger btn-sm">Incomplete</button>
                    @endif
                  </p>
                  <p>
                    @if($order->is_paid)
                      <button class="btn btn-success btn-sm">Paid</button>

                    @else
                      <button class="btn btn-danger btn-sm">Not Paid</button>
                    @endif
                  </p>
                </td>
                <td>
                  <a href="{{route('admin.orders.show',$order->id)}}" class="btn btn-success">View Order</a>
                  <a class="btn btn-danger" href="#deleteModal{{$order->id}}" data-toggle="modal">Delete</a>
                </td>
                <div class="modal fade" id="deleteModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Delete Order</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="regForm" action="{{route('admin.orders.delete',$order->id)}}" method="post">
                        {{csrf_field()}}
                    <button type="submit" class="btn btn-danger" >Delete Order</button>
                  </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button"class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
              </div>
              </tr>
              @endforeach
            </tbody>
            
          </table>
        </div>
      </div>
        </div>
  </div>


@endsection