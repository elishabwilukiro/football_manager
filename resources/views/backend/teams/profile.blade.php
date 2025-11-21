@extends('backend.layouts.app')
<style>
.id-card-container {
     width: 400px;
     background: #ffffff;
     border-radius: 16px;
     box-shadow: 0 4px 12px rgba(0,0,0,0.15);
     overflow: hidden;
     margin-bottom: 30px;
}
.header {
     background: linear-gradient(135deg, #1e3c72, #2a5298);
     color: white;
     text-align: center;
     padding: 18px 0;
}
.header h1 {
     margin: 0;
     font-size: 20px;
     letter-spacing: 1px;
}
.profile-section {
     text-align: center;
     /* padding: 20px; */
     margin-top: 20px;
}
.profile-section img {
     width: 95px;
     height: 95px;
     border-radius: 50%;
     object-fit: cover;
     border: 1px solid #1e3c72;
}
.details {
     padding: 15px 20px;
}
.details h2 {
     margin: 8px 0;
     font-size: 18px;
     color: #1e3c72;
     text-align: center;
}
.detail-item {
     display: flex;
     justify-content: space-between;
     margin: 6px 0;
     font-size: 14px;
}
.barcode {
     text-align: center;
     margin-bottom: 2px;
}
.barcode img,
.barcode h6 {
     width: 75%;
}
.footer2 {
     background: #f7f7f7;
     text-align: center;
     padding: 10px;
     font-size: 12px;
     color: #555;
}
@media print {
    body * {
        visibility: hidden !important;
    }
    #printArea, #printArea * {
        visibility: visible !important;
    }
    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
</style>

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
                              <div class="card-body bg-light">
                                   <!-- Team ID Card -->
                                   <div id="printArea" class="col-md-4 offset-md-4 col-sm-12">
                                        <div class="id-card-container">
                                        <div class="header">
                                             <h1>TEAM ID CARD</h1>
                                        </div>
                                        <div class="profile-section">
                                             @if (!empty($team->logo))
                                             <img src="{{ asset('assets/uploads/' . $team->logo) }}" alt="Logo">                            
                                             @else     
                                             <img src="{{ asset('assets/avatar.jpg') }}" alt="Logo">
                                             @endif
                                        </div>
                                        <div class="details">
                                             <h2>{{ $team->team_name }}</h2>
                                             <div class="detail-item"><strong>Team ID:</strong> {{ $team->registration_number ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong>Founded:</strong> {{ \Carbon\Carbon::parse($team->founded_year)->format('d-m-Y') }}</div>
                                             <div class="detail-item"><strong>Location:</strong> {{ $team->address ?? 'N/A' }}</div>
                                        </div>
                                        <div class="barcode">
                                             <center>{!! DNS1D::getBarcodeHTML($team->id, 'C39') !!}</center>
                                        </div>
                                        <div class="footer2">Official Team Identification</div>
                                   </div>
                              </div>
                              <div class="card-footer">
                                   <div class="text-right">
                                        <a href="{{  route('admin-team-list') }}" title="Back" class="btn btn-sm btn-secondary">
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
function printDetails(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
}


</script>
@endsection
