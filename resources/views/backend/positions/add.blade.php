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
                                   <form method="POST" action="{{ route('admin-position-save') }}" enctype="multipart/form-data">
                                        @csrf
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
                                        
                                        <div class="card-footer float-right">
                                             <a href="{{ route('admin-position-list') }}" type="button" class="btn btn-secondary">Cancel</a>
                                             <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
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
