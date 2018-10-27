@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <app></app>
        </div>
    </div>
</div>
@endsection
<script>
    import ShowMeeting from "../assets/js/components/Meetings/ShowMeeting";
    export default {
        components: {ShowMeeting}
    }
</script>