@extends('layouts.main')

@section('title', 'Editando: ' . $livro->titulo)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editando: {{ $livro->titulo }}</h1>
  <form action="{{ route('livros.update', $livro->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div id="image-container" class="col-md-6">
        <img src="/img/livros/{{ $livro->image }}" class="img-fluid" alt="{{ $livro->titulo }}">
        <input type="file" id="image" name="image" class="from-control-file">
    </div>
    <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do livro" value="{{ $livro->titulo }}">
    </div>
    <div class="form-group">
      <label for="data_publicacao">Data de publicação:</label>
      <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" value="{{ $livro->data_publicacao->format('Y-m-d') }}">
    </div>
    <div class="form-group">
      <label for="genero">Gênero:</label>
      <input type="text" class="form-control" id="genero" name="genero" placeholder="Nome do gênero do livro" value="{{ $livro->genero }}">
    </div>
    <div class="form-group">
      <label for="autor">Autor:</label>
      <input type="text" class="form-control" id="autor" name="autor" placeholder="Nome do autor do livro" value="{{ $livro->autor }}">
    </div>
    <br>
    <br>
    <input type="submit" class="btn btn-primary" value="Salvar Edição">
  </form>
</div>



@endsection
