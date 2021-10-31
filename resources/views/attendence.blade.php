@extends('vendor')
@section('content')
                <h2>Visitors Record</h2>

                <div class="row" style="width:110% ">
                    <table id="myTable" style="width: 105%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                {{-- @if (Session::get('section_id')==0) --}}
                                <th>Designated Area</th>
                                {{-- @endif --}}
                                <th>Entry Time</th>
                                <th>Exit Time</th>
                                {{-- <th>Document Issue Date</th>
                                <th>Document Expiry Date</th> --}}
                                {{-- <th>Father's Name</th> --}}
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($info as $i)
                            <tr>
                                <td>{{$i->name}}</td>
                                <td>{{$i->email}}</td>
                                <td>{{$i->phone}}</td>
                                <td>{{$i->section_name}}</td>
                                <td>{{$i->entry_time}}</td>
                                <td>{{$i->exit_time}}</td>
                                <td>{{$i->date}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
            <script>
                $(document).ready( function () {
                  $('#myTable').DataTable({
                      order:[[ 6, "desc" ]]
                  });
                } );
            </script>

   @endsection
