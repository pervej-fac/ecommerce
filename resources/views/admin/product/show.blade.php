@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box box-default">
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                  <table class="table table-responsive table-bordered table-hover table-stripped">
                    <tr>
                        <th>Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Color</th>
                        <td>{{ $product->color }}</td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td>{{ $product->size }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($product->status) }}</td>
                    </tr>
                    <tr>
                        <th>Details</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                  </table>
                  <a href="{{ route('product.index') }}" class="btn btn-info">Back</a>
                </div>
                <!-- /.box-body -->
              </div>
        </div>
    </div>
@endsection
