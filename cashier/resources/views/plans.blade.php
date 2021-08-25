@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Subscription Plans') }}</div>

                <div class="card-body">
                    @foreach($plans as $plan)
                    <div style="padding: 10px;">
                        <a href="{{ route('payment', ['plan' => $plan->identifier]) }}"><button type="button" class="btn btn-outline-primary">{{$plan->title}}</button></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection