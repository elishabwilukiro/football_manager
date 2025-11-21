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
                                   <a href="{{ route('admin-position-add') }}" class="btn btn-primary float-right">Add New</a>
                                   @elseif(Auth::user()->role === 'manager')
                                   <a href="{{ route('manager-position-add') }}" class="btn btn-primary float-right">Add New</a>
                                   @endif
                              </div>
                              <div class="card-body p-0">
                                   <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th class="text-uppercase">SN</th>
                                                       <th class="text-uppercase">Position</th>
                                                       <th class="text-uppercase">Description</th>
                                                       <th class="text-uppercase">Status</th>
                                                       <th class="text-uppercase">Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  @php $n=1; @endphp
                                                  @forelse ($positions as $item)              
                                                  <tr>
                                                       <td> {{ $n++; }}</td>
                                                       <td><b>{{ $item->position_name }}</b></td>
                                                       <td>{{ $item->position_description }}</td>
                                                       <td>
                                                            @if ($item->status == 'active')
                                                            <span class="badge badge-success badge-shadow">Active</span>
                                                            @else
                                                            <span class="badge badge-warning badge-shadow">Inactive</span>
                                                            @endif
                                                       </td>
                                                       <td>
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                 <a href="{{ url('admin/position/edit/'. Crypt::encrypt($item->id)) }}" class="btn btn-warning" title="Edit"><i class="far fa-edit"></i></a>
                                                                 <a onclick="return confirm('ARE YOU SURE YOU WANT TO DELETE THE RECORD.?') ? window.location.href='{{ url('admin/position/delete/'. Crypt::encrypt($item->id)) }}' : false" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                       </td>
                                                  </tr>
                                                  @empty
                                                       <tr>
                                                            <td colspan="5" class="text-center text-danger">
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
