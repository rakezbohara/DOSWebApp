@extends('index')

@section('content')
<div class="container">         
  <table class="table table-striped">
    <thead>
      <tr>
        <th># SN</th>
        <th>item name</th>
        <th>quantity</th>
      </tr>
    </thead>
    <tbody>
@foreach ($itemdetails as $key => $itemdetail)
    @if($itemdetail->item_name=='Discount' || $itemdetail->item_name== 'Service Charge')
            
    @else
      <tr>
        <td> {{$key}}</td>
        <td>{{$itemdetail->item_name}}</td>
        <td>{{$itemdetail->quantity}}</td>
      </tr>
    @endif
@endforeach


    </tbody>
  </table>


	@foreach($transactions as $transaction)            
            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Table No. {{$transaction->table_id}} || {{$transaction->id}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped height-200px">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Menu Item Name</th>
                                <th>Quantity</th>
                                <th>unit price</th>
                                <th>Price</th>
                            </tr>
                            @foreach($transaction->trans_detail as $trans)
                                <tr>
                                    <td>{{ $trans->id }}</td>
                                    <td>{{ $trans->item_name }}</td>
                                    <td>{{ $trans->item_quantity }}</td>
                                    <td> {{ $trans->item_price }}</td>
                                    <td><span class="badge bg-red">{{ $trans->item_rate }}</span></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>Rs.{{$transaction->total}}/-</td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
    @endforeach
    </div>
@endsection