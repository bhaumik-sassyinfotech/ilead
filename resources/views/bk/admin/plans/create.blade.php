@extends('layouts.app')

@section('content')
    
	<div>
		<div class="col-md-6 nopadding"><h3 class="page-title">MemberShip Plan</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/') }}">Dashboard</a> > <a href="{{ route('plans.index') }}">MemberShip Plan</a> > Create MemberShip Plan</p></div>
	</div>
	
    {!! Form::open(['method' => 'POST', 'route' => ['plans.store']]) !!}
	
	<div class="new_button">
		<div class="pull-right extra_button">
			{!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
		</div>
		<div class="pull-right extra_button">
			<a href="{{ route('plans.index') }}" class="btn btn-success extra_button" >Back</a>
		</div>
		<div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Create MemberShip Plan
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('price', 'Plan Price (Monthly)', ['class' => 'control-label']) !!}
                    {!! Form::number('priceMon', old('priceMon'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('priceMon'))
                        <p class="help-block">
                            {{ $errors->first('priceMon') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('priceAnual', 'Plan Price Annual', ['class' => 'control-label']) !!}
                    {!! Form::number('priceAnual', old('priceAnual') ,['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('priceAnual'))
                        <p class="help-block">
                            {{ $errors->first('priceAnual') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                    {!! Form::select('status', ['true' => 'Active', 'false' => 'InActive'], old('status'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
	{!! Form::close() !!}
@stop

