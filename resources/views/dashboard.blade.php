@extends('index')

@section('content')
    <div class="row margin-left-40px">
        {{--Table for checkout--}}
        <h2 class="page-header">Checkout Requests</h2>
        @foreach($tableWaiting as $table)
            <div class="col-md-3">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Table No. {{$table->table_no}} | {{$table->table_name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped height-200px">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Menu Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                            @foreach($table->orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->menu->name }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td><span class="badge bg-red">{{ $order->menu->price }}</span></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer bg-yellow">
                        <button type="BUTTON" class="btn btn-danger pull-right" data-toggle="modal" data-target="#modal-warning-{{$table->id}}">Check Out</button>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
            <div class="modal modal-warning fade" id="modal-warning-{{$table->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Are you Sure?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Do you want to make Table No. {{ $table->table_no }} free?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                            <a href="{{ route('checkoutTable', $table->id) }}"><button type="button" class="btn btn-outline">Confirm</button></a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endforeach
    </div>

    <div class="row margin-left-40px">
        {{--Table for reserved--}}
        <h2 class="page-header">Busy Table</h2>

        @foreach($tableBusy as $table)
            <div class="col-md-3">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Table No. {{$table->table_no}} | {{$table->table_name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped height-200px">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Menu Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                            @foreach($table->orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->menu->name }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td><span class="badge bg-red">{{ $order->menu->price }}</span></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer bg-red">
                        <a href="{{ route('editorder', $table->id) }}"> <button type="submit" class="btn btn-warning pull-right">Edit</button></a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        @endforeach
    </div>

    <div class="row margin-left-40px">
        {{--Table for free--}}
        <h2 class="page-header">Free Table</h2>
        @foreach($tableFree as $table)
            <div class="col-md-3">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Table No. {{$table->table_no}} | {{$table->table_name}}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection