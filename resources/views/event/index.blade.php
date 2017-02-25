@extends('layouts.app')

@section('js')
    @parent
    {{ Html::style('css/new-plugins.css') }}
    {{ Html::style('css/new-themes.css') }}
    {{ Html::style('css/new-main.css') }}


@endsection

@section('css')
    @parent

@endsection

@section('content')
        <div id="page-container">
            <section class="site-content site-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <aside class="sidebar site-block">
                                <div class="sidebar-block">
                                    <h3>{{ $event->title }}</h3>
                                    <i>{{ $event->description }}</i>
                                    @if ($event->schedules)
                                        <h3>{{ trans('campaign.schedules') }}</h3>
                                        @foreach ($event->schedules as $schedule)
                                            <div class="col-sm-12">
                                                <h4>{{ $schedule->name }}</h4>
                                                <i>{{ $schedule->description }}</i>
                                                @if ($schedule->start_time)
                                                    <br>
                                                    <span> <b>Start time:</b> {{ $schedule->start_time }}</span>
                                                @endif
                                                @if ($schedule->start_time)
                                                    <br>
                                                    <span> <b> End time: </b> {{ $schedule->end_time }}</span>
                                                @endif
                                            </div>

                                        @endforeach
                                    @endif
                                </div>
                            </aside>
                        </div>

                        <div class="col-md-8 col-lg-9">
                            <div class="row store-items">
                                @if ($event->images)
                                    @foreach ($event->images as $image)
                                        <div class="col-md-5 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                                        <div class="store-item">
                                            <div class="store-item-image">
                                                <a href="ecom_product.html">
                                                    <img src="{{ $image->image }}" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop
