@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Cadastre seu livro:</h1>
  <form action="/livros" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do livro">
    </div>
    <div class="form-group">
      <label for="data_publicacao">Data de publicação:</label>
      <input type="date" class="form-control" id="data_publicacao" name="data_publicacao">
    </div>
    <div class="form-group">
      <label for="genero">Gênero:</label>
      <input type="text" class="form-control" id="genero" name="genero" placeholder="Nome do gênero do livro">
    </div>
    <div class="form-group">
      <label for="autor">Autor:</label>
      <input type="text" class="form-control" id="autor" name="autor" placeholder="Nome do autor do livro">
    </div>
    <br>
    <div class="form-group">
      <label for="image">Imagem do Livro:</label>
      <input type="file" id="image" name="image" class="from-control-file">
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Cadastrar Livro">

  </form>
</div>

@endsection
