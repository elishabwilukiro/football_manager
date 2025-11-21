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
                                   @if(Auth::user()->role === 'admin')
                                   <a href="{{ route('admin-user-add') }}" class="btn btn-primary float-right">Add New</a>
                                   @elseif(Auth::user()->role === 'manager')
                                   <a href="{{ route('manager-user-add') }}" class="btn btn-primary float-right">Add New</a>
                                   @endif
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th class="text-uppercase">SN</th>
                                                       <th class="text-uppercase">Photo</th>
                                                       <th class="text-uppercase">Full_Name</th>
                                                       <th class="text-uppercase">Username</th>
                                                       <th class="text-uppercase">Email</th>
                                                       <th class="text-uppercase">Phone_Number</th>
                                                       <th class="text-uppercase">Location</th>
                                                       <th class="text-uppercase">Role</th>
                                                       <th class="text-uppercase">Team</th>
                                                       <th class="text-uppercase">Status</th>
                                                       <th class="text-uppercase">Action</th>
                                                  </tr>
                                             </thead> 
                                             <tbody>
                                                  @php $n=1; @endphp
                                                  @forelse ($user as $item) 
                                                  <tr>
                                                       <td> {{ $n++; }}</td>
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
                                                            <a href="{{ url('admin/team/details/'. Crypt::encrypt($item->team_id)) }}" class="text-link text-uppercase">
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
                                                                 {{-- <a href="{{ url('admin/user/details/'. Crypt::encrypt($item->id)) }}" class="btn btn-info" title="Edit"><i class="far fa-eye"></i></a> --}}
                                                                 <a href="{{ url('admin/user/edit/'. Crypt::encrypt($item->id)) }}" class="btn btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                                                 <a onclick="return confirm('ARE YOU SURE YOU WANT TO DELETE THE RECORD.?') ? window.location.href='{{ url('admin/user/delete/'. Crypt::encrypt($item->id)) }}' : false" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                       </td>
                                                  </tr>
                                                  @empty
                                                       <tr>
                                                            <td colspan="11" class="text-center text-danger">
                                                                 No data available
                                                            </td>
                                                       </tr>
                                                  @php $n ++; @endphp
                                                  @endforelse
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
