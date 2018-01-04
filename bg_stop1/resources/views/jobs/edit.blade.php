 @extends('layout.app')

@section('content')
    <h1>Редакция продукт за закупване.</h1>
    {!!Form::open(['action'=>['JobsController@update',$job->id],'method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
    <div class="form-group">
        {{Form::label('name', 'Описание на позицията за работа')}}
        {{Form::text('name', $job->name, ['class'=>'form-control', 'placeholder'=>'Описание на позицията за работа'])}}
    </div>
    <div class="form-group">
        {{Form::label('location' , 'Местоположение')}}
        {{Form::select('location', ['Лондон централен'=>'Лондон централен','Лондон северен'=>'Лондон северен', 'Лондон източен'=>'Лондон източен', 'Лондон южен'=>'Лондон южен', 'Лондон западен'=>'Лондон западен', 'Югоизточна Англия'=>'Югоизточна Англия', 'Югозападна Англия'=>'Югозападна Англия', 'Източна Англия'=>'Източна Англия', 'Източна среда'=>'Източна среда', 'Западна среда'=>'Западна среда', 'Йоркшир и Хъмбър'=>'Йоркшир и Хъмбър', 'Северозападна Англия'=>'Северозападна Англия', 'Североизточна Англия'=>'Североизточна Англия', 'Уелс'=>'Уелс', 'Шотландия'=>'Шотландия', 'Северна Ирландия'=>'Северна Ирландия' ], $job->location, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('category' , 'Категория')}}
        {{Form::select('category', ['Строител'=>'Строител', 'Чистач'=>'Чистач', 'Друго'=>'Друго'], $job->category, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Описание на позицията за работа')}}
        {{Form::textarea('description', $job->description, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Описание на позицията за работа'])}}
    </div>
    <div class="form-group">
        {{Form::label('image', 'Можете да си сложите снимка')}}
        {{Form::file('image')}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Редактирай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection
