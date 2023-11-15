@extends('admin.app', ['page' => 'Gesion des utilisateurs', 'pageSlug' => 'users'])
@section('content')
    <div class="conainer">
        
        <livewire:gestion-user  />

    </div>
@endsection