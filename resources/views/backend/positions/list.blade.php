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
                              <div class="card-body p-0">
                                   <div class="table-responsive">
                                        <div id="getView">
                                             {{-- <img src="{{ url('assets/loader.svg') }}" alt=""> --}}
                                        </div>
                                        <table class="table table-striped table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th>SN</th>
                                                       <th>Position</th>
                                                       <th>Description</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  @php $n=1; @endphp
                                                  @foreach ($positions as $item)              
                                                  <tr>
                                                       <td> {{ $n; }}</td>
                                                       <td><b>{{ $item->position_name }}</b></td>
                                                       <td>{{ $item->position_description }}</td>
                                                       <td class="align-middle">
                                                            @if ($item->status == 'active')
                                                            <span class="badge badge-success badge-shadow">Active</span>
                                                            @else
                                                            <span class="badge badge-warning badge-shadow">Inactive</span>
                                                            @endif
                                                       </td>
                                                       <td>
                                                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                                 <button type="button" class="btn btn-warning" title="Edit" onclick="editPosition({{$item->id}}"><i class="far fa-edit"></i></button>
                                                                 <button type="button" class="btn btn-danger" title="Delete" onclick="deletePosition({{$item->id}}"><i class="fa fa-trash"></i></button>
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
                    <h3 class="modal-title">Position</h3>
                    <strong class="text-danger float-right">Required *</strong>
               </div>
               <div class="modal-body">
                    <form id="form" onsubmit="save(event)" enctype="form-data/multipart">
                         @csrf
                         <input type="hidden" class="form-control" id="hidden_id" name="hidden_id" >
                         <div class="row">
                              <div class="col-md-12 col-sm-12">
                                   <div class="form-group">
                                        <label>Position <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="position" id="position" placeholder="Enter position name" required>
                                   </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                   <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea type="text" name="description" class="form-control" id="description" cols="30" rows="2" placeholder="Enter description"></textarea>
                                   </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                   <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select class="custom-select" name="status" id="status" required>
                                             <option selected="">--Select--</option>
                                             <option value="active">Active</option>
                                             <option value="in_active">Inactive</option>
                                        </select>
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

{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> --}}

<script type="text/javascript">
// $(document).ready(function () {
//     getView();
//     closeModel();
// });

function getView() {
    $.ajax({
        type: "GET",
        url: "{{ route('admin-position-view') }}",
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

function deletePosition(id){
     alert("Delete : "+id);
    var conf = confirm("ARE YOU SURE YOU WANT TO DELETE.?");
    if (!conf) {
        return;
    }

    $.ajax({
        type: "GET",
        url: "/admin/position-delete/"+id,
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

function editPosition(id){
     alert("Edit : "+id);
    document.getElementById('form').reset();
    $("#hidden_id").val("")
    $("#submitBtn").html("Update");
    $('#modal-lg').modal('show');

    $.ajax({
        type: "GET",
        url: "/admin/position-edit/"+id,
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

    $.ajax({
        type: "POST",
        url: "{{ route('admin-position-save') }}",
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
