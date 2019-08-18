@csrf
<section>
    <div class="row">
        <div class="col-md-6">
                @php
                    if(old('type')){
                        $type=old('type');
                    }
                    elseif(isset($user)){
                        $type=$user->type;
                    }
                    else{
                        $type=null;
                    }
                @endphp
            <div class="form-group">
                <label for="type">Type :</label>
                <select name="type" id="type" class="form-control form-control-line @error('type') is-invalid @enderror">
                    <option value="">-- Select Type --</option>                    
                    <option value="admin" 
                    @if ($type=='admin')
                        selected
                    @endif
                    >Admin</option>
                    <option value="manager" 
                    @if ($type=='manager')
                        selected
                    @endif
                    >Manager</option>
                </select> 
            </div>
      
            @error('type')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name">User Name :</label>
                <input type="text" value="{{ old('name',isset($user)?$user->name:null) }}" class="form-control form-control-line @error('name') is-invalid @enderror" id="name" name="name" >
            </div>

            @error('name')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email Address :</label>
                <input type="email" value="{{ old('email',isset($user)?$user->email:null) }}" class="form-control form-control-line @error('email') is-invalid @enderror" id="email" name="email" >
            </div>

            @error('email')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password"  class="form-control form-control-line @error('password') is-invalid @enderror" id="password" name="password" >
            </div>

            @error('password')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password_confirmation">Confirm Password :</label>
                <input type="password"  class="form-control form-control-line @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" >
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone :</label>
                <input type="text" value="{{ old('phone',isset($user)?$user->phone:null) }}" class="form-control form-control-line @error('phone') is-invalid @enderror" id="phone" name="phone" >
            </div>

            @error('phone')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Image :</label>
                <img src="{{ asset(isset($user)?$user->image:null) }}" width="30%">
                <input type="file" class="form-control form-control-line @error('image') is-invalid @enderror" id="image" name="image" >
            </div>

            @error('image')
                <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <div class="form-group">
                @php
                    if(old('status')){
                        $status=old('status');
                    }
                    elseif(isset($user)){
                        $status=$user->status;
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
    </div>
</section>
