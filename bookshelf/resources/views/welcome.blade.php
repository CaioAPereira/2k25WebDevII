@extends('layouts.main')

<<<<<<< HEAD
@section('title', 'Caio Events')
=======
@section('title', 'Caio livros')
>>>>>>> 98d9e50 (bookshelf v1.0.0)

@section('content')

<div id="search-container" class="col-md-12">
<<<<<<< HEAD
    <h1>Busque um evento</h1>
    <form action="">
=======
    <h1>Busque um livro:</h1>
    <form action="/" method="get">
>>>>>>> 98d9e50 (bookshelf v1.0.0)
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>

<<<<<<< HEAD
<div id="events-container" class="col-md-12">
    <h2>Próximos Eventos</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{$event->image}} " alt="{{ $event->title }} ">
            <div class="card-body">
                <div class="card-date">10/09/2020</div>
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-participants">X Participantes</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
=======
<div id="livros-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Nosso catálogo:</h2>
    <p class="subtitle">Veja os livros disponíveis</p>
    @endif
    <div id="cards-container" class="row">{{-- @foreach($livros as $livro)
        <div class="card col-md-3">
            <img src="/img/livros/{{$livro->image}} " alt="{{ $livro->title }} ">
            <div class="card-body">
                <div class="card-date">{{ date('d/m/Y', strtotime($livro->date)) }}</div>
                <h5 class="card-title">{{ $livro->title }}</h5>
                <p class="card-participants">X Participantes</p>
                <a href="/livros/{{$livro->id}}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach --}}</div>

        @if(count($livros) == 0 && $search)
            <p>Não foi possível encontrar nenhum livro com {{ $search }}! <br><a href="/">Ver todos</a></p>
        @elseif(count($livros) == 0)
            <p>Não há livros disponíveis</p>
        @endif
>>>>>>> 98d9e50 (bookshelf v1.0.0)
    </div>
</div>

@endsection
<<<<<<< HEAD




{{-- Comentario no Blade


@foreach($events as $event)
<p>{{$event->title}} -- {{$event->description}} </p>
@endforeach
@if (10 > 5)
<p class="">A condição é true</p>
<p>{{ $nome }}</p>
@endif


@for ($i = 0; $i < count($arr); $i++)
    <p>{{ $arr[$i] }} </p>
    @endfor

    @foreach ($nomes as $nome)
    <p>{{ $loop->index }} </p>
    <p>{{ $nome }} </p>
    @endforeach

    @php
    $name = 'Libero';
    echo $name;
    @endphp
    --}}
=======
>>>>>>> 98d9e50 (bookshelf v1.0.0)
