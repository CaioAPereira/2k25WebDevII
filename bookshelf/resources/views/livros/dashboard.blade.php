@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus livros</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-livros-container">
    @if(count($livros) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/livros/{{ $livro->id }}">{{ $livro->title }}</a></td>
                    <td>{{ count($livro->users) }}</td>
                    <td>
                        <a href="/livros/edit/{{ $livro->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                        <form action="/livros/{{ $livro->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você ainda não tem livroos, <a href="/livros/create">criar livroo</a></p>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Livros que emprestei</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-livros-container">
@if(count($livrosasparticipant) > 0)
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Participantes</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($livrosasparticipant as $livro)
            <tr>
                <td scropt="row">{{ $loop->index + 1 }}</td>
                <td><a href="/livros/{{ $livro->id }}">{{ $livro->title }}</a></td>
                <td>{{ count($livro->users) }}</td>
                <td>
                    <form action="/livros/leave/{{ $livro->id }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon>
                            Sair do livroo
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Você ainda não possui nenhum livro, <a href="/">Veja todos os livros</a></p>
@endif
</div>
@endsection
