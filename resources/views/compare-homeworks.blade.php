@extends('layouts.master')


@section('content')

<?php
$homeworks = get_teacher_homeworks();
?>
<div class="row">
    <div class="col-12">
            <h3 class="text-center"><a href="{{ url('/homework/' . $comparison->homework->slug) }}">{{ $comparison->homework->course->course_title .', '. $comparison->homework->name }}</a></h3>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h4 class="text-center"><a href="{{ url('/user/' . $user_1->id) }}">{{ get_name_by_id($user_1->id) }}</a></h4>
                    <hr>

                    @foreach ($requirements as $requirement)
                        <div class="card">
                            <div class="card-header">
                                {{ trim($requirement->description) }}
                                <a href="{{ url('/download/' . basename($requirement['file_1']->storage_path)) }}"><span class="badge badge-secondary badge-pill">descarc&#259;</span></a>
                            </div>
                            <div class="card-body">
                                <pre><code>{{  $requirement['file_1_content'] }}</code></pre>
                            </div>
                            <div class="card-footer">
                                <a>&#206;nc&#259;rcat la {{ $requirement['file_1']->created_at }}</a>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>

                <div class="col-6">
                    <h4 class="text-center"><a href="{{ url('/user/' . $user_2->id) }}">{{ get_name_by_id($user_2->id) }}</a></h4>
                    <hr>

                    @foreach ($requirements as $requirement)
                        <div class="card">
                            <div class="card-header">
                                {{ $requirement->description }}
                                <a href="{{ url('/download/' . basename($requirement['file_2']->storage_path)) }}"><span class="badge badge-secondary badge-pill">descarc&#259;</span></a>
                            </div>
                            <div class="card-body">
                                <pre><code>{{ $requirement['file_2_content'] }}</code></pre>
                            </div>
                            <div class="card-footer">
                                <a>&#206;nc&#259;rcat la {{ $requirement['file_2']->created_at }}</a>
                            </div>
                        </div>
                        <br>
                    @endforeach

                </div>
            </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Semnaleaz&#259; problemele</button>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(window).on('load', function (){
            $('.hljs-ln-code').click(function() {
                $(this).parent().toggleClass('line-selected-red');
            });
        })
    </script>
@endsection