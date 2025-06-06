@extends('layouts.main')

@section('title', 'Caio Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="/" method="get">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Próximos Eventos</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{$event->image}} " alt="{{ $event->title }} ">
            <div class="card-body">
                <div class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</div>
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-participants">X Participantes</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi possível encontrar nenhum evento com {{ $search }}! <br><a href="/">Ver todos</a></p>
        @elseif(count($events) == 0)
            <p>Não há eventos disponíveis</p>
        @endif
    </div>
</div>

@endsection




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