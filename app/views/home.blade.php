@extends('layout')

@section('content')

<h1>Home</h1>

{{ Form::open(['role' => 'form']) }}

<div class="form-group {{ $errors->any()?'has-error':'' }}">
    {{ Form::label('name', 'Find your league', ['class' => 'control-label']) }}
    <div class="input-group">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        <span class="input-group-btn">
            {{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
        </span>
    </div>
</div>
{{ Form::close() }}

@stop
