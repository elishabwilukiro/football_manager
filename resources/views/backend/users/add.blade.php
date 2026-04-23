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
                                   <form method="POST" action="{{ route('admin-user-save') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>First name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="James" required>
                                                       <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Middle name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" placeholder="John" required>
                                                       <small class="text-danger">{{ $errors->first('middle_name') }}</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Last name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Doe" required>
                                                       <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Username </label>
                                                       <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" placeholder="Doe">
                                                       <small class="text-danger">{{ $errors->first('username') }}</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Email <span class="text-danger">*</span></label>
                                                       <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="johndoe@mail.com" required>
                                                       <small class="text-danger">{{ $errors->first('email') }}</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label for="">Default password <span class="text-danger">*</span></label>
                                                       <input type="text" id="password" name="password" class="form-control" value="password@123" disabled placeholder="Enter password">
                                                       <small class="text-danger">{{ $errors->first('password') }}</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Phone <span class="text-danger">*</span></label>
                                                       <input type="number" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="07*******" required>
                                                       <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Location <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}" placeholder="Chamazi, Dar es Salaam" required>
                                                       <small class="text-danger">{{ $errors->first('location') }}</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Team name <span class="text-info mr-3">(Apply for team managers only)</span></label>
                                                       <select class="custom-select" name="team_id" id="team_id" >
                                                            <option selected="">--Select--</option>
                                                            @foreach ($team as $item)
                                                            <option value="{{ $item->id }}">{{ $item->team_name }}</option>                                                 
                                                            @endforeach
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Role <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="role" id="role" required>
                                                            <option selected="">--Select--</option>
                                                            <option value="admin" {{ old('admin') }}>System Admin</option>
                                                            <option value="manager" {{ old('manager') }}>Team Manager</option>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Status <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="status" id="status" required>
                                                            <option selected="">--Select--</option>
                                                            <option value="active">Active</option>
                                                            <option value="in_active">Inactive</option>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
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
                                             <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </section>
</div>

@endsection
