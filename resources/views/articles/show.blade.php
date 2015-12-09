@extends('app')

@section('content')


    <h1>{{$article->title}}</h1>

    <hr />

<article>{{$article -> body}}</article>

    <div class="col-md-6">
        <a href="{{ route('articles.index') }}" class="btn btn-info">Back to all articles</a>
        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary">Edit Article</a>
    </div>

    <div class="row">

        <div class="col-md-6 text-right">

            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['articles.destroy', $article->id]
            ]) !!}
            {!! Form::submit('Delete this article?', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>






@stop