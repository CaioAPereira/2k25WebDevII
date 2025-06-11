@extends('layouts.main')

@section('title', $livro->titulo)

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/livros/{{ $livro->image }}" class="img-fluid" alt="{{ $livro->titulo }}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $livro->titulo }}</h1>
                <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{ $livro->autor }}</p>
                {{-- <p class="events-participants"><ion-icon name="people-outline"></ion-icon> {{ count($livros->users) }} Emprestimos</p> --}}
                <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{ $livro->genero }}</p>
                <p class="event-city">
                    <ion-icon name="calendar-outline"></ion-icon>
                    {{ $livro->data_publicacao->format('d/m/Y') }}
                </p>

            </div>
            <div class="col-md-12" id="description-container">
            </div>
        </div>

    @endsection
