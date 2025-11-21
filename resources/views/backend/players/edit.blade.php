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
                                   <form method="POST" action="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>First name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name', $player->first_name ) }}" placeholder="Enter first name" required>
                                                       <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Middle name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name', $player->middle_name ) }}" placeholder="Enter middle name" required>
                                                       <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Last name <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name', $player->last_name ) }}" placeholder="Enter last name" required>
                                                       <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Email <span class="text-danger">*</span></label>
                                                       <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $player->email ) }}" placeholder="Enter email address" required>
                                                       <span class="text-danger">{{ $errors->first('email') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Phone <span class="text-danger">*</span></label>
                                                       <input type="number" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number', $player->phone_number ) }}" placeholder="Eg. 07*******" required>
                                                       <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Date of Birth <span class="text-danger">*</span></label>
                                                       <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" min="1980-01-01" max="{{ date('Y-m-d') }}" value="{{ old('date_of_birth', $player->date_of_birth ) }}" placeholder="Eg. 01-01-2002" required>
                                                       <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Birth Certificate No. </label>
                                                       <input type="number" class="form-control" name="birth_certificate_no" id="birth_certificate_no" min="1" value="{{ old('birth_certificate_no', $player->birth_certificate_no ) }}" placeholder="Eg. 17212784787">
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Nationality <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="nationality" id="nationality" value="{{ old('nationality', $player->nationality ) }}" placeholder="Enter nationality" required>
                                                       <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Region <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="region" id="region" value="{{ old('region', $player->region ) }}" placeholder="Enter region" required>
                                                       <span class="text-danger">{{ $errors->first('region') }}</span>
                                                  </div>
                                             </div>
                                             {{-- <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>National ID <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="national_id" id="national_id" value="{{ old('national_id', $player->national_id ) }}" placeholder="Eg. 20010120-10023-00001-21">
                                                       <span class="text-danger">{{ $errors->first('national_id') }}</span>
                                                  </div>
                                             </div> --}}
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Location <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $player->address ) }}" placeholder="Enter location/address" required>
                                                       <span class="text-danger">{{ $errors->first('address') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Team name <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="team_id" id="team_id" required>
                                                            <option selected="">--Select--</option>
                                                            @foreach ($team as $item)
                                                            <option value="{{ $item->id }}" {{ old('team_id', $player->team_id) == $item->id ? 'selected' : '' }}>{{ $item->team_name }}</option>                                                 
                                                            @endforeach
                                                       </select>
                                                       <span class="text-danger">{{ $errors->first('team_id') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Position <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="position_id" required>
                                                            <option value="">--Select--</option>
                                                            @foreach ($position as $item)
                                                            <option value="{{ $item->id }}" {{ old('position_id', $player->position_id) == $item->id ? 'selected' : '' }}> {{ $item->position_name }}</option>
                                                            @endforeach
                                                       </select>
                                                       <span class="text-danger">{{ $errors->first('position_id') }}</span>
                                                  </div>
                                             </div>
                                             {{-- <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Jersey No. </label>
                                                       <input type="number" class="form-control" name="jersey_number" id="jersey_number" max="99" min="1" value="{{ old('jersey_number', $player->jersey_number ) }}" placeholder="Eg. 17">
                                                  </div>
                                             </div> --}}
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Status <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="status" id="status" required>
                                                            <option selected="">--Select--</option>
                                                            <option value="active" {{ old('status',$player->status == 'active') ? 'selected' : '' }}>Active</option>
                                                            <option value="in_active" {{ old('status',$player->status == 'in_active') ? 'selected' : '' }}>Inactive</option>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="section-title">Profile Picture</label>
                                                       <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="photo" value="{{ old('photo', $player->photo ) }}" name="photo">
                                                            <label class="custom-file-label" for="photo">Choose file</label>
                                                       </div>
                                                       <small class="text-danger">Choose file if you want to update</small>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="section-title">Birth Certificate</label>
                                                       <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="birth_certificate" value="{{ old('birth_certificate') }}" name="birth_certificate">
                                                            <label class="custom-file-label" for="birth_certificate">Choose file</label>
                                                       </div>
                                                       <small class="text-danger">Choose file if you want to update</small>
                                                  </div>
                                             </div>
                                        </div>  
                                        <div class="card-footer float-right">
                                             @if(Auth::user()->role === 'admin')
                                             <a href="{{ route('admin-player-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             @elseif(Auth::user()->role === 'manager')
                                             <a href="{{ route('manager-player-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             @endif
                                             <button type="submit" class="btn btn-primary" id="submitBtn">Update changes</button>
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
const today = new Date();
const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, '0');
const dd = String(today.getDate()).padStart(2, '0');
const maxDate = `${yyyy}-${mm}-${dd}`;
document.getElementById('date_of_birth').setAttribute('max', maxDate);

</script>
@endsection
