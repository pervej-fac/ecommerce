@extends('layouts.backend.master')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Search Box</h4>
          <div class="box-controls pull-right">
            <a href="{{ route('category.create') }}" class="btn btn-info btn-sm pull-right">Add New</a>
            <div class="lookup lookup-circle lookup-right">
              <input type="text" name="s">
            </div>                
          </div>          
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                @foreach ($categories as $category)
                  <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->name }}</td>
                      <td><span class="label {{ ($category->status=='active')?'label-info':'label-warning' }}">{{ $category->status }} </span></td>
                      <td>
                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form method="post" action="{{ route('category.destroy',$category->id) }}" style="display:inline">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete?')">Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach                
              </table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection