@extends('layouts.master')
@section('content')

<main class="container">
    <div class="row cf">
        <div class="col-6">
<!--        Title -->
            <h1 class="text-backlog">Retrospective</h1>
            <br>
        </div>
        <div class="col-6 align-right">
<!--                Button for adding a comment on retrospective board -->
                    <button class="btn btn-primary" onclick="openForm()">+Opmerking toevoegen</button>
        </div>
    </div>

<!--    Start of table -->
        <table class="table table-bordered">
            <thead>
                <tr>
<!--                Table Head -->
                    <th class="table-head" scope="col">Wat ging goed?</th>
                    <th class="table-head" scope="col">Wat kon beter?</th>
                </tr>
            </thead>

<!--        Positive column -->
            <tbody>
                <tr>
                    <td>
                        @foreach($positives as $positive)
                        <div class="card mb-3 positivecard shadow1" style="max-width: 18rem;">
                            <div class="card-body">
                                <p class="card-text">{{$positive->description}}</p>
                                <div class="postedBy">
                                    <span class="spanretro">Geschreven door:</span>
                                    {{$positive->user_name}}
                                </div>
                                <form id="delete{{$x}}" action="/delete" method="post">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{$id}}">
                                    <input type="hidden" name="retro_id" value="{{$positive->id}}">
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
                    </td>

<!--                Negative column -->
                    <td>
                        @foreach($negatives as $negative)
                        <div class="card mb-3 negativecard shadow1" style="max-width: 18rem;">
                            <div class="card-body">
                                <p class="card-text">{{$negative->description}}</p>
                                <div class="postedBy">
                                    <span class="spanretro">Geschreven door:</span>
                                    {{$negative->user_name}}
                                </div>
                                <form id="delete{{$x}}" action="/delete" method="post">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{$id}}">
                                    <input type="hidden" name="retro_id" value="{{$negative->id}}">
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
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

        <!-- form pop up new sprint planning -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-popup card" id="myForm">
                        <form action="/retrospective" method="post">
                            @csrf
                            <div class="form-row ">
                                <div class="form-group col-md-6">
                                    <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}"/>
                                    <label for="description">Opmerking</label>
                                    <textarea rows="10" type="text" placeholder="Beschrijving" class="form-control retroinput" name="description" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type">
                                    <option value="Positive">Positief</option>
                                    <option value="Negative">Negatief</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Opslaan</button>
                            <button type="button" class="btn btn-primary" onclick="closeForm()">Sluiten</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>

<!-- javascript pop up new comment on retrospective board -->
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>

@endsection
