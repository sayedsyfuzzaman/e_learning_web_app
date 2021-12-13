$(function () {
    let url=$("#quiz_url").val();

    const result_box = document.querySelector(".result_box");
    const option_list = document.querySelector(".option_list");
    const time_line = document.querySelector("header .time_line");
    const timeText = document.querySelector(".timer .time_left_txt");
    const timeCount = document.querySelector(".timer .timer_sec");

    $("#start_btn").click(function () {
        $("#start_btn").removeClass("activeInfo");
        $("#info_box").addClass("activeInfo");
    });

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            questions = JSON.parse(this.responseText);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();

    $("#quit").click(function () {
        location.reload();
    });

    $("#continue").click(function () {
        $("#info_box").removeClass("activeInfo");
        $("#quiz_box").addClass("activeQuiz");
        showQuetions(0);
        queCounter(1);
        startTimer(15);
        startTimerLine(0);
    });



    const bottom_ques_counter = document.querySelector("footer .total_que");
    let timeValue = 15;
    let que_count = 0;
    let que_numb = 1;
    let userScore = 0;
    let counter;
    let counterLine;
    let widthValue = 0;

    $("#next_btn").click(function () {
        if (que_count < questions.length - 1) {
            que_count++; 
            que_numb++; 
            showQuetions(que_count); 
            queCounter(que_numb); 
            clearInterval(counter); 
            clearInterval(counterLine); 
            startTimer(timeValue); 
            startTimerLine(widthValue); 
            timeText.textContent = "Time Left"; 
            $("#next_btn").removeClass("show");
        } else {
            clearInterval(counter); 
            clearInterval(counterLine); 
            showResult(); 
        }
    });



    function showQuetions(index) {
        const que_text = document.querySelector(".que_text");
        let que_tag = '<span>' + questions[index].numb + ". " + questions[index].question + '</span>';
        let option_tag = '<div class="option" id="option1")"><span>' + questions[index].options[0] + '</span></div>'
            + '<div class="option" id="option2"><span>' + questions[index].options[1] + '</span></div>'
            + '<div class="option" id="option3"><span>' + questions[index].options[2] + '</span></div>'
            + '<div class="option" id="option4"><span>' + questions[index].options[3] + '</span></div>';
        que_text.innerHTML = que_tag;
        option_list.innerHTML = option_tag;

        $("#option1").click(function () {
            clearInterval(counter);
            clearInterval(counterLine);
            let userAns = $(this).text();
            let correcAns = questions[que_count].answer;
            const allOptions = option_list.children.length;

            if (userAns == correcAns) {
                userScore += 1;
                $("#option1").addClass("correct");
            } else {
                $("#option1").addClass("incorrect");
                for (i = 0; i < allOptions; i++) {
                    if (option_list.children[i].textContent == correcAns) {
                        option_list.children[i].setAttribute("class", "option correct");
                    }
                }
            }
            for (i = 0; i < allOptions; i++) {
                option_list.children[i].classList.add("disabled");
            }
            $("#next_btn").addClass("show");
        });

        $("#option2").click(function () {
            clearInterval(counter);
            clearInterval(counterLine);
            let userAns = $(this).text();
            let correcAns = questions[que_count].answer;
            const allOptions = option_list.children.length;

            if (userAns == correcAns) {
                userScore += 1;
                $("#option2").addClass("correct");
            } else {
                $("#option2").addClass("incorrect");
                for (i = 0; i < allOptions; i++) {
                    if (option_list.children[i].textContent == correcAns) {
                        option_list.children[i].setAttribute("class", "option correct");
                    }
                }
            }
            for (i = 0; i < allOptions; i++) {
                option_list.children[i].classList.add("disabled");
            }
            $("#next_btn").addClass("show");
        });

        $("#option3").click(function () {
            clearInterval(counter);
            clearInterval(counterLine);
            let userAns = $(this).text();
            let correcAns = questions[que_count].answer;
            const allOptions = option_list.children.length;

            if (userAns == correcAns) {
                userScore += 1;
                $("#option3").addClass("correct");
            } else {
                $("#option3").addClass("incorrect");
                for (i = 0; i < allOptions; i++) {
                    if (option_list.children[i].textContent == correcAns) {
                        option_list.children[i].setAttribute("class", "option correct");
                    }
                }
            }
            for (i = 0; i < allOptions; i++) {
                option_list.children[i].classList.add("disabled");
            }
            $("#next_btn").addClass("show");
        });

        $("#option4").click(function () {
            clearInterval(counter);
            clearInterval(counterLine);
            let userAns = $(this).text();
            let correcAns = questions[que_count].answer;
            const allOptions = option_list.children.length;

            if (userAns == correcAns) {
                userScore += 1;
                $("#option4").addClass("correct");
            } else {
                $("#option4").addClass("incorrect");
                for (i = 0; i < allOptions; i++) {
                    if (option_list.children[i].textContent == correcAns) {
                        option_list.children[i].setAttribute("class", "option correct");
                    }
                }
            }
            for (i = 0; i < allOptions; i++) {
                option_list.children[i].classList.add("disabled");
            }
            $("#next_btn").addClass("show");
        });
    }

    function showResult(){
        $("#info_box").removeClass("activeInfo");
        $("#quiz_box").removeClass("activeQuiz");
        $("#result_box").addClass("activeResult");
        const scoreText = result_box.querySelector(".score_text");
        if(que_numb==userScore){
            document.getElementById("insartPossible").innerHTML="yes";
            let scoreTag = '<span>Congratulations!  You got '+ userScore +' out of '+ questions.length +' Keep it up.</p></span>';
            scoreText.innerHTML = scoreTag;
        }
        else if(que_numb>userScore){
            let scoreTag = '<span><p> More practice needed! You got '+ userScore +' out of '+ questions.length +'. Watch the video or lacture note and try again.</P></span>';
            scoreText.innerHTML = scoreTag;
        }
    }




    function startTimer(time) {
        counter = setInterval(timer, 1000);
        function timer() {
            timeCount.textContent = time;
            time--;
            if (time < 0) {
                clearInterval(counter);
                timeText.textContent = "Time Off";
                const allOptions = option_list.children.length;
                let correcAns = questions[que_count].answer;
                for (i = 0; i < allOptions; i++) {
                    if (option_list.children[i].textContent == correcAns) {
                        option_list.children[i].setAttribute("class", "option correct");
                    }
                }
                for (i = 0; i < allOptions; i++) {
                    option_list.children[i].classList.add("disabled");
                }
                $("#next_btn").addClass("show");
            }
        }
    }

    function startTimerLine(time) {
        counterLine = setInterval(timer, 25);
        function timer() {
            time += 1.1;
            time_line.style.width = time + "px";
            if (time > 550) {
                clearInterval(counterLine);
            }
        }
    }


    function queCounter(index) {
        let totalQueCounTag = '<span><p>' + index + '</p> of <p>' + questions.length + '</p> Questions</span>';
        bottom_ques_counter.innerHTML = totalQueCounTag;
    }
});