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
                                   <h3 class="card-title">{{ (strtoupper($data['title'])) }}</h3>
                              </div>
                              <div class="card-body">
                                   <div class="row">
                                        <div id="printArea" class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                                             <div class="card bg-light d-flex flex-fill">
                                                  <div class="card-header py-3 bg-info">
                                                       <h1 class="text-uppercase text-center" style="color: rgb(13, 13, 128)">{{ $team->team_name }}</h1>
                                                  </div>
                                                  <div class="card-body">
                                                       <div class="text-center text-muted border-bottom-0">
                                                            FOOTBALL
                                                       </div>
                                                       <div class="row p-4">
                                                            <div class="col-md-8 col-sm-12">
                                                                 <h5 class="text-muted mb-3"><i style="font-size:17px;" class="mr-2 fas fa-lg fa-building"></i><b class="text-uppercase mr-2">Certificate: </b> {{ $team->registration_certificate }} </h5>
                                                                 <h5 class="text-muted mb-3"><i style="font-size:17px;" class="mr-2 fas fa-lg fa-building"></i><b class="text-uppercase mr-2">Year Founded: </b> {{ \Carbon\Carbon::parse($team->founded_year)->format('d-m-Y') }} </h5>
                                                                 <h5 class="text-muted mb-3"><i style="font-size:17px;" class="mr-2 fas fa-lg fa-building"></i><b class="text-uppercase mr-2">Registration Number: </b> {{ $team->registration_number }} </h5>
                                                                 <h5 class="text-muted mb-3"><i style="font-size:17px;" class="mr-2 fas fa-lg fa-building"></i><b class="text-uppercase mr-2">Email Address: </b> {{ $team->team_email }} </h5>
                                                                 <h5 class="text-muted mb-3"><i style="font-size:17px;" class="mr-2 fas fa-lg fa-building"></i><b class="text-uppercase mr-2">Phone Number: </b> {{ $team->team_number }} </h5>
                                                                 <h5 class="text-muted mb-3"><i style="font-size:17px;" class="mr-2 fas fa-lg fa-building"></i><b class="text-uppercase mr-2">Region/City: </b> {{ $team->city }} </h5>
                                                                 <h5 class="text-muted mb-3"><i style="font-size:17px;" class="mr-2 fas fa-lg fa-building"></i><b class="text-uppercase mr-2">Location: </b> {{ $team->team_address }} </h5>
                                                                 <h5 class="text-muted mb-3"><i style="font-size:17px;" class="mr-2 fas fa-lg fa-building"></i><b class="text-uppercase mr-2">Home Stadium: </b> {{ $team->stadium }} </h5>
                                                                 <p class="py-3">TOTAL PLAYERS REGISTERED: </p><hr>
                                                                 <div class="mt-3">
                                                                      <h6>{!! DNS1D::getBarcodeHTML($team->id, 'C39') !!}</h6>
                                                                      <p>{{ $team->registration_number }}</p>
                                                                 </div>                                                            
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 text-center p-3">
                                                                 <img src="{{ url('assets/ball2.jpg') }}" alt="user-avatar" class="img-circle img-fluid">
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-footer">
                                   <div class="text-right">
                                        <a href="{{  route('admin-user-list') }}" title="Back" class="btn btn-sm btn-secondary">
                                             <i class="fas fa-times px-3"></i>
                                        </a>
                                        <a href="#" onclick="return printTeamDetails('printArea')" title="Print" class="btn btn-sm btn-primary">
                                             <i class="fas fa-print px-3"></i>
                                        </a>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </section>
</div>


<script type="text/javascript">

function printTeamDetails(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

</script>
@endsection
