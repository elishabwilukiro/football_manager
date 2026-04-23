@extends('backend.layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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
     width: 100px;
     height: 100px;
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
     width: 80%;
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
                                   <h3 class="card-title">{{ (strtoupper($data['section'])) }}</h3>
                              </div>
                              <div class="card-body bg-light">
                                   <div id="printArea" class="col-md-4 offset-md-4 col-sm-12">
                                        <div class="id-card-container">
                                        <div class="header">
                                             <h1>PLAYER ID CARD</h1>
                                        </div>
                                        <div class="profile-section">
                                             @if(!empty($player->upload))
                                                  <img alt="Photo" src="{{ asset('assets/uploads/' . $player->upload) }}" class="p-1">                                       
                                             @else     
                                                  <img alt="Photo" src="{{ url('assets/avatar.jpg') }}" class="p-1">                                                                                    
                                             @endif
                                        </div>
                                        <div class="details">
                                             <h2 class="mb-2 fw-bold">{{ $player->first_name.' '.$player->middle_name.' '.$player->last_name }}</h2>
                                             <div class="detail-item"><strong class="text-muted float-right">Registration Number:</strong> {{ $player->registration_number ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong class="text-muted">Birth Certificate No.:</strong> {{ $player->birth_certificate_no ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong class="text-muted">Date of Birth:</strong> {{ \Carbon\Carbon::parse($player->date_of_birth)->format('d-m-Y') }}</div>
                                             <div class="detail-item"><strong class="text-muted">Phone Number:</strong> {{ $player->phone_number ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong class="text-muted">Email Address:</strong> {{ $player->email ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong class="text-muted">Nationality:</strong> {{ $player->nationality ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong class="text-muted">Region:</strong> {{ $player->region ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong class="text-muted">Location:</strong> {{ $player->address ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong class="text-muted">Team Name:</strong> {{ $player->team->team_name ?? 'N/A' }}</div>
                                             <div class="detail-item"><strong class="text-muted">Position:</strong> {{ $player->position->position_name ?? 'N/A' }}</div>
                                        </div>
                                        <div class="barcode">
                                             <center>{!! DNS1D::getBarcodeHTML($player->id, 'C39') !!}</center>
                                        </div>
                                        <div class="footer2">Official Player Identification</div>
                                   </div>
                              </div>
                              <div class="card-footer">
                                   <div class="text-right">
                                        @if(Auth::user()->role === 'admin')
                                        <a href="{{  route('admin-player-list') }}" title="Back" class="btn btn-sm btn-secondary">
                                             <i class="fas fa-times px-3"></i>
                                        </a>
                                        @elseif(Auth::user()->role === 'manager')
                                        <a href="{{  route('manager-player-list') }}" title="Back" class="btn btn-sm btn-secondary">
                                             <i class="fas fa-times px-3"></i>
                                        </a>
                                        @endif
                                        <a href="#" onclick="return printDetails('printArea')" title="Print" class="btn btn-sm btn-primary">
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
// function printDetails(divId) {
//     var printContents = document.getElementById(divId).innerHTML;
//     var originalContents = document.body.innerHTML;
//     document.body.innerHTML = printContents;
//     window.print();
//     document.body.innerHTML = originalContents;
//     location.reload();
// }


function printDetails(elementId) {
    const element = document.getElementById(elementId);

    html2canvas(element, { scale: 3 }).then(canvas => {
        let imageData = canvas.toDataURL("image/png");

        // Open screenshot in new tab
        let win = window.open();
        win.document.write('<img src="' + imageData + '" style="width:100%;">');
        win.document.close();
    });

    return false;
}

</script>
@endsection
