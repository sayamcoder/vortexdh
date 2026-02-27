@extends('servers.layout')
@section('panel_content')
<div class="flex-1 p-6 overflow-y-auto">
    <server-databases 
        :initial-databases="{{ json_encode($databases) }}" 
        create-route="{{ route('servers.databases.create', $server->id) }}">
    </server-databases>
</div>
@endsection