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
            <p class="livro-owner"><ion-icon name="play"></ion-icon> Dono(a): {{ $donoDoLivro->name }}</p>
            <p class="livro-participants"><ion-icon name="play"></ion-icon> {{ $livro->users->count() }} Empréstimos</p>
            <p class="event-city"><ion-icon name="play"></ion-icon> {{ $livro->autor }}</p>
                {{-- <p class="events-participants"><ion-icon name="play"></ion-icon></ion-icon> {{ count($livros->users) }} Emprestimos</p> --}}
                <p class="event-city"><ion-icon name="play"></ion-icon> {{ $livro->genero }}</p>
                <p class="event-city">
                    <ion-icon name="play"></ion-icon>
                    {{ $livro->data_publicacao->format('d/m/Y') }}
                </p>

            @if(auth()->check())
                @if(auth()->user()->id == $donoDoLivro->id)
                <br>
                    <p class="already-joined-msg"><b>Você é o dono deste livro.</b></p>
                @elseif($hasUserJoined)
                    <p class="already-joined-msg">Você já pegou este livro emprestado!</p>
                @else
                    <form action="{{ route('livros.emprestar', $livro->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Pegar Emprestado</button>
                    </form>
                @endif
            @else
                 <p>Você precisa <a href="/login">fazer login</a> para interagir.</p>
            @endif

        </div>
    </div>
</div>

@endsection
