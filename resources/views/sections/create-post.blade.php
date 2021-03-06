@extends('layouts.dashboard')

@section('title', 'Nueva noticia')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <!--  noticias Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Agregar noticia</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <!--  title Form Field  -->
                            <div class="form-group col-sm-6 {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Título</label>
                                <input id="title"
                                       name="title"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('title') }}"
                                       placeholder="Título de la noticia.">
                                @if($errors->has('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <!--  image Form Field  -->
                            <div class="form-group col-sm-6 {{ $errors->has('image') ? 'has-error' : '' }}">
                                <label for="image">Imágen</label>
                                <input id="image"
                                       name="image"
                                       type="file"
                                       class="form-control"
                                       placeholder="Imágen de la noticia.">
                                @if($errors->has('image'))
                                    <span class="help-block">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">Descripción</label>
                                <input class="form-control"
                                          name="description"
                                          id="description"
                                          value="{{ old('description') }}"
                                          placeholder="Breve resúmen de la noticia.">
                                @if($errors->has('description'))
                                    <span class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-12 {{ $errors->has('content') ? 'has-error' : '' }}">
                                <label for="content">Contenido</label>
                                <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Contenido que deseas que tenga la noticia.">{{ old('content') }}</textarea>
                                @if($errors->has('content'))
                                    <span class="help-block">{{ $errors->first('content') }}</span>
                                @else
                                    <span class="help-block">Para dar formato al texto, usa <a target="_blank" href="https://markdown.es/sintaxis-markdown/">Markdown</a>.</span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Guardar y publicar</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection