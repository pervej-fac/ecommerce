@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box box-default">
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                    <form action="{{ route('category.store') }}" method="POST">                        
                        @include('admin.category._form')                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.box-body -->
              </div>
        </div>
    </div>
@endsection
