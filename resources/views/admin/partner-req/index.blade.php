@extends('layouts.master-admin')
@section('title')
Admin Dashboard
@endsection
@section('main-content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <strong>{{session('error')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-sm-flex align-items-baseline report-summary-header">
                                    <h3>Partner Requirements For Registration</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row card-header p-0 bg-white" style="border-top: 1px solid">
            <div class="col-md-12 pt-4 grid-margin stretch-card">
                <div class="card" id="bookings-list-table">
                    <div class="container">
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{url('partner-reg-req-save')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City:</label>
                                        <select class="form-control" name="city_id" required>
                                            <option value="">Select City</option>
                                            @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->location_city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Requirement Heading:</label>
                                        <input type="text" name="main_heading" class="form-control" id="req-heading" placeholder="Enter Requirement Heading" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Requirements:(Please Enter requirements comma seprated)</label>
                                        <textarea class="form-control" name="requirements" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>#No</th>
                                            <th>City Name</th>
                                            <th>Main Heading</th>
                                            <th>Requirements</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($city_req)
                                        @foreach($city_req as $req)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$req->location_city}}</td>
                                            <td>{{$req->main_heading}}</td>
                                            <td>
                                                {{$req->requirements}}
                                            </td>
                                            <td>
                                                <span class="fa fa-trash" onclick="deletereq('{{$req->id}}')"></span>
                                                <span class="fa fa-pencil" onclick="editreq('{{json_encode($req)}}')"></span>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Moray-Limousines <i class="fa fa-car text-danger"></i></span>
        </div>
    </footer>
    <!-- partial -->
</div>



<!-- edit  Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{url('partner-reg-req-update')}}">
                    @csrf
                    <input type="hidden" id="editid" name="id" value="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">City:</label>
                        <select class="form-control" id="editcityid" name="city_id" required>
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->location_city}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Requirement Heading:</label>
                        <input type="text" id="editmainheading" name="main_heading" class="form-control" id="req-heading" placeholder="Enter Requirement Heading" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Requirements:(Please Enter requirements comma seprated)</label>
                        <textarea class="form-control" id="editreq" name="requirements" rows="5" required></textarea>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- delete modal -->
<div class="modal" tabindex="-1" role="dialog" id="deletemodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Req</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to delete.</p>
      </div>
      <div class="modal-footer">
        <form method="post" action="{{url('partner-reg-req-delete')}}">
            @csrf
         <input type="hidden" id="deleteid" name="id" value="">
        <button type="submit" class="btn btn-primary">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function editreq(data){
        var data=JSON.parse(data);
        $("#editid").val(data.id);
        $("#editcityid").val(data.city_id);
        $("#editmainheading").val(data.main_heading);
        $("#editreq").val(data.requirements);
        $("#editmodal").modal();
      
    }

    function deletereq(id)
    {
        $("#deleteid").val(id);
        $("#deletemodal").modal();
    }
</script>
@endsection