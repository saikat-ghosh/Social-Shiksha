@extends('user-app.app-layout.navbar-layout')

@section('breadcrumb')
    <li><a href="{{ route('search') }}">Search<span class="glyphicon glyphicon-chevron-right"></span></a></li></a></li>
    <li><a href="#">Book Ticket</a></li>
@endsection

@section('content')

    <div class="container" id="map-container">

        <div class="row" id="floating-panel">
            <label>Source :</label>
            <input type="text" value="{{$pickup_stop->name}}" disabled>
            <input type="hidden" id="source_lat" value="{{$pickup_stop->latitude}}">
            <input type="hidden" id="source_long" value="{{$pickup_stop->longitude}}">
            <label>Destination :</label>
            <input type="text" value="{{$drop_stop->name}}" disabled>
            <input type="hidden" id="dest_lat" value="{{$drop_stop->latitude}}">
            <input type="hidden" id="dest_long" value="{{$drop_stop->longitude}}">
        </div>

        <div id="map" class="col-md-8">
            <!-- Map goes here! -->
        </div>

        <!-- List of Available Buses goes here! -->
        <div class="col-md-4 padding">
            <label class="font-2 small-font">Available Bus Routes :</label>
            <hr>
            <table class="table table-responsive" id="myTable">
                <thead>
                    <tr>
                        <th>Route Name</th>
                        <th>Estimated Travel Time</th>
                        <th>Average Route Rating</th>
                        @if(!empty($pricing))
                            <th>Price</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="table-striped">
                @foreach($route_travel_times as $id => $time)
                    <tr onclick="">
                        <td><a title="Click to book tickets!" onclick="showRoute($(this))"  data-toggle="modal" data-target="#book-tickets"><b>{{ $route_names[$id] }}</b></a></td>
                        <td class="font-2 xs-small-font">{{ ceil($time) }} Min.</td>
                        <td><strong>{{ round($ratings[$id],2) }}</strong></td>
                        @if(!empty($pricing))
                            <td><strong>{{ $pricing[$id] }}</strong></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for booking Tickets -->
    <div id="book-tickets" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="modal-close btn pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span></button>
                    <h4><span class="glyphicon glyphicon-headphones"></span> Book Tickets</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="{{ action('BookingController@bookTicket') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <label for="clg">How many seats :</label>
                            </div>
                            <div class="col-sm-3">
                                <select id="clg" name="seats" class="pull-right fixed-size-select-box">
                                    @for($i=1;$i<=5;$i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="route_name">Selected Route :</label>
                            </div>
                            <div class="col-sm-6">
                                <input id="route_name" type="text" name="route_name" class="fixed-size-select-box" readonly>
                            </div>
                        </div>
                        <input type="hidden" name="dateHour" value="{{$dateHour}}">
                        <input type="hidden" name="travel_distance" value="{{$travel_distance}}">
                        <input type="hidden" name="pickup_stop" value="{{$pickup_stop->name}}">
                        <input type="hidden" name="drop_stop" value="{{$drop_stop->name}}">
                        <div>
                            <button type="submit" class="btn btn-block btn-theme">Book
                                <span class="glyphicon glyphicon-send"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')

@endpush

@push('js')

    <script>

        var all_routes_waypoints = {!! json_encode($route_waypoints) !!}
        var waypoints= [];

        function initMap() {

            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: 22.5948, lng: 88.3869}
            });
            directionsDisplay.setMap(map);

            /* Display the Route between source & destination */
            calculateAndDisplayRoute(directionsService, directionsDisplay);

            document.addEventListener('routeChange', function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            });

        }

        function showRoute(link){
            var route_name = link.text();
            waypoints = [];
            var route_waypoints = all_routes_waypoints[route_name];
            var length = route_waypoints.length;

            for(var i=0; i<length; i++) {
                var lat = route_waypoints[i].lat;
                var long = route_waypoints[i].long;
                var waypoint = {
                    location: new google.maps.LatLng(lat,long),
                    stopover: false
                };
                waypoints.push(waypoint);
            }

            $("#route_name").val(route_name);
            var event = new CustomEvent('routeChange');
            document.dispatchEvent(event);
            //console.log(waypoints);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {

            var lat1 = document.getElementById('source_lat').value;
            var long1 = document.getElementById('source_long').value;

            var myLatLng1 = new google.maps.LatLng(lat1,long1);

            var lat2 = document.getElementById('dest_lat').value;
            var long2 = document.getElementById('dest_long').value;

            var myLatLng2 = new google.maps.LatLng(lat2,long2);

            directionsService.route({
                origin: myLatLng1,
                destination: myLatLng2,
                travelMode: 'DRIVING',
                waypoints: waypoints,
                provideRouteAlternatives: true
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });

        }


    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBkg9PCZHckEDYfonI94v0-74d3cK1fOM&callback=initMap">
    </script>

@endpush

