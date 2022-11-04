@extends('layouts.master')
@section('content')
    <main class="container">
        <div class="row cf">
            <!-- Title -->
            <div class="col-6">
                <h1 class="text-backlog">Task board</h1>
                <br>
            </div>
        </div>
        <!-- Table task head -->
            <table class="table table-bordered">
                <thead>
                <tr>
                    <!-- Table Head -->
                    <th class="table-head" scope="col">Nieuwe taken</th>
                    <th class="table-head" scope="col">Taken om te doen</th>
                    <th class="table-head" scope="col">Taken in uitvoering</th>
                    <th class="table-head" scope="col">Voltooide taken</th>
                </tr>
                </thead>

                <!-- Table Body -->
                <tbody>

                <tr>
                    <!-- Tasks related to current project team from database are shown and can be updated on status-->
                    <td>
                        @foreach ($news as $new)
                            <div class="card mb-3 standardcard" style="max-width: 18rem;">
                                <div class="card-body standardcard">
                                    <h5 class="titlecard poard">{{$new->title}}</h5>
                                    <p class="card-text poard">{{$new->effort}} uur</p>
                                    <div class="postedBy">
                                        <span class="spanretro">toegewezen aan:</span>
                                        {{$new->assigned_name}}
                                    </div>
                                    <form id="update{{$x}}" action="/sprintboard" method="post">
                                        @csrf
                                        <input type="hidden" name="project" value="{{$id}}">
                                        <input type="hidden" name="workitem_id" value="{{$new->id}}">
                                        <select class="selectbox minibox" name="status" onchange="document.getElementById('update<?php echo e($x); ?>').submit(); return false;">
                                            <option value="new">Nieuw</option>
                                            <option value="doing">In uitvoering</option>
                                            <option value="to-do">Nog te doen</option>
                                            <option value="done">Voltooid</option>
                                        </select>
                                        <?php $x++ ?>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </td>

                    <td>
                        @foreach ($todos as $todo)
                            <div class="card mb-3 standardcard" style="max-width: 18rem;">
                                <div class="card-body standardcard">
                                    <h5 class="titlecard poard">{{$todo->title}}</h5>
                                    <p class="card-text poard">{{$todo->effort}} uur</p>
                                    <div class="postedBy">
                                        <span class="spanretro">toegewezen aan:</span>
                                        {{$todo->assigned_name}}
                                    </div>
                                    <form id="update{{$x}}" action="/sprintboard" method="post">
                                        @csrf
                                        <input type="hidden" name="project" value="{{$id}}">
                                        <input type="hidden" name="workitem_id" value="{{$todo->id}}">
                                        <select class="selectbox minibox" name="status" onchange="document.getElementById('update<?php echo e($x); ?>').submit(); return false;">
                                            <option value="to-do">Nog te doen</option>
                                            <option value="doing">In uitvoering</option>
                                            <option value="done">Voltooid</option>
                                            <option value="new">Nieuw</option>
                                        </select>
                                        <?php $x++ ?>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </td>

                    <td>
                        @foreach ($progresses as $progress)
                            <div class="card mb-3 standardcard" style="max-width: 18rem;">
                                <div class="card-body standardcard">
                                    <h5 class="titlecard poard">{{$progress->title}}</h5>
                                    <p class="card-text poard">{{$progress->effort}} uur</p>
                                    <div class="postedBy">
                                        <span class="spanretro">toegewezen aan:</span>
                                        {{$progress->assigned_name}}
                                    </div>
                                    <form id="update{{$x}}" action="/sprintboard" method="post">
                                        @csrf
                                        <input type="hidden" name="project" value="{{$id}}">
                                        <input type="hidden" name="workitem_id" value="{{$progress->id}}">
                                        <select class="selectbox minibox" name="status" onchange="document.getElementById('update<?php echo e($x); ?>').submit(); return false;">
                                            <option value="doing">In uitvoering</option>
                                            <option value="done">Voltooid</option>
                                            <option value="to-do">Nog te doen</option>
                                            <option value="new">Nieuw</option>
                                        </select>
                                        <?php $x++ ?>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </td>

                    <td>
                        @foreach ($dones as $done)
                            <div class="card mb-3 standardcard" style="max-width: 18rem;">
                                <div class="card-body standardcard">
                                    <h5 class="titlecard poard">{{$done->title}}</h5>
                                    <p class="card-text poard">{{$done->effort}} uur</p>
                                    <div class="postedBy">
                                        <span class="spanretro">toegewezen aan:</span>
                                        {{$done->assigned_name}}
                                    </div>
                                    <form id="update{{$x}}" action="/sprintboard" method="post">
                                        @csrf
                                        <input type="hidden" name="project" value="{{$id}}">
                                        <input type="hidden" name="workitem_id" value="{{$done->id}}">
                                        <select class="selectbox minibox" name="status" onchange="document.getElementById('update<?php echo e($x); ?>').submit(); return false;">
                                            <option value="done">Voltooid</option>
                                            <option value="doing">In uitvoering</option>
                                            <option value="to-do">Nog te doen</option>
                                            <option value="new">Nieuw</option>
                                        </select>
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
    </main>
@endsection
