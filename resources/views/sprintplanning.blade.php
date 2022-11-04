@extends('layouts.master')

@section('content')

<main class="container">
    <div class="row cf">
        <div class="col-6">
<!--        Title -->
            <h1 class="text-backlog">Sprint Planning</h1>
            <br>
        </div>
            <div class="col-6 align-right">
<!--        New sprint planning button -->
            <button class="btn btn-primary" onclick="openForm()">+Nieuwe sprint planning</button>
            </div>
    </div>

    <td>
        <div class="container">
            <div class="row row-cols-3">
                 @foreach($planning as $plan)
                    <div class="card standardcardbig mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                                <h5 class="titlecard">{{$plan->name}}</h5>
                                <p class="card-text">{{$plan->description}}</p>
                            <div class="postedBy">
                                 <p>Datum: {{ date('d-m-Y', strtotime($plan->meeting_date))}}</p>
                            </div>
                            <form id="delete{{$x}}" action="/deletesprint" method="post">
                                @csrf
                                <input type="hidden" name="project_id" value="{{$id}}">
                                <input type="hidden" name="sprint_id" value="{{$plan->id}}">
                                <a href="javascript:{}" onclick="document.getElementById('delete{{$x}}').submit(); return false;">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg%22%3E">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                                <?php $x++ ?>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


<!-- form pop up new sprint planning -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-popup card" id="myForm">
                    <form action="/sprintplanning" method="post">
                        @csrf
                        <div class="form-row ">
                            <div class="form-group col-md-6">
<!--                            Using id of current project -->
                                <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}"/>
<!--                            Title input -->
                                <label for="name">Titel</label>
                                <input type="text" class="form-control" name="name" placeholder="Titel" required>
                            </div>
                            <div class="form-group col-md-6">
<!--                            Meeting date input -->
                                <label for="meeting_date">Datum</label>
                                <input type="date" class="form-control" name="meeting_date" required>
                            </div>
                        </div>
                        <div class="form-group">
<!--                        Description input-->
                            <label for="description">Sprint doelen</label>
                            <textarea rows="10" placeholder="Sprint doelen" class="form-control reviewinput" name="description" required></textarea>
                        </div>
<!--                    Buttons for adding and closing form -->
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                        <button type="button" class="btn btn-primary" onclick="closeForm()">Sluiten</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- javascript pop up new sprint planning -->
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>

@endsection
