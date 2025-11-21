@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
     @include('backend.layouts.header')
    <section class="content mt-3">
          <div class="container-fluid">
               @include('backend.layouts._message')
               <div class="card bg-light p-5 card-primary card-outline">
                    <div class="row">
                         <div class="col-md-4">
                              <div class="card">
                                   <div class="card-body box-profile">
                                        <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="{{ url('assets/avatar.jpg') }}"
                                             alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center">
                                        {{ ($user->first_name.' '.$user->middle_name.' '.$user->last_name) ?? 'N/A' }}
                                        </h3>

                                        <p class="text-muted text-center text-uppercase">{{ $user->role }}</p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                        <b>Phone Number:</b> <a class="float-right">{{ $user->phone_number ?? 'N/A' }}</a>
                                        </li>
                                        <li class="list-group-item">
                                        <b>Email Address:</b> <a class="float-right">{{ $user->email ?? 'N/A' }}</a>
                                        </li>
                                        <li class="list-group-item">
                                        <b>Location:</b> <a class="float-right">{{ $user->location ?? 'N/A' }}</a>
                                        </li>
                                        <li class="list-group-item">
                                        <b>Team Name:</b> <a class="float-right">{{ $user->team_name ?? 'N/A' }}</a>
                                        </li>
                                        </ul>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="card">
                                   <div class="card-header p-3">
                                        <h3 class="header-title">Settings</h3>
                                   </div>
                                   <div class="card-body">
                                        <div class="p-3">
                                             <form method="POST" action="{{ route('profile.update', Crypt::encrypt($user->id)) }}" enctype="multipart/form-data">
                                             {{-- <form class="form-horizontal" method="POST" action="{{ url('profile/edit/' . Crypt::encrypt($user->id)) }}" enctype="multipart/form-data"> --}}
                                                  @csrf
                                                  <div class="form-group row">
                                                       <label for="inputName" class="col-sm-2 col-form-label text-right">First name</label>
                                                       <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="{{ $user->first_name }}">
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <label for="inputName" class="col-sm-2 col-form-label text-right">Middle name</label>
                                                       <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle name" value="{{ $user->middle_name }}">
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <label for="inputName" class="col-sm-2 col-form-label text-right">Last name</label>
                                                       <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" value="{{ $user->last_name }}">
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <label for="inputName" class="col-sm-2 col-form-label text-right">Phone number</label>
                                                       <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Phone number" value="{{ $user->phone_number }}">
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <label for="inputName" class="col-sm-2 col-form-label text-right">Email</label>
                                                       <div class="col-sm-10">
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <label for="inputName" class="col-sm-2 col-form-label text-right">Location</label>
                                                       <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="{{ $user->location }}">
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <label for="inputSkills" class="col-sm-2 col-form-label text-right">Password</label>
                                                       <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="password" name="password" placeholder="Change password">
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <div class="offset-sm-2 col-sm-10">
                                                            <small class="text-danger" id="password-option">Enter a password if you want to change it.</small>
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <div class="offset-sm-2 col-sm-10">
                                                            <button type="submit" class="btn btn-danger">Submit changes</button>
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </section>
</div>



@endsection
