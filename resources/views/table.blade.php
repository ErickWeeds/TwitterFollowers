@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">These users follow you, you still feeling alone?</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table id="userstable" class="table table-hover table-bordered">
                                    <th>ID</th>
                                    <th>Screen Name</th>
                                    @foreach($friends as $f)
                                    <tr>
                                        <td>{{$f->id_str}}</td>
                                        <td>{{'@'}}{{$f->screen_name}}</td>
                                    </tr>
                                    @endforeach
                                  </table>
                            </div>

                        </div>
                        @if ($cursor["next_following"] != 0)
                        <div class="row">
                            <div class="col-md-12 panel-white post-load-more panel-shadow text-center">
                                <a href="{{ url('twitter/followers?next_following='.$cursor['next_following'].'&next_followers='.$cursor['next_followers']) }}">
                                    <button class="btn btn-success">
                                        <i class="fa fa-refresh"></i>&nbsp;More..
                                    </button>
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
