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
                                   <form method="POST" action="{{ route('admin-team-save') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="team_name" id="team_name" value="{{ old('team_name') }}" placeholder="Enter team name" required>
                                                       <span class="text-danger">{{ $errors->first('team_name') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Email <span class="text-danger">*</span></label>
                                                       <input type="email" class="form-control" name="team_email" id="team_email" value="{{ old('team_email') }}" placeholder="Enter email address" required>
                                                       <span class="text-danger">{{ $errors->first('team_email') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Phone <span class="text-danger">*</span></label>
                                                       <input type="number" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="Enter phone number" required>
                                                       <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Region <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="region" id="region" value="{{ old('region') }}" placeholder="Enter region" required>
                                                       <span class="text-danger">{{ $errors->first('region') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Location <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" placeholder="Enter location/ address" required>
                                                       <span class="text-danger">{{ $errors->first('address') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Stadium <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="stadium" id="stadium" value="{{ old('stadium') }}" placeholder="Enter stadium" required>
                                                       <span class="text-danger">{{ $errors->first('stadium') }}</span>
                                                  </div>
                                             </div>
                                             {{-- <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Founded <span class="text-danger">*</span></label>
                                                       <input type="date" class="form-control" name="founded_year" id="founded_year" min="1900-01-01" max="{{ date('Y-m-d') }}" value="{{ old('founded_year') }}" placeholder="Enter founded year" required>
                                                       <span class="text-danger">{{ $errors->first('founded_year') }}</span>
                                                  </div>
                                             </div> --}}
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Status <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="status" id="status" required>
                                                            <option selected="">--Select--</option>
                                                            <option value="active">Active</option>
                                                            <option value="in_active">Inactive</option>
                                                       </select>
                                                  </div>
                                             </div>
                                             {{-- <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="section-title">Photo/Logo</label>
                                                       <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="logo" value="{{ old('logo') }}" name="logo">
                                                            <label class="custom-file-label" for="logo">Choose file</label>
                                                       </div>
                                                  </div>
                                             </div> --}}
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="section-title">Registration Certificate</label>
                                                       <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="registration_certificate" value="{{ old('registration_certificate') }}" name="registration_certificate">
                                                            <label class="custom-file-label" for="registration_certificate">Choose file</label>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>   
                                        <div class="card-footer float-right">
                                             @if(Auth::user()->role === 'admin')
                                             <a href="{{ route('admin-team-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             @elseif(Auth::user()->role === 'manager')
                                             <a href="{{ route('manager-team-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             @endif
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
