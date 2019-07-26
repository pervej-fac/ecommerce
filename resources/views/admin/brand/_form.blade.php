@csrf
<section>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text" value="{{ old('name',isset($brand)?$brand->name:null) }}" class="form-control form-control-line @error('name') is-invalid @enderror" id="name" name="name" >
            </div>

            @error('name')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                @php
                    if(old('status')){
                        $status=old('status');
                    }
                    elseif(isset($brand)){
                        $status=$brand->status;
                    }
                    else{
                        $status=null;
                    }
                @endphp
                <label>Status :</label><br/>
                <input type="radio" @if ($status=='active') checked @endif class="form-control" id="active" name="status" value="active">
                <label for="active">Active</label>
                <input type="radio" @if ($status=='inactive') checked @endif class="form-control" id="inactive" name="status" value="inactive">
                <label for="inactive">Inactive</label>
            </div>
            @error('status')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name :</label>
                <textarea  class="form-control form-control-line @error('details') is-invalid @enderror" id="details" name="details" rows="5">{{ old('details',isset($brand)?$brand->details:null) }}</textarea>
            </div>

            @error('details')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</section>
