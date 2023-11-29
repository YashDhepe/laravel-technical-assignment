@extends('layouts.app')

@section('title', $pageConfigs['title'])

@section('page-style')
    {{-- page style css files --}}
@endsection

@section('content')
    <div class="pageBody">
        <section>
            <div class="container py-5">
                <p class="smallTxt mb-4">To begin, first select the sector of your choice</p>
                <div class="row">
                    {{-- BEGIN: Sectors --}}
                    @foreach ($sectors as $sector)
                        <div class="col-md-6">
                            <a href="{{ route('site.details-form', ['sectorId' => encrypt($sector->id)]) }}">
                                <div class="infoBox mb-4">
                                    <div class="infoContent">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($sector->image) }}" alt="" class="iconImg">
                                            <h6 class="mb-0">{{ $sector->name }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    {{-- END: Sectors --}}
                </div>
            </div>
        </section>
        <section class="bottomGraphic"></section>
    </div>
@endsection

@section('page-script')
    {{-- Page js files --}}
@endsection
