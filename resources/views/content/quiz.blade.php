@extends('layouts.app')

@section('title', $pageConfigs['title'])

@section('page-style')
    {{-- page style css files --}}
@endsection

@section('content')
    <div class="pageBody">
        <section>
            <div class="container py-5 mb-5">
                <div class="quiz_body">
                    <p class="smallTxt mb-0">
                        Question <span id="attemptedQs"></span> / <span id="totalQs"></span>
                    </p>
                    <div id="stepList" class="mb-3">
                        <!-- steps added dynamically -->
                    </div>
                    <dive class="d-flex justify-content-between align-items-center mb-5">
                        <dive class="scoreInfo">
                            <span>Score</span> <span id='score'></span>
                        </dive>
                        <div class="timerInfo">
                            <img src="{{ asset('images/timer-icon.svg') }}" class="d-inline-block me-2">
                            <span id="timer">0:15</span>
                        </div>
                    </dive>
                    <div id="questions" class="questionBox">
                        <!-- questions added dynamically -->
                    </div>
                    <button id="btn-next" class="blueBtn w-100 mt-5" onclick="next()">Next Question</button>
                </div>

            </div>
        </section>

        <section class="bottomGraphic"></section>

    </div>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script>
        var questions = @json($quizQuestions);
        let question_count = 0;
        let points = 0;
        let total_questions = questions.length;
        let timerInt;
        var userMcqResponse = [];
        console.log(questions);

        window.onload = function() {
            show(question_count);
            createSteps(total_questions);
            document.getElementById('score').innerHTML = points;

        };

        function createSteps(steps) {
            let stepList = document.getElementById('stepList')
            for (let i = 0; i < steps; i++) {
                const node = document.createElement("span");
                stepList.appendChild(node);
            }
            document.getElementById('totalQs').innerHTML = steps;
        }

        function timer() {
            var sec = 15;
            timerInt = setInterval(function() {
                // console.log('timer called')
                document.getElementById('timer').innerHTML = '0:' + sec;
                sec--;
                if (sec < 0) {
                    clearInterval(timerInt);
                    // updateScore();
                    next();
                }
            }, 1000);
        }

        function show(count) {
            document.getElementById('attemptedQs').innerHTML = question_count + 1;
            // setTimer
            timer();

            let question = document.getElementById("questions");
            let [first, second, third, fourth] = questions[count].options.map(option => option.option);

            question.innerHTML = `<h6 class='mt-2'>Q${count + 1}.  ${questions[count].question}</h6>
            <ul class="option_group">
                <span class="question-id d-none">${questions[count].id}</span>
                <span class="question-answer d-none">${questions[count].answer}</span>

                <li class="option">
                    <span>A.</span>
                    <span class="selected-option">${first}</span>
                </li>
                <li class="option">
                    <span>B.</span>
                    <span class="selected-option">${second}</span>
                </li>
                <li class="option">
                    <span>C.</span>
                    <span class="selected-option">${third}</span>
                </li>
                <li class="option">
                    <span>D.</span>
                    <span class="selected-option">${fourth}</span>
                </li>
            </ul>`;

            toggleActive();
        }

        function toggleActive() {
            let option = document.querySelectorAll("li.option");
            let nextBtn = document.getElementById('btn-next');
            nextBtn.disabled = true;
            for (let i = 0; i < option.length; i++) {
                option[i].onclick = function() {
                    for (let i = 0; i < option.length; i++) {
                        if (option[i].classList.contains("active")) {
                            option[i].classList.remove("active");
                        }
                    }
                    option[i].classList.add("active");
                    nextBtn.disabled = false;
                }
            }
        }

        function next() {
            // restart timer
            window.clearInterval(timerInt);

            if (question_count == questions.length - 1) {
                // location.href = "result.html";
                updateScore('submitQuiz');
            } else if (question_count == questions.length - 2) {
                let nextBtn = document.getElementById('btn-next');
                nextBtn.innerHTML = 'Submit'
            }

            console.log('question_count', question_count);
            updateScore();
            if (question_count == 9) {
                return '';
            }

            let steps = document.querySelectorAll("#stepList span")
            steps[question_count + 1].classList.add("current");
            steps[question_count].classList.add("done");

            let user_answer = document.querySelector("li.option.active");
            user_answer = user_answer ? user_answer.innerHTML : null

            if (user_answer && (user_answer.split('.')[1].trim() == questions[question_count].answer)) {
                points += 1;
                sessionStorage.setItem("points", points);
                document.getElementById('score').innerHTML = points;
            }

            question_count++;
            show(question_count);
        }

        function updateScore(submitQuiz = '') {

            var selectedQuestionId = $('.question-id').html();
            var selectedQuestionAnswer = $('.question-answer').html();
            var selectedOption = $('.option.active .selected-option').html();
            var userScore = $('#score').html();
            var questionCount = 0;

            if (selectedOption == selectedQuestionAnswer) {
                userScore = Number(userScore) + Number(1);
            }

            userMcqResponse[selectedQuestionId] = {
                'question_id': selectedQuestionId,
                'selected_option': selectedOption,
                'question_answer': selectedQuestionAnswer,
            }
            $('#score').html(userScore);
            questionCount++;
            console.log(questionCount);
            if (submitQuiz == 'submitQuiz') {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "post",
                    url: "{{ route('site.submit-quiz') }}",
                    data: {
                        user_mcq_response: userMcqResponse,
                        user_score: userScore,
                    },
                    success: function(response) {
                        console.log(response);
                        var responseData = JSON.parse(response);
                        if (responseData.status == 'success') {
                            location.href = responseData.redirection_url;
                        }else{
                        alert('something went wrong!');
                        }
                    }
                });
            }

            console.log(userMcqResponse);
        }
    </script>
@endsection
