@extends('layouts.master')

@section('content')
<main class="container">
    <div class="row cf">
        <div class="col-6">
<!--        Title -->
            <h1 class="text-backlog">Work items</h1>
            <br>
        </div>
            <div class="col-6 align-right">
<!--             Button new work item -->
                <button class="btn btn-primary" onclick="openForm()">+Nieuw work item</button>
            </div>
        </div>
    <!--    Popup form for adding a new work item -->
    <div class="col-md-6">
        <div class="form-popup card" id="myForm">
            <form action="/workitems" method="post" class="form-container">
                @csrf
                <h1>Nieuw work item</h1>
                <!--                    Using current project ID -->
                <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}">
                <!--                    Title input -->
                <label for="title"><b>Titel</b></label>
                <input type="text" class="form-control" name="title" placeholder="Titel" required/>
                <!--                    Type input -->
                <label for="type"><b>Type</b></label>
                <select class="form-control" name="type">
                    <option>task</option>
                    <option>backlog</option>
                </select>
                <!--                    Effort input -->
                <label for="effort"><b>Moeilijkheidsgraad</b></label>
                <input type="number" class="form-control" name="effort" min="0" max="100" step="0.1" required/>
                <label for=""><b>Toegewezen aan</b></label>
                <select class="form-control" name="assigned_to">
                    @foreach ($users as $user)
                        <option value={{$user->id}}>{{$user->name}}</option>
                    @endforeach
                </select>
                <!--                    Status -->
                <input type="hidden" class="form-control" name="status" value="new"/>
                <br>
                <!--                    Buttons for adding and closing -->
                <button type="submit" class="btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-primary" onclick="closeForm()">Cancel</button>
            </form>
        </div>
    </div>

<!-- Table Workitems -->
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-head" scope="col">Titel</th>
                        <th class="table-head" scope="col">Toegewezen aan</th>
                        <th class="table-head" scope="col">Type</th>
                        <th class="table-head" scope="col">Status</th>
                    </tr>
                </thead>

<!--            Table Body -->
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                            <!-- Title of a workitem -->
                        <td class="row-left test" scope="row"><p>{{$item->title}}</p></td>
                            <!-- Workitem assigned to someone -->
                        <td class="row-right"><p>{{$item->assigned_name}}</p></td>
                            <!-- Workitem type -->
                        <td class="row-right"><p>{{$item->type}}</p></td>
                            <!-- Workitem status -->
                        <td class="row-right">{{$item->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</main>

    <!--    javascript pop up new work item -->
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }
        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>

@endsection
