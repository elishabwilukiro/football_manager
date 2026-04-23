@extends('backend.layouts.app')
<style>
img {
     width: 60px;
     height: 60px;
     border-radius: 50%;
     object-fit: cover;
     border: 1px solid #1e3c72;
}
</style>
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
                                   <a href="{{ route('admin-team-add') }}" class="btn btn-primary float-right">Add New</a>
                                   @elseif(Auth::user()->role === 'manager')
                                   <a href="{{ route('manager-team-add') }}" class="btn btn-primary float-right">Add New</a>
                                   @endif
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">                
                                        <table id="example1" class="table table-striped table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th class="text-uppercase">SN</th>
                                                       <th class="text-uppercase">Photo</th>
                                                       <th class="text-uppercase">Team_Name</th>
                                                       <th class="text-uppercase">Email</th>
                                                       <th class="text-uppercase">Phone_Number</th>
                                                       <th class="text-uppercase">Registration_No.</th>
                                                       <th class="text-uppercase">Registration_Certificate</th>
                                                       <th class="text-uppercase">Region</th>
                                                       <th class="text-uppercase">Stadium</th>
                                                       <th class="text-uppercase">Location</th>
                                                       {{-- <th class="text-uppercase">Founded</th> --}}
                                                       <th class="text-uppercase">Status</th>
                                                       <th class="text-uppercase">Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  @php $n=1; @endphp
                                                  @forelse ($team as $item)              
                                                  <tr>
                                                       <td> {{ $n++; }}</td>
                                                       <td> 
                                                            <figure>
                                                                 @if (!empty($item->logo))
                                                                      <img alt="Photo" src="{{ url('uploads/team_uploads/' . $item->logo) }}">                                       
                                                                 @else     
                                                                      <img alt="Photo" src="{{ url('assets/avatar.jpg') }}">                                                                                    
                                                                 @endif
                                                            </figure>
                                                       </td>
                                                       <td><b>{{ $item->team_name }}</b></td>
                                                       <td><a href="mailto:{{ $item->team_email }}" class="">{{ $item->team_email }}</a></td>
                                                       <td><a href="tel:{{ $item->team_number }}" class="text-link">{{ $item->team_number }}</a></td>
                                                       <td>{{ $item->registration_number }}</td>
                                                       <td>
                                                            @if (!empty($item->registration_certificate) && Storage::disk('public')->exists($item->registration_certificate))
                                                            <a href="{{ asset('storage/' . $item->registration_certificate) }}" target="_blank" class="" download>Download file</a>                                                                
                                                            @else
                                                            <span class="text-muted">No file</span>                                                          
                                                            @endif
                                                       </td>
                                                       <td>{{ $item->region }}</td>
                                                       <td>{{ $item->stadium }}</td>
                                                       <td>{{ $item->address }}</td>
                                                       {{-- <td>{{ \Carbon\Carbon::parse($item->founded_year)->format('d-m-Y') }}</td> --}}
                                                       <td>
                                                            @if ($item->status == 'active')
                                                            <span class="badge badge-success badge-shadow">Active</span>
                                                            @else
                                                            <span class="badge badge-warning badge-shadow">Inactive</span>
                                                            @endif
                                                       </td>
                                                       <td>
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                 <a href="{{ url('admin/team/details/'. Crypt::encrypt($item->id)) }}" class="btn btn-info" title="Print"><i class="fas fa-eye"></i></a>
                                                                 <a href="{{ url('admin/team/edit/'. Crypt::encrypt($item->id)) }}" class="btn btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                                                 <a onclick="return confirm('ARE YOU SURE YOU WANT TO DELETE THE RECORD.?') ? window.location.href='{{ url('admin/team/delete/'. Crypt::encrypt($item->id)) }}':false" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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


<script type="text/javascript">
</script>
@endsection
