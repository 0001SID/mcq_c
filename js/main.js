window.onload = function () {
    addEvent();
}
function addEvent() {
    options = document.getElementsByClassName('option-box');
    for (i = 0; i < options.length; i++) {
        options[i].addEventListener('click', function (e) { checkAnswer(this); });
    }
}
givenAnswers = {
    submit: true
};
function checkAnswer(option) {
    selected = option.querySelector('.check');
    number = selected.parentNode.parentNode.querySelector('#count').innerText;
    eval('givenAnswers.a' + number + ' = selected.nextElementSibling.value');
    // selected.parentNode.parentNode.classList.remove('fadeIn');
    // selected.parentNode.parentNode.classList.add('fadeOut');
    // selected.parentNode.parentNode.classList.add('dis-none');
    // selected.parentNode.parentNode.nextSibling.nextSibling.classList.add('fadeIn');
    selected.classList.toggle('show');
    anothers = selected.parentNode.parentNode.querySelectorAll('.option-box');
    for (i = 0; i < anothers.length; i++) {
        if (anothers[i].querySelector('.check') != selected) {
            anothers[i].querySelector('.check').classList.remove('show');
        }
    }
}
function next(selected) {
    // number = selected.parentNode.parentNode.querySelector('#count').innerText;
    // eval('givenAnswers.a'+number+' = 0');
    selected.parentNode.parentNode.parentNode.classList.toggle('fadeIn');
    selected.parentNode.parentNode.parentNode.classList.toggle('fadeOut');
    selected.parentNode.parentNode.parentNode.classList.toggle('dis-none');
    selected.parentNode.parentNode.parentNode.nextSibling.nextSibling.classList.toggle('fadeOut');
    selected.parentNode.parentNode.parentNode.nextSibling.nextSibling.classList.toggle('fadeIn');
    selected.parentNode.parentNode.parentNode.nextSibling.nextSibling.classList.toggle('dis-none');
}
function pre(selected) {
    selected.parentNode.parentNode.parentNode.classList.toggle('fadeIn');
    selected.parentNode.parentNode.parentNode.classList.toggle('fadeOut');
    selected.parentNode.parentNode.parentNode.classList.toggle('dis-none');
    selected.parentNode.parentNode.parentNode.previousSibling.previousSibling.classList.remove('fadeOut');
    selected.parentNode.parentNode.parentNode.previousSibling.previousSibling.classList.remove('dis-none');
    selected.parentNode.parentNode.parentNode.previousSibling.previousSibling.classList.toggle('fadeIn');

}
function submit(selected) {
    givenAnswers.chapterName = document.getElementById('currentChapter').value;
    $.ajax({
        type: 'POST',
        data: givenAnswers,
        url: '//' + location.hostname + '/mcq/checkAnswer.php',
        success: function (data) {
            selected.parentNode.parentNode.parentNode.classList.toggle('fadeIn');
            selected.parentNode.parentNode.parentNode.classList.toggle('fadeOut');
            selected.parentNode.parentNode.parentNode.classList.toggle('dis-none');

            document.getElementById('res').parentNode.parentNode.classList.toggle('dis-none');
            document.getElementById('res').parentNode.parentNode.classList.toggle('fadeIn');
            document.getElementById('res').innerText = data;
        },
        error: function () {
            window.alert('Submission failed');
        },
        dataType: "json"
    });
}


function isNull(str) {
    return (!str || str.length === 0 || /^\s*$/.test(str))
}

function addQuestion() {
    data = {
        submit: true,
        chapter: document.getElementById('chapter').value.trim(),
        question: document.getElementById('question').value.trim(),
        code: document.getElementById('code').value.trim(),
        op1: document.getElementById('op1').value.trim(),
        op2: document.getElementById('op2').value.trim(),
        op3: document.getElementById('op3').value.trim(),
        op4: document.getElementById('op4').value.trim(),
        answer: document.getElementById('answer').value.trim(),
        explanation: document.getElementById('explanation').value.trim()
    };
    if(data.chapter != '' && data.op1 != '' && data.op2 != ''){
    // if (isNull(data.chapter) || isNull(data.op1) || isNull(data.op2) || isNull(data.op) || isNull(data.op4)) {
        
        $.ajax({
            type: 'POST',
            data: data,
            url: '//' + location.hostname + '/mcq/addQuestion.php',
            success: function (data) {
                if (data) {
                    document.getElementById('lastQ').innerText = document.getElementById('question').value;
                    document.getElementById('question').value = '';
                    document.getElementById('code').value = '';
                    document.getElementById('op1').value = '';
                    document.getElementById('op2').value = '';
                    document.getElementById('op3').value = '';
                    document.getElementById('op4').value = '';
                    document.getElementById('answer').options[0].selected = true;
                    document.getElementById('explanation').value = '';
                    document.getElementById('success').classList.toggle('show');
                    setTimeout(function () {
                        document.getElementById('success').classList.toggle('show');
                    }, 1000);
                }
                else {
                    document.getElementById('failed').classList.toggle('show');
                    setTimeout(function () {
                        document.getElementById('failed').classList.toggle('show');
                    }, 1000);
                }
            },
            error: function () {
                document.getElementById('failed').classList.toggle('show');
                setTimeout(function () {
                    document.getElementById('failed').classList.toggle('show');
                }, 1000);
            },
            dataType: "json"
        });
    } else {
        document.getElementById('require').classList.toggle('show');
        setTimeout(function () {
            document.getElementById('require').classList.toggle('show');
        }, 3000);
    }
}