@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content mt-3">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-md-4">
                         <!-- Profile Image -->
                         <div class="card card-primary card-outline">
                         <div class="card-body box-profile">
                              <div class="text-center">
                              <img class="profile-user-img img-fluid img-circle"
                                   src="{{ url('assets/avatar.jpg') }}"
                                   alt="User profile picture">
                              </div>

                              <h3 class="profile-username text-center">
                              {{ $user->first_name.' '.$user->middle_name.' '.$user->last_name }}
                              </h3>

                              <p class="text-muted text-center text-uppercase">{{ $user->role }}</p>

                              <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                              <b>Phone Number</b> <a class="float-right">{{ $user->phone_number }}</a>
                              </li>
                              <li class="list-group-item">
                              <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                              </li>
                              <li class="list-group-item">
                              <b>Address</b> <a class="float-right">{{ $user->location }}</a>
                              </li>
                              <li class="list-group-item">
                              <b>Team</b> <a class="float-right">{{ $user->team_name }}</a>
                              </li>
                              </ul>
                         </div>
                         </div>
                    </div>
                    <div class="col-md-8">
                         <div class="card">
                              <div class="card-header p-2">
                                   <ul class="nav nav-pills">
                                   <li class="nav-item"><a class="nav-link active" href="#aboutMe" data-toggle="tab">About Me</a></li>
                                   <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                                   </ul>
                              </div>
                              <div class="card-body">
                                   <div class="tab-content">
                                        <div class="active tab-pane" id="aboutMe">
                                             <div class="card-body">
                                                  <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                                  <p class="text-muted">
                                                  B.S. in Computer Science from the University of Tennessee at Knoxville
                                                  </p>

                                                  <hr>

                                                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                                  <p class="text-muted">Malibu, California</p>

                                                  <hr>

                                                  <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                                  <p class="text-muted">
                                                  <span class="tag tag-danger">UI Design</span>
                                                  <span class="tag tag-success">Coding</span>
                                                  <span class="tag tag-info">Javascript</span>
                                                  <span class="tag tag-warning">PHP</span>
                                                  <span class="tag tag-primary">Node.js</span>
                                                  </p>

                                                  <hr>

                                                  <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                                                  <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                             </div>                                   
                                        </div>
                                        <div class="tab-pane" id="settings">
                                             <form class="form-horizontal">
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
                                                       <label for="inputName" class="col-sm-2 col-form-label text-right">First name</label>
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
                                                            <span class="text-danger" id="password-option">NOTE: Enter a password if you want to change it.</span>
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
