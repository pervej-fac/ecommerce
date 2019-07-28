@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box box-default">
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                    <form action="{{ route('product.update',$product->id) }}" method="POST">      
                        @method('put')                  
                        @include('admin.product._form')                        
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <!-- /.box-body -->
              </div>
        </div>
    </div>
@endsection
