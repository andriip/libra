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

    public function getImage()
    {
        $articleTitle = $_GET["title"];
        $input = Request::all();
        $a=rand(1,50);
        $acctKey = 'iXX2NrEp8gfTPvsahjaj2KUAT+E7Quwelff4B6+MDnE';
        $rootUri = 'https://api.datamarket.azure.com/Bing/Search';
        $query = $articleTitle;
        $serviceOp ='Image';
        $market ='en-us';
        $query = urlencode("'$query'");
        $market = urlencode("'$market'");
        $requestUri = "$rootUri/$serviceOp?\$format=json&Query=$query&Market=$market";
        $auth = base64_encode("$acctKey:$acctKey");
        $data = array(
            'http' => array(
                'request_fulluri' => true,
                'ignore_errors' => true,
                'header' => "Authorization: Basic $auth"
            )
        );
        $context = stream_context_create($data);
        $response = file_get_contents($requestUri, 0, $context);
        $response=json_decode($response);
        $response = $response->d->results[$a]->MediaUrl;
        return response()->json(['img' => $response]);
    }

    public function saveImage()
    {
        $articleId = $_GET["articleId"];
        $imageUrl = $_GET["imageUrl"];

        $answer = "Image wasn't saved";

        $article=Article::findOrFail($articleId);
        if($article && $imageUrl!=""){
            $article->image = $imageUrl;
            $article->update();
            $answer = "Image was saved";
        }
        return response()->json(['answer' => $answer]);

    }

}
