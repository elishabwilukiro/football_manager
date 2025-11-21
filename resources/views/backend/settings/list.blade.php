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
                                   <form method="POST" action="{{ route('admin-setting-save') }}" enctype="form-data/multipart">
                                        @csrf
                                        <div class="row">
                                             <div class="col-md-3 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="text-muted">Player registration deadline <span class="text-danger">*</span></label>
                                                       <input type="date" class="form-control" name="player_registration_deadline" id="player_registration_deadline" value="{{ $settings['player_registration_deadline'] ?? '' }}" placeholder="Enter date" min="{{ date('Y-m-d') }}"  required>
                                                  </div>
                                             </div>
                                             <div class="col-md-3 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="text-muted">Player low age limit <span class="text-danger">*</span></label>
                                                       <input type="number" class="form-control" name="player_low_age_limit" id="player_low_age_limit" value="{{ $settings['player_low_age_limit'] ?? '' }}" min="17" placeholder="Enter age" required>
                                                  </div>
                                             </div>
                                             <div class="col-md-3 col-sm-12">
                                                  <div class="form-group">
                                                       <label class="text-muted">Team registration deadline <span class="text-danger">*</span></label>
                                                       <input type="date" class="form-control" name="team_registration_deadline" id="team_registration_deadline" value="{{ $settings['team_registration_deadline'] ?? '' }}" placeholder="Enter date" min="{{ date('Y-m-d') }}"  required>
                                                  </div>
                                             </div>
                                        </div> 
                                        <div class="card-footer float-right">
                                             <button type="submit" class="btn btn-primary" id="submitBtn">Save changes</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </section>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    let today = new Date().toISOString().split('T')[0];

    document.getElementById('player_registration_deadline').setAttribute('min', today);
    document.getElementById('team_registration_deadline').setAttribute('min', today);
});
</script>
@endsection
