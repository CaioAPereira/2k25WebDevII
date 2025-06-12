@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

{{-- Tabela 1: Meus Livros (os que eu criei) --}}
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Livros</h1>
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
                    {{-- CORRIGIDO: typo "scropt" para "scope" --}}
                    <th scope="row">{{ $loop->index + 1 }}</th>

                    {{-- CORRIGIDO: usando ->titulo em vez de ->title --}}
                    <td><a href="/livros/{{ $livro->id }}">{{ $livro->titulo }}</a></td>

                    {{-- CORRIGIDO: Usando a contagem eficiente 'users_count' que vem do controller --}}
                    <td>{{ $livro->users_count }}</td>

                    <td>
                        <a href="/livros/edit/{{ $livro->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                        {{-- Adicionado style="display:inline;" para os botões ficarem na mesma linha --}}
                        <form action="/livros/{{ $livro->id }}" method="POST" style="display:inline;">
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
    <p>Você ainda não cadastrou livros. <a href="/livros/create">Criar um livro</a></p>
    @endif
</div>

{{-- Tabela 2: Livros que emprestei (que eu participo) --}}
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
            <th scope="col">Data do Empréstimo</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($livrosasparticipant as $livro)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td><a href="/livros/{{ $livro->id }}">{{ $livro->titulo }}</a></td>
                <td>{{ $livro->pivot->data_emprestimo->format('d/m/Y') }}</td>
                <td>
                    <form action="{{ route('livros.devolver', $livro->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon> Devolver
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Você ainda não pegou nenhum livro emprestado. <a href="/">Veja todos os livros</a></p>
@endif
</div>
@endsection
