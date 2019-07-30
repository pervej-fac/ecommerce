@extends('layouts.backend.master')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Search Box</h4>
          <div class="box-controls pull-right">
            <a href="{{ route('product.create') }}" class="btn btn-info btn-sm pull-right">Add New</a>
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
                  <th>Serial</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                @foreach ($products as $product)
                  <tr>
                      <td>{{ $serial++ }}</td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->price }}</td>
                      <td>{{ $product->stock }}</td>
                      <td><span class="label {{ ($product->status=='active')?'label-info':'label-warning' }}">{{ $product->status }} </span></td>
                      <td>
                        <a href="{{ route('product.show',$product->id) }}" class="btn btn-sm btn-info">Details</a>
                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-sm btn-info">Edit</a>

                        @if ($product->deleted_at==null)
                          <form method="post" action="{{ route('product.destroy',$product->id) }}" style="display:inline">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete?')">Delete</button>
                            </form>
                        @else
                          <form method="post" action="{{ route('product.restore',$product->id) }}" style="display:inline">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Do you want to restore?')">Restore</button>
                          </form>
                          <form method="post" action="{{ route('product.delete',$product->id) }}" style="display:inline">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to permanent delete?')">Permanet Delete</button>
                          </form>
                        @endif                     
                        
                    </td>
                  </tr>
                @endforeach                
              </table>
            </div>
            {{ $products->render() }}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection