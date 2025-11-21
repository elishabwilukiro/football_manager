@extends('backend.layouts.app')
@section('content')


<div class="content-wrapper">
     @include('backend.layouts.header')
    <section class="content mt-3">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                         @include('backend.layouts._message')
                         <div class="card">
                              <div class="card-header">
                                   <h3 class="card-title">{{ (strtoupper($data['section'])) }}</h3>
                              </div>
                              <div class="card-body">
                                   <form method="POST" action="{{ url('admin/user/edit/' . Crypt::encrypt($user->id)) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>First name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name ?? '') }}" placeholder="James" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Middle name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name', $user->middle_name ?? '') }}" placeholder="John" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Lst name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name ?? '') }}" placeholder="Doe" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Username </label>
                                                       <input type="text" class="form-control" name="username" id="username" value="{{ old('username', $user->username ?? '') }}" placeholder="Doe">
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Email <span class="text-danger">*</span></label>
                                                       <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" placeholder="johndoe@mail.com" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="row">
                                                       <div class="col-8">
                                                            <label for="">Password <span class="text-danger">*</span></label>
                                                            <div class="form-group" id="show_hide_password">
                                                                 <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Enter password">
                                                            </div>
                                                       </div>
                                                       <div class="col-4 mt-5">
                                                            <div class="checkbox" id="show_hide_pwd">
                                                                 <input id="checkbox" name="checkbox" type="checkbox">
                                                                 <label for="checkbox">Show</label>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <span class="text-danger" id="password-option">Enter a password if you want to change it.</span>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Phone <span class="text-danger">*</span></label>
                                                       <input type="number" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->middle_name ?? '') }}" placeholder="07..." required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Address <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $user->middle_name ?? '') }}" placeholder="Chamazi, Dar es Salaam" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Team name <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="team_id" id="team_id" >
                                                            <option selected="">--Select--</option>
                                                            @foreach ($teams as $item)
                                                            <option value="{{ $item->id }}" {{ ($user->team->id == $item->id) ? 'selected' : '' }}>{{ $item->team_name }}</option>                                                 
                                                            @endforeach
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Status <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="status" id="status" required>
                                                            <option selected="">--Select--</option>
                                                            <option value="active" {{ old('status',$user->status == 'active') ? 'selected' : '' }}>Active</option>
                                                            <option value="in_active" {{ old('status', $user->status == 'in_active') ? 'selected' : '' }}>Inactive</option>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="section-title">Photo</label>
                                                       <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="photo" name="photo">
                                                            <label class="custom-file-label" for="photo">Choose file</label>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>  
                                        <div class="card-footer float-right">
                                             <a href="{{ route('admin-user-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </section>
</div>



<script type="text/javascript">

// Get today's date
// const today = new Date();
// const yyyy = today.getFullYear();
// const mm = String(today.getMonth() + 1).padStart(2, '0');
// const dd = String(today.getDate()).padStart(2, '0');
// const maxDate = `${yyyy}-${mm}-${dd}`;
// document.getElementById('date_of_birth').setAttribute('max', maxDate);

</script>
@endsection
