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
                              </div>
                              <div class="card-body">
                                   <form method="POST" enctype="form-data/multipart">
                                        {{ csrf_field() }}
                                        <div class="row">
                                             <div class="col-md-12 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Position <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" name="position" id="position" value="{{ old('position_name', $position->position_name) }}" placeholder="Enter position name" required>
                                                       <span class="text-danger">{{ $errors->first('position_name') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-12 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Description <span class="text-danger">*</span></label>
                                                       <textarea type="text" name="description" class="form-control" id="description" cols="30" rows="2" placeholder="Enter description">{{ old('position_description', $position->position_description) }}</textarea>
                                                       <span class="text-danger">{{ $errors->first('position_description') }}</span>
                                                  </div>
                                             </div>
                                             <div class="col-md-12 col-sm-12">
                                                  <div class="form-group">
                                                       <label>Status <span class="text-danger">*</span></label>
                                                       <select class="custom-select" name="status" id="status" required>
                                                            <option selected="">--Select--</option>
                                                            <option value="active" {{ old('status',$position->status == 'active') ? 'selected' : '' }}>Active</option>
                                                            <option value="in_active" {{ old('status',$position->status == 'in_active') ? 'selected' : '' }}>Inactive</option>
                                                       </select>
                                                  </div>
                                             </div>
                                        </div>                       
                                        
                                        <div class="modal-footer float-right">
                                             @if(Auth::user()->role === 'admin')
                                             <a href="{{ route('admin-position-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             @elseif(Auth::user()->role === 'manager')
                                             <a href="{{ route('manager-position-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             @endif
                                             <button type="submit" class="btn btn-primary">Update changes</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </section>
</div>


@endsection
