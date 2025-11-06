
<table class="table table-striped" id="table-1">
     <thead>
          <tr>
               <th>SN</th>
               <th>Logo</th>
               <th>Team Name</th>
               <th>Registration No.</th>
               <th>Certificate</th>
               <th>Address</th>
               <th>City</th>
               <th>Stadium</th>
               <th>Founded</th>
               <th>Status</th>
               <th>Action</th>
          </tr>
     </thead>
     {{-- <tbody>
          @php $n=1; @endphp
          @foreach ($team as $item)              
          <tr>
               <td> {{ $n; }}</td>
               <td> 
                    <figure>
                         {{ $item->logo }}
                         <img alt="image" src="{{ url('assets/avatar.jpg') }}" class="avatar avatar-lg" width="40">
                    </figure>
               </td>
               <td><b>{{ $item->team_name }}</b></td>
               <td>{{ $item->registration_number }}</td>
               <td>{{ $item->registration_certificate }}</td>
               <td> 
                    <a href="mailto:{{ $item->team_email }}" class="text-dark">{{ $item->team_email }}</a><br>
                    <p><a href="tel:{{ $item->team_number }}" class="text-dark">{{ $item->team_number }}</a></p>
               </td>
               <td>{{ $item->city }}</td>
               <td>{{ $item->stadium }}</td>
               <td>{{ \Carbon\Carbon::parse($item->founded_year)->format('d-m-Y') }}</td>
               <td class="align-middle">
                    @if ($item->status == 'active')
                    <span class="badge badge-success badge-shadow">Active</span>
                    @else
                    <span class="badge badge-default badge-shadow">Inactive</span>
                    @endif
               </td>
               <td>
                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                         <button type="button" class="btn btn-dark" title="Print" onclick="printTeamDetails({{$item->id}}"><i class="fas fa-print"></i></button>
                         <button type="button" class="btn btn-warning" title="Edit" onclick="editTeamDetails({{$item->id}}"><i class="far fa-edit"></i></button>
                         <button type="button" class="btn btn-danger" title="Delete" onclick="deleteTeamDetails({{$item->id}}"><i class="fa fa-trash"></i></button>
                    </div>
               </td>
          </tr>
          @php $n ++; @endphp
          @endforeach
     </tbody> --}}
</table> 
