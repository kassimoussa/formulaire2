@extends('admin.app', ['page' => 'Liste des clients', 'pageSlug' => 'admin'])
@section('content')
    <div class="conainer">
        
        <livewire:gestion-client  />

    </div>
@endsection
