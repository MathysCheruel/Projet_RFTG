@extends('layouts.app')

@section('content')
<div class="film-details">
    <h1>{{ $films->title }}</h1>
    <p><strong>Dernière mise à jour :</strong> {{ $films->last_update }}</p>
    <p><strong>Année :</strong> {{ $films->epoque }}</p>
    <p><strong>Genre :</strong> {{ $films->genre }}</p>
</div>
<a href="{{ route('films.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection
