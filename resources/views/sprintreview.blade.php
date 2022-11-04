@extends('layouts.master')

@section('content')

<main class="container">
    <div class="row cf">
        <div class="col-6">
<!--        Title -->
            <h1 class="text-backlog">Sprint Review</h1>
            <br>
        </div>
        <div class="col-6 align-right">
<!--        New sprint review button -->
            <button class="btn btn-primary" onclick="openForm()">+Nieuwe sprint review</button>
        </div>
    </div>

        <table class="table">
            <thead>
                <tr class="tablespace">
                    <th class="table-head" scope="col">Titel</th>
                    <th class="table-head" scope="col">Beschrijving</th>
                    <th class="table-head" scope="col">Datum</th>
                </tr>
            </thead>

<!--        Table Body -->
            <tbody>
                @foreach($planning as $plan)
                    <tr>
                        <td class="row-left" scope="row">{{$plan->name}}</td>
                        <td class="row-right">{{$plan->description}}</td>
                        <td class="row-right">{{ date('d-m-Y', strtotime($plan->meeting_date))}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

<!-- form pop up new sprint review -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-popup card" id="myForm">
                    <form action="/sprintreview" method="post">
                        @csrf
                        <div class="form-row ">
                            <div class="form-group col-md-6">
<!--                            Using id of current project -->
                                <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}"/>
<!--                            Title input -->
                                <label for="name">Titel</label>
                                <input type="text" placeholder="Titel" class="form-control" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
<!--                            Meeting date input -->
                                <label for="meeting_date">Datum</label>
                                <input type="date" class="form-control" name="meeting_date" required>
                            </div>
                        </div>
                            <div class="form-group">
<!--                            Description input -->
                                <label for="description">Beschrijving</label>
                                <textarea rows="10" type="text" placeholder="Beschrijving" class="form-control reviewinput" name="description" required></textarea>
                            </div>
<!--                        Buttons for adding and closing form -->
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                        <button type="button" class="btn btn-primary" onclick="closeForm()">Sluiten</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- javascript pop up new review planning -->
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>

@endsection
