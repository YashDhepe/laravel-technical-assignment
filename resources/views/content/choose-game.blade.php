@extends('layouts.app')

@section('title', $pageConfigs['title'])

@section('page-style')
    {{-- page style css files --}}
@endsection

@section('content')

    <div class="pageBody">
        <section>
            <div class="container py-5">
                <div class="row">
                    @foreach ($games as $game)
                        <div class="col-md-6">
                            <a href="{{ route('site.sector', ['gameId' => encrypt($game->id)]) }}">
                                <div class="infoBox mb-4">
                                    <div class="infoContent">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset($game->image) }}" alt="" class="iconImg">
                                            <h5 class="mb-0">{{ $game->title }}</h5>
                                        </div>
                                        <p class="mb-0 smallTxt">{!! $game->description !!}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bottomGraphic"></section>
    </div>

@endsection

@section('page-script')
    {{-- Page js files --}}
@endsection
