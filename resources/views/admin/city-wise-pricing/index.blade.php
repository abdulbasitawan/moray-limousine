@extends('layouts.master-admin')
@section('title')
    Driver Details
@endsection
@section('css')
@endsection
@section('main-content')

    <div class="main-panel">
        <div class="content-wrapper pt-0 bg-white">
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
        <div class="card-header text-center pt-3 mt-2">
            <h4>City Wise Price</h4>
        </div>
        <div class="card-body pt-0 pb-0">
            <form method="post" action="{{route('admin.save.city.price')}}" validate="true">
                <div class="row pt-3">
                    <input type="hidden" name="edit_id" id="edit_id1" value="{{null}}">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-group validate">
                            <label for="default_location"> Add Locations : </label>
                            <input id="default_location" type="text" required maxlength="120" name="default_location" placeholder="Default Location" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group validate">
                            <label for="country">City : </label>
                            <input id="city" type="text" readonly required maxlength="50" name="location_city" placeholder="City" class="form-control">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group validate">
                            <label for="type">Pricing Type: </label>
                            <select name="type" id="type" class="form-control" style="height: 50px">
                                <option value="fixed">Fixed</option>
                                <option value="hour">Hour</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group validate">
                            <label for="price">Category: </label>
                            <select name="category" class="form-control" id="category" style="height: 50px">
                                @foreach($vehicleCategories as $cat)
                                <option>{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group validate">
                            <label for="price">Price%: </label>
                            <input  type="number" required  name="price" id="price" placeholder="price" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4  p-0">
                        <div class="form-group">
                            <div class="button">
                                <div class="pull-right mt-4">
                                    <button type="button" class="btn btn-danger btn-sm cancel-edit1"><i class="fa fa-times"></i></button>
                                    <button type="submit" class="btn btn-dark" id="create_btn1"><i class="fa fa-save pr-2"></i> Save City</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <div class="heading text-center card-footer mt-3 border border-top">
            <h2 class="text-uppercase">City Price List</h2>
        </div>
         <table id="datatable-buttons1" class="table table-striped dt-responsive nowrap w-100">
            <thead class="thead-dark">
            <tr>
                <th>City</th>
                 <th>Type</th>
                 <th>Category</th>
                 <th>Price</th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            @if(count($city) > 0)
                @foreach($city as $ct)
                    <tr>
                        <td class="py-1">
                            {{$ct->city}}
                        </td>
                        <td class="py-1">
                            {{$ct->type}}
                        </td>
                        <td class="py-1">{{$ct->category}}</td>
                        <td class="py-1">{{$ct->price}}</td>

                        <td>
                            <div class="btn-group p-0" style="font-size: 1.6rem;">
                                <a id="{{$ct->id}}" title="Edit" href="#"  class="p-1 edit-document1" style="cursor: pointer">
                                    <i class="fa fa-edit"></i></a>
                                   
                                <a id="{{$ct->id}}"  title="Delete" href="{{url('admin/delete-city-price/')}}/{{$ct->id}}" class="p-1 text-dark"  style="cursor: pointer"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <h2>No Record Found</h2>
            @endif
            </tbody>
        </table>
    
    </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script>
        $(document).ready(function () {
            $('#datatable-buttons1').dataTable({
               responsive : true
            });
            

            let btn_cancel1 = $('.cancel-edit1');
            btn_cancel1.hide();
            

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click' ,'.edit-document1',function ()
            {
                let id = $(this).attr('id');
                editDocument1(id);
                btn_cancel1.show();
            });

            function editDocument1(id){
                $.ajax({
                    type: 'get',
                    url: '{{url('admin/edit-city-price')}}/'+id,
                    success: function (response) {
                        let location = response;
                        console.log(response);
                        $('#edit_id1').val(id);
                        $("#city").val(location.city);
                        $("#type").val(location.type);
                        $("#price").val(location.price);
                        $("#category").val(location.category);
                        $('#create_btn1').html('Update City');

                    }
                });
            }

            btn_cancel1.click(function () {
                onCancelClick1();
                $(this).hide();
            });

            function onCancelClick1() {
                $('#edit_id1').val(null);
                $("#city").val('');
                $("#type").val('');
                $("#price").val('');
                $("#category").val('');
                $('#create_btn1').html('Save City');
            }


        });

        function initMap() {

            let autocomplete_location;
            let input_field = document.getElementById('default_location');
            // geographical location types.
            autocomplete_location = new google.maps.places.Autocomplete(input_field, {types: ['geocode']});
            autocomplete_location.setFields(['geometry']);

            let latitude;
            let longitude;
            let country;

            google.maps.event.addListener(autocomplete_location, 'place_changed', function () {
                let location = autocomplete_location.getPlace();
                latitude = location.geometry.location.lat();
                longitude = location.geometry.location.lng();
                codeLatLng(latitude,longitude);

                function codeLatLng(lat, lng) {

                    var latlng = new google.maps.LatLng(lat, lng);
                    let geocoder = new google.maps.Geocoder;
                    geocoder.geocode({'latLng': latlng}, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            let length = results.length - 1;
                            country = results[length].formatted_address;
                            console.log(results);

                            if (results[1]) {
                                //formatted address
                                //find country name
                                for (var i=0; i<results[0].address_components.length; i++) {
                                    for (var b=0;b<results[0].address_components[i].types.length;b++) {
                                        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                                        if (results[0].address_components[i].types[b] === "administrative_area_level_1") {
                                            state = results[0].address_components[i];
                                            break;
                                        }

                                        if (results[0].address_components[i].types[b] === "locality") {
                                            //this is the object you are looking for
                                            city = results[0].address_components[i];
                                             $('input[name="location_city"]').val(city.long_name);
                                            break;
                                        }
                                    }
                                }
                                
                                
                                $('input[name="location_country"]').val(country);

                            } else {
                                console.log("No results found");
                            }
                        } else {
                            console.log("Geocoder failed due to: " + status);
                        }})}

            });
        }
        
      

    </script>
    <script src="{{asset('js/jquery-simple-validator.min.js')}}"></script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeHpSgm-hy0_G_NC6PynKEYgASntQIi1Y&libraries=places&callback=initMap" async defer></script>
    
@endsection
