@extends('servers.layout')

@section('panel_content')
<div class="flex-1 p-6 overflow-y-auto">
    <!-- Vue Component Mount Point -->
    <server-schedules :initial-schedules="{{ json_encode($schedules) }}"></server-schedules>
</div>
@endsection