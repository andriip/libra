<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>

@extends('app')

@section('content')

    <h1>Edit: {!! $article->title !!}</h1>





     {!! Form::model($article,['method'=>'PATCH', 'action'=>['ArticlesController@update', $article->id]]) !!}

    @include('articles.form', ['submitButtonText'=>'Update Article'])

    {!! Form::close() !!}

    @include('errors.list')


@stop
</body>
</html>