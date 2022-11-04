@extends('layouts.master')

@section('content')

    <div class="container">
        <div class='col-sm-4 col-xs-12'>
            <div class="card card standardcardbig pad">
                <h2 class="titlecard cardtitle">Projectleden</h2>
                <br>
{{--                shows all the members in the current project--}}
                    @foreach($members as $member)
                        <ul class="">
                            <li class=""><p>{{$member->name}}</p></li>
                        </ul>
                    @endforeach
{{--            invite button--}}
                <button class="btn btn-primary" onclick="openForm()">Leden toevoegen</button>
            </div>
        </div>

{{--    Popup form, new members can be added to the current project--}}
        <div class="form-popup card" id="myForm">
            <form action="/invite" method="post">
                @csrf
                    <label for="email"><b><p>Email: </p></b></label>
                    <input name="project" type="hidden" value="{{$project->id}}">
                    <select name="id" class="selectbox">
                        @foreach($guests as $guest)
                            <option value="{{$guest->id}}">{{$guest->email}}</option>
                        @endforeach
                    </select>
                <button type="submit" class="btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-primary" onclick="closeForm()">Sluiten</button>
            </form>
        </div>
    </div>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>

@endsection
