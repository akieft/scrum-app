@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row cf">
        <div class="col-6">
            <!--        Title -->
            <h1 class="text-backlog">{{$project->name}}</h1>
            <br>
        </div>
    </div>

        <div class='row cf'>
            <div class='col-sm-8 col-xs-12 pull-left'>
                <div>
                    <div class="card standardcardbig pad">
                        <div class="col-sm-12">
                            <h2 class="titlecard cardtitle">Omschrijving</h2>
                            <br>
{{--                        project description from database--}}
                            <p class="poardbig">{{$project->description}}</p>
                            <h6 class="titlecard">Eind datum</h6>
                            <p class="poardbig">{{ date('d-m-Y', strtotime($project->end_date))}}</p>
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    <div class="card standardcardbig pad">
                        <div class="col-sm-12">
                            <h2 class="titlecard cardtitle">Project overzicht</h2>
                            <br>
                            <div class="row">
                                <div class="col-8">
                                    <p class="poardbig">Work items aangemaakt</p>
                                </div>
                                <div class="col-4">
{{--                                shows total workitems--}}
                                    {{$count}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <p class="poardbig">Work item voltooid</p>
                                </div>
                                <div class="col-4">
{{--                                Shows completed workitems--}}
                                    {{$completed}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='col-sm-4 col-xs-12 pull-right'>
                <div class="row">
                    {{--                        link to invite blade to add new current project members--}}
                    <a href="{{url('/invite', $project->id)}}" class="ahrefcard">
                        <div class="col-md-4">
                            <div class="card standardcardbig" id="teamlink">
                                <div>
                                    <h5 class="titlecard cardtitle">Bekijk hier je teamleden en voeg nieuwe leden toe</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
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
@endsection
