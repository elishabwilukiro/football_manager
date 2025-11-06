@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content mt-3">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   <h3 class="card-title">{{ (strtoupper($data['title'])) }}</h3>
                                   <a type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-lg">Add New</a>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <div id="getView">
                                             {{-- <img src="{{ url('assets/loader.svg') }}" alt=""> --}}
                                        </div>
                                        <table class="table table-striped table-bordered">
                                             {{-- <thead>
                                                  <tr>
                                                       <th>SN</th>
                                                       <th>Photo</th>
                                                       <th>Full Name</th>
                                                       <th>Username</th>
                                                       <th>Email</th>
                                                       <th>Phone Number</th>
                                                       <th>Role</th>
                                                       <th>Team</th>
                                                       <th>Location</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead> --}}
                                             {{-- <tbody>
                                                  @php $n=1; @endphp
                                                  @foreach ($user as $item)      
                                                  @php 
                                                       // $team_name = App\Models\Team::where('id',$item->team_id)->value()->get();
                                                  @endphp    
                                                  <tr>
                                                       <td> {{ $n; }}</td>
                                                       <td> 
                                                            <figure>
                                                                 {{ $item->upload }}
                                                                 <img alt="image" src="{{ url('assets/avatar.jpg') }}" class="avatar avatar-lg" width="40">
                                                            </figure>
                                                       </td>
                                                       <td>{{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}</td>
                                                       <td>{{ $item->username }}</td>
                                                       <td><a href="mailto:{{ $item->email }}" class="text-dark">{{ $item->email }}</a></td>
                                                       <td><a href="tel:{{ $item->phone_number }}" class="text-dark">{{ $item->phone_number }}</a></td>
                                                       <td>{{ $item->role }}</td>
                                                       <td>
                                                            <span class="btn btn-default btn-block" onclick=" return getTeamDetails({{ $item->team_id }})">
                                                                 {{ $item->team_id }}
                                                            </span>
                                                       </td>
                                                       <td>{{ $item->location }}</td>
                                                       <td class="align-middle">
                                                            @if ($item->status == 'active')
                                                            <span class="badge badge-success badge-shadow">Active</span>
                                                            @else
                                                            <span class="badge badge-warning badge-shadow">Inactive</span>
                                                            @endif
                                                       </td>
                                                       <td>
                                                            <div class="btn-group mt-1.5" role="group">
                                                                 <button type="button" class="btn btn-info" title="Print" onclick="printUserDetails({{$item->id}}"><i class="fas fa-eye"></i></button>
                                                                 <button type="button" class="btn btn-warning" title="Edit" onclick="editUserDetails({{$item->id}}"><i class="far fa-edit"></i></button>
                                                                 <button type="button" class="btn btn-danger" title="Delete" onclick="deleteUserDetails({{$item->id}}"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                       </td>
                                                  </tr>
                                                  @php $n ++; @endphp
                                                  @endforeach
                                             </tbody> --}}
                                        </table> 
                                   </div>                                                                
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</div>


<!-- Add New User -->
<div class="modal fade" id="modal-lg">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h3 class="modal-title">Team Manager</h3>
                    <strong class="text-danger float-right">Required *</strong>
               </div>
               <div class="modal-body">
                    <form id="form" onsubmit="save(event)" enctype="form-data/multipart">
                         @csrf
                         <input type="hidden" class="form-control" id="hidden_id" name="hidden_id" >
                         <div class="row">
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>First name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="James" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Middle name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="John" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Lst name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Doe" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Username </label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Doe">
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="johndoe@mail.com" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="row">
                                        <div class="col-8">
                                             <label for="">Password <span class="text-danger">*</span></label>
                                             <div class="form-group" id="show_hide_password">
                                                  <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                                             </div>
                                        </div>
                                        <div class="col-4 mt-5">
                                             <div class="checkbox" id="show_hide_pwd">
                                                  <input id="checkbox" name="checkbox" type="checkbox">
                                                  <label for="checkbox">Show</label>
                                             </div>
                                        </div>
                                   </div>
                                   <span class="text-danger" id="password-option">Note: Enter a password if you want to change it.</span>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="07..." required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Chamazi, Dar es Salaam" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Team name <span class="text-danger">*</span></label>
                                        <select class="custom-select" name="team_id" id="team_id" >
                                             <option selected="">--Select--</option>
                                             @foreach ($team as $item)
                                             <option value="{{ $item->id }}">{{ $item->team_name }}</option>                                                 
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
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
                         
                         <div class="modal-footer float-right">
                              <button type="button" class="btn btn-secondary" onclick="return closeModel()" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<!-- Team Profile -->
<div class="modal fade" id="TeamProfile">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="card bg-light card-widget widget-user-2 shadow-sm">
                    <div class="widget-user-header bg-warning">
                         <div class="widget-user-image">
                              <img class="img-circle img-fluid" src="{{ url('assets/avatar.jpg') }}" alt="Team Avatar">
                         </div>
                         <h3 class="widget-user-username" id="team_name"></h3>
                         <h5 class="widget-user-desc" id="registration_no"></h5>
                    </div>
                    <div class="card-body p-0 py-3">
                         <ul class="nav flex-column">
                              <li class="nav-item">
                                   <a href="#" class="nav-link">
                                   Projects <span class="float-right badge bg-primary">31</span>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="#" class="nav-link">
                                   Tasks <span class="float-right badge bg-info">5</span>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="#" class="nav-link">
                                   Completed Projects <span class="float-right badge bg-success">12</span>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="#" class="nav-link">
                                   Followers <span class="float-right badge bg-danger">842</span>
                                   </a>
                              </li>
                              <li class="nav-item"></li>
                         </ul>
                    </div>
                    <div class="text-right px-3">
                         <a href="#" title="Close" onclick="return closeModel()" data-dismiss="modal" class="btn btn-sm btn-secondary">
                              <i class="fas fa-times"></i>
                         </a>
                         <a href="#" title="Print" class="btn btn-sm btn-primary">
                              <i class="fas fa-print"></i>
                         </a>
                    </div>
               </div>
          </div>
     </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
    getView();
    closeModel();
// 
//     $("input[name=checkbox]").on('click', function (event) {
//         // event.preventDefault();
//         if ($('#show_hide_password input').attr("type") == "text") {
//             $('#show_hide_password input').attr('type', 'password');
//         } else if ($('#show_hide_password input').attr("type") == "password") {
//             $('#show_hide_password input').attr('type', 'text');
//         }
//     });
});

function getView() {
    $.ajax({
        type: "GET",
        url: "{{ route('admin-user-view') }}",
        dataType: 'html',
        cache: false,
        success: function (data) {
            $("#getView").html(data)
        }
    });
}

function clear_input() {
    document.getElementById('form').reset();
    $("#hidden_id").val("")
    getView()
}

function closeModel(){
     $('#TeamProfile').modal('hide');
     $('#modal-lg').modal('hide');
}

function getTeamDetails(id){
    $('#TeamProfile').modal('show');
    jQuery.ajax({
        type: "GET",
        url: "/admin/team-details/"+id,
        dataType: 'json',
        success: function (data) {
            $("#hidden_id").val(data.id)
            var rowData=data.data;
            $("#team_name").text(rowData.team_name);
            $("#registration_no").html(rowData.registration_number);
            $("#full_name").val(rowData.name);
            $("#phone").val(rowData.phone);
            $("#user_email").val(rowData.email);
            $("#location").val(rowData.location);
            $("#user_role").val(rowData.role);
            $("#user_status").val(rowData.status);
            $("#submitBtn").html("Update");
        }
    });
}

function deleteTeamDetails(id){
    var conf = confirm("ARE YOU SURE YOU WANT TO DELETE.?");
    if (!conf) {
        return;
    }

    jQuery.ajax({
        type: "GET",
        url: "/admin/team-delete/"+id,
        dataType: 'json',
        success: function (data) {
            if (data.status == 200) {
                showFlashMessage("success", data.message);
                clear_input()
            } else {
                showFlashMessage("warning", data.message);
            }
            disableBtn("submitBtn", false);
            $("#submitBtn").html("Save ")
        }
    });
}

function editTeamDetails(id){
    document.getElementById('form').reset();
    $("#hidden_id").val("")
    $("#submitBtn").html("Update");
    $('#modal-lg').modal('show');
    $("#password-option").show();

    jQuery.ajax({
        type: "GET",
        url: "/admin/team-edit/"+id,
        dataType: 'json',
        success: function (data) {
            $("#hidden_id").val(data.id)

            var rowData=data.data;

            $("#full_name").val(rowData.name);
            $("#username").val(rowData.username);
            $("#full_name").val(rowData.name);
            $("#phone").val(rowData.phone);
            $("#user_email").val(rowData.email);
            $("#location").val(rowData.location);
            $("#user_role").val(rowData.role);
            $("#user_status").val(rowData.status);
            $("#submitBtn").html("Update");
        }
    });
}

function save(e) {
    e.preventDefault();

    $("#submitBtn").html("Update");
    var form = document.getElementById('form');
    var formData = new FormData(form);

    jQuery.ajax({
        type: "POST",
        url: "{{ route('admin-team-save') }}",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            if (data.status == 200) {
                showFlashMessage("success", data.message);
                clear_input()
            } else {
                showFlashMessage("warning", data.message);
            }
            disableBtn("submitBtn", false);
            $("#submitBtn").html("Save")
        }
    });
}

</script>




@endsection
