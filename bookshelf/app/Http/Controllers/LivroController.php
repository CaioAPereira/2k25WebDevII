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
/*
        $user = auth()->user();
        $Livro->user_id = $user->id;
*/
        $Livro->save();

        return redirect('/')->with('msg', 'Livro criado com sucesso!');
    }

    public function show($id)
    {
        $livro = Livro::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        /*
        if ($user) {
            $userlivros = $user->livrosAsParticipant->toArray();

            foreach ($userlivros as $userLivro) {
                if ($userLivro['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }
        */

        return view('livros.show', [
            'livro' => $livro
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        $livros = $user->livros;

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

        $Livro = Livro::findOrFail($id);

        if ($user->id != $Livro->user_id) {
            return redirect('/dashboard');
        }

        return view('livros.edit', ['Livro' => $Livro]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName =
                md5($requestImage->getClientOriginalName() . strtotime('now')) .
                '.' .
                $extension;

            $requestImage->move(public_path('img/livros'), $imageName);

            $data['image'] = $imageName;
        }

        Livro::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with(
            'msg',
            'Livroo editado com sucesso!'
        );
    }

    public function joinLivro($id)
    {
        $user = auth()->user();

        $user->livrosAsParticipant()->attach($id);

        $Livro = Livro::findOrFail($id);

        return redirect('/dashboard')->with(
            'msg',
            'Sua presença está confirmada no Livroo ' . $Livro->title
        );
    }

    public function leaveLivro($id)
    {
        $user = auth()->user();

        $user->livrosAsParticipant()->detach($id);

        $Livro = Livro::findOrFail($id);

        return redirect('/dashboard')->with(
            'msg',
            'Você saiu com sucesso do Livroo: ' . $Livro->title
        );
    }
}
