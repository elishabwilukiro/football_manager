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
                                   <a href="{{ route('admin-player-add') }}" class="btn btn-primary float-right">Add New</a>
                                   @elseif(Auth::user()->role === 'manager')
                                   <a href="{{ route('manager-player-add') }}" class="btn btn-primary float-right">Add New</a>
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
                                                       <th class="text-uppercase">Email</th>
                                                       <th class="text-uppercase">Phone_Number</th>
                                                       <th class="text-uppercase">Registration_No.</th>
                                                       <th class="text-uppercase">Date_Of_Birth</th>
                                                       <th class="text-uppercase">Birth_Reg_No.</th>
                                                       <th class="text-uppercase">Birth_Certificate</th>
                                                       <th class="text-uppercase">Nationality</th>
                                                       <th class="text-uppercase">Region</th>
                                                       <th class="text-uppercase">Location</th>
                                                       <th class="text-uppercase">Registration_Date</th>
                                                       @if(Auth::user()?->role === 'admin')
                                                       <th class="text-uppercase">Team_Name</th>
                                                       @endif
                                                       <th class="text-uppercase">Position</th>
                                                       <th class="text-uppercase">Status</th>
                                                       <th class="text-uppercase">Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  @php $n=1; @endphp
                                                  @forelse ($players as $player)
                                                       <tr>
                                                            <td>{{ $n++; }}</td>
                                                            <td> 
                                                                 <figure>
                                                                      @if(!empty($player->upload))
                                                                           <img alt="logo" src="{{ asset('assets/uploads/' . $player->upload) }}" class="avatar avatar-lg" width="60">                                       
                                                                      @else     
                                                                           <img alt="image" src="{{ url('assets/avatar.jpg') }}" class="avatar avatar-lg" width="60">                                                                                    
                                                                      @endif
                                                                 </figure>
                                                            </td>
                                                            <td>{{ $player->first_name.' '.$player->middle_name.' '.$player->last_name }}</td>
                                                            <td><a href="mailto:{{ $player->email }}" class="">{{ $player->email }}</a></td>
                                                            <td><a href="tel:{{ $player->phone_number }}" class="">{{ $player->phone_number }}</td>
                                                            <td>{{ $player->registration_number }}</td>
                                                            <td>{{ $player->date_of_birth }}</td>
                                                            <td>{{ $player->birth_certificate_no }}</td>
                                                            <td>
                                                                 @if (!empty($player->birth_certificate))
                                                                 <a href="{{ asset('assets/uploads/' . $player->birth_certificate) }}" target="_blank" class="" download>Download file</a>                                                                
                                                                 @else
                                                                 <span class="text-muted">No file</span>                                                          
                                                                 @endif
                                                            </td>
                                                            <td>{{ $player->nationality }}</td>
                                                            <td>{{ $player->region }}</td>
                                                            <td>{{ $player->address }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($player->created_at)->format('d-m-Y') }}</td>
                                                            @if(Auth::user()?->role === 'admin')
                                                            <td>
                                                                 @if($player->team)
                                                                      <a href="{{ route('admin-team-details', Crypt::encrypt($player->team_id)) }}" 
                                                                           class="text-link text-uppercase">
                                                                           {{ $player->team->team_name }}
                                                                      </a>
                                                                 @else
                                                                      <span class="text-muted">N/A</span>
                                                                 @endif
                                                            </td>
                                                            @endif
                                                            <td>
                                                                 <a class="text-link text-uppercase">
                                                                      {{ $player->position->position_name ?? 'N/A' }}
                                                                 </a>
                                                            </td>
                                                            <td>
                                                                 @if ($player->status == 'active')
                                                                 <span class="badge badge-success badge-shadow">Active</span>
                                                                 @else
                                                                 <span class="badge badge-warning badge-shadow">Inactive</span>
                                                                 @endif
                                                            </td>
                                                            <td>
                                                            @if(Auth::user()->role === 'admin')
                                                                 <div class="btn-group btn-group-sm" role="group">
                                                                      <a href="{{ url('admin/player/details/'. Crypt::encrypt($player->id)) }}" class="btn btn-info" title="Edit"><i class="far fa-eye"></i></a>
                                                                      <a href="{{ url('admin/player/edit/'. Crypt::encrypt($player->id)) }}" class="btn btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                                                      <a onclick="return confirm('ARE YOU SURE YOU WANT TO DELETE THE RECORD.?') ? window.location.href='{{ url('admin/player/delete/'. Crypt::encrypt($player->id)) }}':false" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                                 </div>
                                                            @elseif(Auth::user()->role === 'manager')
                                                                 <div class="btn-group btn-group-sm" role="group">
                                                                      <a href="{{ url('manager/player/details/'. Crypt::encrypt($player->id)) }}" class="btn btn-info" title="Edit"><i class="far fa-eye"></i></a>
                                                                      <a href="{{ url('manager/player/edit/'. Crypt::encrypt($player->id)) }}" class="btn btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                                                      <a onclick="return confirm('ARE YOU SURE YOU WANT TO DELETE THE RECORD.?') ? window.location.href='{{ url('manager/player/delete/'. Crypt::encrypt($player->id)) }}':false" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                                 </div>
                                                            @endif                                                                 
                                                            </td>
                                                       </tr>
                                                  @empty
                                                       <tr>
                                                            <td colspan="15" class="text-center text-danger">
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
