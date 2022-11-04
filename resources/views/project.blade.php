@extends('layouts.master')

@section('content')

<!-- Nav new project page -->
<div class="container">
    <div class="row cf">
        <div class="col-6">
            <!--        Title -->
            <h1 class="text-backlog">Projects</h1>
            <br>
        </div>
        <div class="col-6 align-right">
            <!--             Button new work item -->
            <button class="btn btn-primary" onclick="openForm()">+Nieuw project</button>
        </div>
    </div>

<!-- form pop up new project page -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-popup card" id="myForm">
                    <form action="/home" method="post" class="form-container card-body">
                        @csrf
                        <div class="form-row ">
                            <div class="form-group col-md-6">
                                <label for="nameproject">Naam project</label>
                                <input type="text" placeholder="Naam project" name="name" class="form-control" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="date">Eind datum</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Korte beschrijving</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="">Scrum master</label>
                            <select name="scrum_master" class="selectbox">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Product owner</label>
                            <select name="product_owner" class="selectbox">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                        <button type="button" class="btn btn-primary" onclick="closeForm()">Sluiten</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- block new project page -->
    <div class="row">
        @foreach($projects as $project)
        <a href="{{url('/projectpage', $project->id)}}" class="ahrefcard">
            <div class="card mb-3 standardcardbig" id="card">
                <div class="card-body">
                    <h2 class="titlecard cardtitle">{{$project->name}}</h2>
                    <br>
                    <h6 class="cardtitle">Beschrijving</h6>
                    <p class="poardbig">{{$project->description}}</p>
                    <h6 class="cardtitle">Eind datum</h6>
                    <p class="poardbig">{{ date('d-m-Y', strtotime($project->end_date))}}</p>
                    <h6 class="cardtitle">Scrum master</h6>
                    <p class="poardbig">{{$project->scrum_name}}</p>
                    <h6 class="cardtitle">Product owner</h6>
                    <p class="poardbig">{{$project->owner_name}}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- javascript pop up new project page -->
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
</div>
@endsection


