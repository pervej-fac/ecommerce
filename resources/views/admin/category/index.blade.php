@extends('layouts.backend.master')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Search Box</h4>
          <div class="box-controls pull-right">
            <a href="{{ route('category.create') }}" class="btn btn-info btn-sm pull-right">Add New</a>
            <form action="">
              <div class="lookup lookup-circle lookup-right">                
                  <input type="text" name="search" value="{{ request()->search }}"> 
                  {{--  Search is control name  --}}
                  <select name="status" id="">
                    <option value="">select status</option>
                    <option value="active" @if(request()->status=="active") selected @endif>Active</option>
                    <option value="inactive" @if(request()->status=="inactive") selected @endif>Inactive</option>
                  </select>
                  <button class="btn btn-sm btn-warning pull-right" type="submit">Search</button>                
              </div>    
          </form>            
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
                        @if ($category->deleted_at==null)
                          <form method="post" action="{{ route('category.destroy',$category->id) }}" style="display:inline">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete?')">Delete</button>
                            </form>
                        @else
                          <form method="post" action="{{ route('category.restore',$category->id) }}" style="display:inline">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Do you want to restore?')">Restore</button>
                          </form>
                          <form method="post" action="{{ route('category.delete',$category->id) }}" style="display:inline">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to permanent delete?')">Permanet Delete</button>
                          </form>
                        @endif                     
                        
                    </td>
                  </tr>
                @endforeach                
              </table>
            </div>
            {{ $categories->render() }}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection