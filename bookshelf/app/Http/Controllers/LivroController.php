<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Livro;
use App\Models\User;

class LivroController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $livros = Livro::where([
                ['titulo', 'like', '%' . $search . '%'],
            ])->get();
        } else {
            $livros = Livro::all();
        }

        return view('welcome', ['livros' => $livros, 'search' => $search]);
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        $Livro = new Livro();

        /* Campo no bd = Campo no view */
        $Livro->titulo = $request->titulo;
        $Livro->data_publicacao = $request->data_publicacao;
        $Livro->genero = $request->genero;
        $Livro->autor = $request->autor;
        /* Captura o ID do usuário autenticado para salvar no livro que o cadastrou */
        $Livro->user_id = auth()->user()->id;

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5(
                $requestImage->getClientOriginalName() .
                    strtotime('now') .
                    '.' .
                    $extension
            );

            $requestImage->move(public_path('img/livros'), $imageName);

            $Livro->image = $imageName;
        }

        $Livro->save();

        return redirect('/')->with('msg', 'Livro criado com sucesso!');
    }

    public function show($id)
    {
        $livro = Livro::with('users')->findOrFail($id);
        $donoDoLivro = User::find($livro->user_id);
        $hasUserJoined = false;

        if (auth()->check()) {
            $hasUserJoined = $livro->users->contains(auth()->user());
        }

        return view('livros.show', [
            'livro' => $livro,
            'donoDoLivro' => $donoDoLivro,
            'hasUserJoined' => $hasUserJoined,
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        // Aqui usamos withCount('users') porque o relacionamento no Model Livro se chama 'users'
        $livros = $user->livros()->withCount('users')->get();

        $livrosAsParticipant = $user->livrosAsParticipant;

        return view('livros.dashboard', [
            'livros' => $livros,
            'livrosasparticipant' => $livrosAsParticipant,
        ]);
    }

    public function destroy($id)
    {
        Livro::findOrFail($id)->delete();

        return redirect('/dashboard')->with(
            'msg',
            'Livroo excluído com sucesso!'
        );
    }

    public function edit($id)
    {
        $user = auth()->user();
        $livro = Livro::findOrFail($id);

        // Garante que o usuário só pode editar os próprios livros
        if ($user->id != $livro->user_id) {
            return redirect('/dashboard')->with('msg', 'Acesso negado!');
        }

        // Passa os dados do livro para a view
        return view('livros.edit', ['livro' => $livro]);
    }

    public function update(Request $request, $id)
    {
        // <--- A CORREÇÃO ESTÁ AQUI
        // Validação dos dados recebidos do formulário
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'data_publicacao' => 'required|date',
            'genero' => 'required|string',
            'image' => 'nullable|image', // A imagem é opcional na edição
        ]);

        $data = $request->except('_token', '_method'); // Pega todos os dados, exceto o token e o método

        // Lida com o upload da imagem SE uma nova imagem for enviada
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName =
                md5($requestImage->getClientOriginalName() . strtotime('now')) .
                '.' .
                $extension;
            $requestImage->move(public_path('img/livros'), $imageName);

            // Adiciona o novo nome da imagem aos dados que serão atualizados
            $data['image'] = $imageName;
        }

        // Encontra o livro pelo ID e atualiza com os novos dados
        Livro::findOrFail($id)->update($data);

        return redirect('/dashboard')->with(
            'msg',
            'Livro editado com sucesso!'
        );
    }

    public function emprestarLivro($id)
    {
        $user = auth()->user();
        $livro = Livro::findOrFail($id);
        $user->livrosAsParticipant()->attach($id, ['data_emprestimo' => now()]);
        return redirect('/dashboard')->with(
            'msg',
            'Empréstimo do livro "' . $livro->titulo . '" realizado!'
        );
    }

    public function devolverLivro($id)
    {
        $user = auth()->user();
        $livro = Livro::findOrFail($id);
        $user->livrosAsParticipant()->detach($id);
        return redirect('/dashboard')->with(
            'msg',
            'Você devolveu o livro "' . $livro->titulo . '"!'
        );
    }
}
