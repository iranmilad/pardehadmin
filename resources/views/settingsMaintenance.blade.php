@extends('layouts.primary')

@section('title', 'تنظمیات')

@section('content')
    <div class="card mt-5 mb-5 mb-xl-10">
        <div class="card-header">
            <h4 class="card-title">
                عملیات پاکسازی
            </h4>
        </div>
        <div class="card-body">
            <div class="mb-10">
                <a href="{{ route('settings.clearAllCategory') }}" class="btn btn-danger">پاک سازی دسته بندی ها</a>
                <a href="{{ route('settings.clearAllAttribute') }}" class="btn btn-danger">پاک سازی ویژگی ها</a>
                <a href="{{ route('settings.clearAllProducts') }}" class="btn btn-danger">پاک کردن محصولات</a>
                <a href="{{ route('settings.holo.deleteJob') }}" class="btn btn-danger">پاک کردن عملیات برنامه ریزی شده</a>
            </div>
        </div>
    </div>
@endsection

@section('script-before')
    <script src="{{ asset('plugins/jalalidatepicker.min.js') }}"></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: {
                    lat: 35.70222474889245,
                    lng: 51.338657483464765
                }
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: 35.70222474889245,
                    lng: 51.338657483464765
                },
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                document.getElementById('location-map').value = marker.getPosition().lat() + ',' + marker
                    .getPosition().lng();
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer>
    </script>
@endsection

@section('scripts')
    <script>
        jalaliDatepicker.startWatch({
            time: true,
            hasSecond: false
        });
    </script>
@endsection
