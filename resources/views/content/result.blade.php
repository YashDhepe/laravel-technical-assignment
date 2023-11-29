@extends('layouts.app')

@section('title', $pageConfigs['title'])

@section('page-style')
    {{-- page style css files --}}
@endsection

@section('content')

    <div class="pageBody">
        <section>
            <div class="scoreBoard">
                <h2 class="fw-normal">{{ 'Hey ' . $quizResponse->app_user->name . '!!!' }}</span></h2>
                <div class="scoreCircle my-5">
                    <p class="mb-0">Your Score</p>
                    <span>{{ $quizResponse->score }}</span>
                    <div class="animateCircle" style="animation-delay: 0s"></div>
                    <div class="animateCircle" style="animation-delay: 0.5s"></div>
                    <!-- <div class="animateCircle" style="animation-delay: 1s"></div> -->
                </div>
                <div class="row gx-3 mb-4 justify-content-center">
                    <div class="col col-md-2">
                        <div class="scoreDetails">
                            <p class="smallTxt mb-0">Question</p>
                            <span>{{ $quizResponse->quiz_details->count() }}</span>
                        </div>
                    </div>
                    <div class="col col-md-2">
                        <div class="scoreDetails">
                            <p class="smallTxt mb-0">Correct</p>
                            <span>{{ $quizResponse->score }}</span>
                        </div>
                    </div>
                    <div class="col col-md-2">
                        <div class="scoreDetails">
                            <p class="smallTxt mb-0">Wrong</p>
                            <span>{{ $quizResponse->quiz_details->count() - $quizResponse->score }}</span>
                        </div>
                    </div>
                </div>
                @if ($quizResponse->game->type == 'career_assessment')
                    <p class="voucherTxt">You have won discount voucher of </br><span class="fw-normal">₹</span><span>
                            {{ $quizResponse->amount }}/-</span></p>
                @endif
            </div>

            <div class="container pt-4 pb-5 text-center">
                @if ($quizResponse->game->type == 'career_assessment' && $quizResponse->amount > 0 )
                    <p>Now that you've won, reach out to your nearest advisor to claim your rewards</p>
                    <div class="voucherCode mb-4">
                        {{ $quizResponse->voucher }}
                    </div>
                @else
                    <p>{{ $quizResponse->message }}</p>
                @endif

                @if ($quizResponse->game->type == 'career_assessment' && $quizResponse->amount > 0)
                    <a href="#">
                        <button class="blueBtn w-100 mb-3">Claim</button>
                    </a>
                @endif

                <a href="{{ route('site.home') }}">
                    <button class="blueBtn blueLineBtn w-100">Play again to improve your score</button>
                </a>
            </div>
        </section>

        <section class="learnerSection pt-5">
            <div class="redBg mt-4 mt-md-5 pb-5">
                <h2 class="title pb-3">Learner Voice</h2>
                <div class="container">
                    <div class="customSlider">
                        <div class="slide-item">
                            <div class="videoPlayer mb-2">
                                <!-- <button class="videoBtn"><img src="assets/images/play-btn.png" /></button>
                                            <video height="auto" preload="metadata" onclick="videoControls(this);return false;">
                                                <source type="video/mp4" src="https://www.w3schools.com/html/mov_bbb.mp4#t=0.1">
                                            </video> -->
                                <iframe width="100%" height="200px" width="100%"
                                    src="https://www.youtube.com/embed/v3dJmCrsN3o?si=vwvUhLJb4ZRtYyMq?showinfo=0"
                                    frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                            <span class="smallLabel">Sector</span>
                            <div class="py-3">
                                <p class="mb-0 cardName">Akash Singh</p>
                                <small>Microsoft, Sr. Software Engineer</small>
                            </div>
                        </div>
                        <div class="slide-item">
                            <div class="videoPlayer mb-2">
                                <iframe width="100%" height="200px"
                                    src="https://www.youtube.com/embed/v3dJmCrsN3o?si=vwvUhLJb4ZRtYyMq?showinfo=0"
                                    frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                            <span class="smallLabel">Sector</span>
                            <div class="py-3">
                                <p class="mb-0 cardName">Akash Singh</p>
                                <small>Microsoft, Sr. Software Engineer</small>
                            </div>
                        </div>
                        <div class="slide-item">
                            <div class="videoPlayer mb-2">
                                <iframe width="100%" height="200px"
                                    src="https://www.youtube.com/embed/v3dJmCrsN3o?si=vwvUhLJb4ZRtYyMq?showinfo=0"
                                    frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                            <span class="smallLabel">Sector</span>
                            <div class="py-3">
                                <p class="mb-0 cardName">Akash Singh</p>
                                <small>Microsoft, Sr. Software Engineer</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="whiteBg text-center pt-5 pb-3">
            <div class="container">
                <h2 class="title pb-3">Why TimesPro?</h2>
                <div class="customSlider blueDots">
                    <div class="slide-item">
                        <div class="videoPlayer mb-2">
                            <iframe width="100%" height="200px"
                                src="https://www.youtube.com/embed/v3dJmCrsN3o?si=vwvUhLJb4ZRtYyMq?showinfo=0"
                                frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    <div class="slide-item">
                        <div class="videoPlayer mb-2">
                            <iframe width="100%" height="200px"
                                src="https://www.youtube.com/embed/v3dJmCrsN3o?si=vwvUhLJb4ZRtYyMq?showinfo=0"
                                frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    <div class="slide-item">
                        <div class="videoPlayer mb-2">
                            <iframe width="100%" height="200px"
                                src="https://www.youtube.com/embed/v3dJmCrsN3o?si=vwvUhLJb4ZRtYyMq?showinfo=0"
                                frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection

@section('page-script')
    {{-- Page js files --}}
    <script>
        jQuery(document).ready(function($) {
            $('.customSlider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                pauseOnHover: true,
                responsive: [{
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            arrows: false,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

        });

        const videoControls = (el) => {
            // console.log('clicked')
            // $('video').each((i, vid) => {
            //     vid.pause()
            // });
            el.paused ? el.play() : el.pause();
            // el.controls = true;
            $(el).siblings('.videoBtn').fadeToggle();
        }
    </script>
@endsection
