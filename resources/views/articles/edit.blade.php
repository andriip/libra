<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>

{{--@extends('app')--}}

@section('content')

    <h1>Edit: {!! $article->title !!}</h1>

    <div id="imageHolder">



    </div>
    <button id="getimgButt">Search image</button>
    <button id="saveimgButt">Insert image</button>


     {!! Form::model($article,['method'=>'PATCH', 'action'=>['ArticlesController@update', $article->id]]) !!}
    <img src="{{$article->image}}" width='100' height='100'/>
    @include('articles.form', ['submitButtonText'=>'Update Article'])

    {!! Form::close() !!}

    @include('errors.list')

    <script>
        $(document).ready(function(){
            $("#getimgButt").click(function(){
                $.ajax({
                    method:"GET",
                    data:{title: "{{$article->title}}"},
                    url:"{{url('articles/getImage')}}",
                }).done(function(data){
                    console.log(data.img);
                    $("#imageHolder").html("<img width='100' height='100' src=" + data.img + " />");
                    $("#imageInput").val(data.img);
                });});
                $("#saveimgButt").click(function(){
                    $.ajax({
                        method:"GET",
                        data:{articleId: "{{$article->id}}", imageUrl: $("#imageInput").val()},
                        url:"{{url('articles/saveImage')}}",
                    }).done(function(data){
                        alert(data.answer);
                    });
            });
        });
    </script>
@stop
</body>
</html>