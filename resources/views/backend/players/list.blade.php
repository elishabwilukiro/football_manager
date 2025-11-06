@extends('backend.layouts.app')
@section('content')


<div class="content-wrapper">
    <section class="content mt-3">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   <h3 class="card-title">{{ (strtoupper($data['header'])) }}</h3>
                                   <a type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-lg">Add New</a>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <div id="getView">
                                             {{-- <img src="{{ url('assets/loader.svg') }}" alt=""> --}}
                                        </div>                                    
                                        <table class="table table-striped table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th>SN</th>
                                                       <th>Photo</th>
                                                       <th>Full Name</th>
                                                       <th>Email</th>
                                                       <th>Phone Number</th>
                                                       <th>Date of Birth</th>
                                                       <th>Registration No.</th>
                                                       <th>National</th>
                                                       <th>City</th>
                                                       <th>Location</th>
                                                       <th>Team Name</th>
                                                       <th>Position</th>
                                                       <th>Registered Date</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  {{-- @php $n=1; @endphp --}}
                                                  @foreach ($players as $player)
                                                       <tr>
                                                            <td>{{ $loop->iteration; }}</td>
                                                            <td> 
                                                                 <figure>
                                                                      {{ $player->logo }}
                                                                      <img alt="image" src="{{ url('assets/avatar.jpg') }}" class="avatar avatar-lg" width="40">
                                                                 </figure>
                                                            </td>
                                                            <td>{{ $player->first_name.' '.$player->middle_name.' '.$player->last_name }}</td>
                                                            <td><a href="mailto:{{ $player->email }}" class="">{{ $player->email }}</a></td>
                                                            <td><a href="tel:{{ $player->phone_number }}" class="">{{ $player->phone_number }}</td>
                                                            <td>{{ $player->date_of_birth }}</td>
                                                            <td>{{ $player->registration_number }}</td>
                                                            <td>{{ $player->nationality }}</td>
                                                            <td>{{ $player->city }}</td>
                                                            <td>{{ $player->address }}</td>
                                                            <td>{{ $player->team->team_name ?? 'N/A' }}</td>
                                                            <td>{{ $player->position->position_name ?? 'N/A' }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                                            <td class="align-middle">
                                                                 @if ($player->status == 'active')
                                                                 <span class="badge badge-success badge-shadow">Active</span>
                                                                 @else
                                                                 <span class="badge badge-warning badge-shadow">Inactive</span>
                                                                 @endif
                                                            </td>
                                                            <td>
                                                                 <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                                      <button type="button" class="btn btn-info" title="Print" onclick="return getPlayerDetails({{$player->id}}"><i class="fas fa-eye"></i></button>
                                                                      <button type="button" class="btn btn-warning" title="Edit" onclick="return editPlayer({{$player->id}}"><i class="far fa-edit"></i></button>
                                                                      <button type="button" class="btn btn-danger" title="Delete" onclick="return deletePlayer({{$player->id}}"><i class="fa fa-trash"></i></button>
                                                                 </div>
                                                            </td>
                                                       </tr>
                                                  {{-- @php $n ++; @endphp --}}
                                                  @endforeach
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </section>
</div>

<!-- Add New Player -->
<div class="modal fade" id="modal-lg">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h3 class="modal-title">Player</h3>
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
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Eg. James" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Middle name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Eg. John" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Last name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Eg. Doe" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Eg. johndoe@email.tz" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Eg. 07*******" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Eg. 01-01-2002" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Nationality <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Eg. Tanzania" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Eg. Dar es Salaam" required>
                                   </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                   <div class="form-group">
                                        <label>National ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="national_id" id="national_id" placeholder="Eg. 20010120-10023-00001-21" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Eg. Ubungo, Kawe" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Team <span class="text-danger">*</span></label>
                                        <select class="custom-select" name="team_id" id="team_id" required>
                                             <option selected="">--Select--</option>
                                             @foreach ($team as $item)
                                             <option value="{{ $item['id'] }}">{{ $item['team_name'] }}</option>                                                 
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Position <span class="text-danger">*</span></label>
                                        <select class="custom-select" name="position_id" id="position_id" required>
                                             <option selected="">--Select--</option>
                                             @foreach ($position as $item)
                                             <option value="{{ $item['id'] }}">{{ $item['position_name'] }}</option>                                                 
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Jersey No. </label>
                                        <input type="number" class="form-control" name="jersey_number" id="jersey_number" placeholder="Eg. 17" required>
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

<!-- Player Profile -->
<div class="modal fade" id="playerProfile">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                         <div class="card-header text-muted border-bottom-0">
                              Digital Strategist
                         </div>
                         <div class="card-body pt-0">
                         <div class="row">
                         <div class="col-7">
                              <h2 class="lead"><b>Nicole Pearson</b></h2>
                              <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                              </ul>
                         </div>
                         <div class="col-5 text-center">
                              <img src="{{ url('assets/img/user2-160x160.jpg') }}" alt="user-avatar" class="img-circle img-fluid">
                         </div>
                         </div>
                         </div>
                         <div class="card-footer">
                         <div class="text-right">
                         <a href="#" class="btn btn-sm bg-teal">
                              <i class="fas fa-comments"></i>
                         </a>
                         <a href="#" class="btn btn-sm btn-primary">
                              <i class="fas fa-user"></i> View playerProfile
                         </a>
                         </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>



<script type="text/javascript">
// $(document).ready(function () {
//     getView();
//     closeModel();
// });

function getView() {
    jQuery.ajax({
        type: "GET",
        url: "{{ route('admin-player-view') }}",
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
     $('#modal-lg').modal('hide');
     $("#playerProfile").modal("hide");
}

function getPlayerDetails(id){
    $('#playerProfile').modal('show');
    alert("Player ID : "+id);
    jQuery.ajax({
        type: "GET",
        url: "/admin/player-details/"+id,
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
        url: "/admin/player-delete/"+id,
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

function editPlayer(id){
    document.getElementById('form').reset();
    $("#hidden_id").val("")
    $("#submitBtn").html("Update");
    $('#modal-lg').modal('show');

    jQuery.ajax({
        type: "GET",
        url: "/admin/player-edit/"+id,
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
        url: "{{ route('admin-player-save') }}",
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
