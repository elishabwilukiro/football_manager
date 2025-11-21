@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
     @include('backend.layouts.header')
    <section class="content mt-3">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   <h3 class="card-title">{{ (strtoupper($data['section'])) }}</h3>
                                   <a href="{{ route('admin-user-add') }}" class="btn btn-primary float-right">Add New</a>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th>SN</th>
                                                       <th>Photo</th>
                                                       <th>Full Name</th>
                                                       <th>Username</th>
                                                       <th>Email</th>
                                                       <th>Phone Number</th>
                                                       <th>Location</th>
                                                       <th>Role</th>
                                                       <th>Team</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead> 
                                             <tbody>
                                                  @php $n=1; @endphp
                                                  @foreach ($user as $item) 
                                                  <tr>
                                                       <td> {{ $n; }}</td>
                                                       <td> 
                                                            <figure>
                                                                 @if (!empty($item->photo))
                                                                      <img alt="logo" src="{{ url('uploads/users/' . $item->logo) }}" class="avatar avatar-lg" width="40">                                       
                                                                 @else     
                                                                      <img alt="image" src="{{ url('assets/avatar.jpg') }}" class="avatar avatar-lg" width="40">                                                                                    
                                                                 @endif
                                                            </figure>
                                                       </td>
                                                       <td>{{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}</td>
                                                       <td>{{ $item->username }}</td>
                                                       <td><a href="mailto:{{ $item->email }}" class="text-dark">{{ $item->email }}</a></td>
                                                       <td><a href="tel:{{ $item->phone_number }}" class="text-dark">{{ $item->phone_number }}</a></td>
                                                       <td>{{ $item->location }}</td>
                                                       <td>{{ $item->role }}</td>
                                                       <td>
                                                            <a href="{{ url('admin/team/team-details/'. Crypt::encrypt($item->team_id)) }}" class="text-link text-uppercase">
                                                                 {{ $item->team->team_name ?? 'N/A' }}
                                                            </a>
                                                       </td>
                                                       <td>
                                                            @if ($item->status == 'active')
                                                            <span class="badge badge-success badge-shadow">Active</span>
                                                            @else
                                                            <span class="badge badge-warning badge-shadow">Inactive</span>
                                                            @endif
                                                       </td>
                                                       <td>
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                 <a href="{{ url('admin/user/details/'. Crypt::encrypt($item->id)) }}" class="btn btn-info" title="Edit"><i class="far fa-eye"></i></a>
                                                                 <a href="{{ url('admin/user/edit/'. Crypt::encrypt($item->id)) }}" class="btn btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                                                 <a onclick="return confirm('ARE YOU SURE YOU WANT TO DELETE THE RECORD.?')?window.location. href='{{ url('admin/user/delete/'. Crypt::encrypt($item->id)) }}':false" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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

@endsection
