@extends('layout.app')
@section('content')
    <div class="col-sm-6">
        <address>
            <div class="alert alert-info">
                Имейл:
                <br>
                <a href="mailto:ianigarfalski@gmail.com">bgstop@gmail.com</a>
            </div>
            <div class="alert alert-info">
                Телефон:
                <br>
                012314141414
            </div>

        </address>
    </div>
<div class="col-sm-6">
{!! Form::open(['action'=>'ContactUsController@store']) !!}
    <div class="form-group">
    {{Form::label('email', 'имейл')}}
    {{Form::text('email', '', ['class'=>'form-control'])}}
    </div>
    <div class="form-group">
    {{Form::label('telephone', 'телефон')}}
    {{Form::number('telephone', '', ['class'=>'form-control'])}}
    </div>
</div>
    <div class="form-group col-sm-12">
        {{Form::label('message', 'Съобщение')}}
        {{Form::textarea('message', '', ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Съобщение'])}}
    </div>
    {{Form::submit('Изпрати', ['class'=>'btn btn-success btn-block'])}}
{!! Form::close() !!}

@endsection