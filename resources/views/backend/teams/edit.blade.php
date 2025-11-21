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
                                   {{-- <form method="POST" action="{{ url('admin/team/edit/' . Crypt::encrypt($team->id)) }}" enctype="multipart/form-data"> --}}
                                   <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" value="{{ old('team_name', $team->team_name ?? '') }}" name="team_name" id="team_name" placeholder="Enter team name" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Email <span class="text-danger">*</span></label>
                                                       <input type="email" class="form-control" value="{{ old('team_email', $team->team_email ?? '') }}" name="team_email" id="team_email" placeholder="Enter email address" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Phone <span class="text-danger">*</span></label>
                                                       <input type="number" class="form-control" value="{{ old('phone_number', $team->team_number ?? '') }}" name="phone_number" id="phone_number" placeholder="Enter phone number" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Region <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" value="{{ old('region', $team->region ?? '') }}" name="region" id="region" placeholder="Enter region" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Location <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" value="{{ old('address', $team->address ?? '') }}" name="address" id="address" placeholder="Enter location/address" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Stadium <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" value="{{ old('stadium', $team->stadium ?? '') }}" name="stadium" id="stadium" placeholder="Enter stadium" required>
                                                  </div>
                                             </div>
                                             {{-- <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Founded <span class="text-danger">*</span></label>
                                                       <input type="date" class="form-control" value="{{ old('founded_year', $team->founded_year ?? '') }}" name="founded_year" id="founded_year" min="1900-01-01" max="{{ date('Y-m-d') }}" placeholder="Enter founded year" required>
                                                  </div>
                                             </div> --}}
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Status <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="status" id="status" required>
                                                            <option selected="">--Select--</option>
                                                            <option value="active" {{ old('status',$team->status == 'active') ? 'selected' : '' }}>Active</option>
                                                            <option value="in_active" {{ old('status',$team->status == 'in_active') ? 'selected' : '' }}>Inactive</option>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-md-6 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="section-title">Registration Certificate</label>
                                                       <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="registration_certificate" value="{{ old('registration_certificate') }}" name="registration_certificate">
                                                            <label class="custom-file-label" for="registration_certificate">Choose file</label>
                                                       </div>
                                                       <small class="text-danger">Choose file if you want to update</small>
                                                  </div>
                                             </div>
                                        </div>   
                                        <div class="card-footer float-right">
                                             @if(Auth::user()->role === 'admin')
                                             <a href="{{ route('admin-team-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             @elseif(Auth::user()->role === 'manager')
                                             <a href="{{ route('manager-team-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             @endif
                                             <button type="submit" class="btn btn-primary">Update changes</button>
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
