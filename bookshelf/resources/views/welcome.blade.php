@extends('layouts.main')

@section('title', 'Bookshelf Livros')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um livro</h1>
    <form action="/" method="get">
        <div style="display:flex">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
        <button type="submit"><ion-icon name="search"></ion-icon></button>
        </div>
    </form>
</div>

<div id="livros-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Nosso catálogo:</h2>
    <p class="subtitle">Veja os livros disponíveis</p>
    @endif
    <div id="cards-container" class="row">
    @foreach($livros as $livro)
        <div class="card col-md-3">
            <div class="image-container-welcome">
            <img src="/img/livros/{{$livro->image}} " alt="{{ $livro->titulo }} ">
            </div>
            <div class="card-body">
                <div class="card-date">{{ date('d/m/Y', strtotime($livro->data_publicacao)) }}</div>
                <h5 class="card-title">{{ $livro->titulo }}</h5>
                <p class="card-participants" id="livro-autor">{{ $livro->autor }}</p>
                <p class="card-participants">{{ count($livro->users) }} Empréstimos</p>
                <a href="/livros/{{$livro->id}}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
    @endforeach

        @if(count($livros) == 0 && $search)
            <p>Não foi possível encontrar nenhum livro com {{ $search }}! <br><a href="/">Ver todos</a></p>
        @elseif(count($livros) == 0)
            <p>Não há livros disponíveis</p>
        @endif

    @if(count($livro->users)>=1)
        <br><br>
        <h4 id="title-mais-emprestados">Mais emprestados:</h4>
        <p class="subtitle">Livros que a galera mais gosta:</p>
        <div id="cards-container" class="row">
        @foreach($livros as $livro)
            <div class="card col-md-3">
                <div class="image-container-welcome">
                <img src="/img/livros/{{$livro->image}} " alt="{{ $livro->titulo }} ">
                </div>
                <div class="card-body">
                    <div class="card-date">{{ date('d/m/Y', strtotime($livro->data_publicacao)) }}</div>
                    <h5 class="card-title">{{ $livro->titulo }}</h5>
                    <p class="card-participants" id="livro-autor">{{ $livro->autor }}</p>
                    <p class="card-participants">{{ count($livro->users) }} Empréstimos</p>
                    <a href="/livros/{{$livro->id}}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
    @endif

    </div>
</div>

@endsection
