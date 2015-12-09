@extends('app')

@section('content')

<h1>Articles</h1>
    @foreach($articles as $article)
        <h3>{{ $article->title }}</h3>
        <p>{{ $article->body}}</p>
        <p>
            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info">View Article</a>
            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary">Edit Article</a>
        </p>
        <hr>
    @endforeach

    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('articles.create') }}" class="btn btn-info">Create new Article</a>
        </div>
    </div>
@stop