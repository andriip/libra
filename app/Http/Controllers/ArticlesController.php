<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class ArticlesController extends Controller
{
    public function index()
    {
        $articles=Article::all();

        return view('articles.index', compact('articles'));
    }


    public function show($id)
    {

        $article=Article::findOrFail($id);

        //dd($article);

        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create') ;
    }


    public function store(ArticleRequest $request)
    {
        Article::create(Request::all());

        return redirect('articles');

    }
    public function edit($id)
    {
        $article=Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    public function update($id, Requests\ArticleRequest $request)
    {
        $article=Article::findOrFail($id);

        $article->update($request->all());

        return redirect('articles');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return redirect()->route('articles.index');
    }
}
