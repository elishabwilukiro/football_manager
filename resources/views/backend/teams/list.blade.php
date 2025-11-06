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
                                             <thead>
                                                  <tr>
                                                       <th>SN</th>
                                                       <th>Logo</th>
                                                       <th>Team Name</th>
                                                       <th>Registration No.</th>
                                                       <th>Certificate</th>
                                                       <th>Address</th>
                                                       <th>City</th>
                                                       <th>Stadium</th>
                                                       <th>Founded</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  @php $n=1; @endphp
                                                  @foreach ($team as $item)              
                                                  <tr>
                                                       <td> {{ $n; }}</td>
                                                       <td> 
                                                            <figure>
                                                                 {{ $item->logo }}
                                                                 <img alt="image" src="{{ url('assets/avatar.jpg') }}" class="avatar avatar-lg" width="40">
                                                            </figure>
                                                       </td>
                                                       <td><b>{{ $item->team_name }}</b></td>
                                                       <td>{{ $item->registration_number }}</td>
                                                       <td>{{ $item->registration_certificate }}</td>
                                                       <td> 
                                                            <a href="mailto:{{ $item->team_email }}" class="">{{ $item->team_email }}</a><br>
                                                            <a href="tel:{{ $item->team_number }}" class="text-link">{{ $item->team_number }}</a>
                                                       </td>
                                                       <td>{{ $item->city }}</td>
                                                       <td>{{ $item->stadium }}</td>
                                                       <td>{{ \Carbon\Carbon::parse($item->founded_year)->format('d-m-Y') }}</td>
                                                       <td class="align-middle">
                                                            @if ($item->status == 'active')
                                                            <span class="badge badge-success badge-shadow">Active</span>
                                                            @else
                                                            <span class="badge badge-warning badge-shadow">Inactive</span>
                                                            @endif
                                                       </td>
                                                       <td>
                                                            <div class="btn-group" role="group">
                                                                 <button type="button" class="btn btn-info" title="Print" onclick="printTeamDetails({{$item->id}}"><i class="fas fa-eye"></i></button>
                                                                 <button type="button" class="btn btn-warning" title="Edit" onclick="editTeamDetails({{$item->id}}"><i class="far fa-edit"></i></button>
                                                                 <button type="button" class="btn btn-danger" title="Delete" onclick="deleteTeamDetails({{$item->id}}"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                       </td>
                                                  </tr>
                                                  @php $n ++; @endphp
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


<div class="modal fade" id="modal-lg">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h3 class="modal-title">Team</h3>
                    <strong class="text-danger float-right">Required *</strong>
               </div>
               <div class="modal-body">
                    <form id="form" onsubmit="save(event)" enctype="form-data/multipart">
                         @csrf
                         <input type="hidden" class="form-control" id="hidden_id" name="hidden_id" >
                         <div class="row">
                              <div class="col-md-12 col-sm-12">
                                   <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="team_name" id="team_name" placeholder="Enter team name" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="team_email" id="team_email" placeholder="Enter email address" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Enter phone number" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter city / region" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="team_address" id="team_address" placeholder="Enter address / location" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Stadium <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="stadium" id="stadium" placeholder="Enter stadium" required>
                                   </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                   <div class="form-group">
                                        <label>Founded <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="founded_year" id="founded_year" placeholder="Enter founded year" required>
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
                                        <label class="section-title">Logo</label>
                                        <div class="custom-file">
                                             <input type="file" class="custom-file-input" id="logo" name="logo">
                                             <label class="custom-file-label" for="logo">Choose file</label>
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

<script type="text/javascript">
// $(document).ready(function () {
//     getView();
//     closeModel();
// });

function getView() {
    jQuery.ajax({
        type: "GET",
        url: "{{ route('admin-team-view') }}",
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
