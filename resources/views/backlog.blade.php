@extends('layouts.master')

@section('content')

    <main class="container">
        <div class="row cf">
            <!-- Title -->
            <div class="col-6">
                <h1 class="text-backlog">Backlog</h1>
                <br>
            </div>
        </div>
        <!-- Table backlog head -->
            <table class="table">
                <thead>
                    <tr>
                        <!-- Table Head -->
                    <th class="table-head" scope="col">Titel</th>
                    <th class="table-head" scope="col">Toegewezen aan</th>
                    <th class="table-head" scope="col">Moeilijkheidsgraad</th>
                    <th class="table-head" scope="col">Status</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody>

                    @foreach ($backlog as $workitem)
                        <tr>
                        <!-- Title of a workitem -->
                            <td class="row-left" scope="row">{{$workitem->title}}</td>
                        <!-- Backlog assigned to someone -->
                        <td class="row-right">{{$workitem->assigned_name}}</td>
                        <!-- Backlog effort -->
                            <td class="row-right">{{$workitem->effort}}</td>
                        <!-- Backlog status -->
                        <td class="row-right">{{$workitem->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- javascript pop up new work item -->
        <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
        </script>
    </main>

@endsection
