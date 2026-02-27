@extends('servers.layout')

@section('panel_content')
<div class="flex-1 p-6 flex flex-col h-full overflow-hidden">
    <!-- Pass the websocket credentials from controller to Vue -->
    <server-console :websocket="{{ json_encode($websocket) }}"></server-console>
</div>
@endsection