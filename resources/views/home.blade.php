@extends('layouts.app')

@section('content')

    <example-component></example-component>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
        </div>
    </div>
</div>
@endsection
