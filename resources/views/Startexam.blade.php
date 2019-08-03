@extends('layouts.empty')
@section('content')

    <style>
        .modal-ku {
            width: 750px;
            margin: auto;
        }

        button.one {
            color: white
        }
    </style>

    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Over -- -------------------------------------- -->
    <div class="container-fluid bg-secondary hidden" style="height:100vh" id="examover">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Exam Over</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body alert alert-primary">
                    <div class="row" style="margin:0px;">
                        <div id="title" class="col-sm-12">
                            Level is Not Completed!
                        </div>
                        <div id="subtitle" class="col-sm-12">
                            You may try again!
                        </div>
                        <div class="col-sm-12 hidden" id="active_process">
                            <span class="card-text "> <i class="fa fa-spinner fa-spin"></i> Pls Wait Processing Your Response.... </span>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" id="examover_footer">
                    <button type="button" onclick="home()" class="btn btn-warning">Home</button>
                    {{--<button type="button" onclick="result()" class="btn btn-warning">Result</button>--}}
                </div>

                <div class="modal-footer hidden" id="pass_examover_footer">
                    {{-- @foreach($subject as $item)
                         @if($item->subject_type=="next_level")--}}
                    <button type="button" onclick="home()" class="btn btn-warning">Next
                        Level
                    </button>
                    {{--  @endif
                  @endforeach--}}
                    <button type="button" onclick="result()" class="btn btn-warning">Result</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Instruction -- -->
    <!--- Error -- - -->
    <div id="errorModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Error</h4>
                </div>
                <div class="modal-body">
                    <p>We can’t connect to the server</p>
                    <p>Try again later. </p>
                    <p>Check your network connection.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- The Modal -->
    <div class="container-fluid bg-secondary" id="instruction">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Instructions</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body alert alert-primary">
                    <div class="row" style="margin:0px;">

                        <div class="col-sm-12">
                            <span class="card-text ">No. of Question : </span><span class="text-right nopadding"
                                                                                    id="total_number_of_question"></span>
                        </div>
                        <div class="col-sm-12">
                            <span class="card-text ">Total Marks : </span><span class="text-right nopadding"
                                                                                id="Total_Marks"></span>
                        </div>

                        <div class="col-sm-12">
                            <span class="card-text ">Re-Attempt Allowed : </span><span
                                    class="text-right nopadding">Yes</span>
                        </div>
                        <div class="col-sm-12">
                            <span class="card-text ">Exam Time : </span><span class="text-right nopadding">{{$time}}
                                min</span>
                        </div>

                        <h4 class="modal-title">Notes</h4>

                        <div class="col-sm-12">
                            Don't press back Button
                        </div>
                        <div class="col-sm-12">
                            Result Declaration After Exam
                        </div>
                        <div class="col-sm-12">
                            Marks and Neg. Marks Show during Exam
                        </div>
                        <div class="col-sm-12">
                            Click "Start" button below to start Exam
                        </div>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div id="examloader" class="hidden">
                        <div class="ball-scale">
                            <div class='contain'>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                                <div class="ring">
                                    <div class="frame"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-success hidden" id="pls_wait_preparing_exam_room">Pls wait ... Preparing
                        Exam Room
                    </div>
                    @if($first_time==1)
                        <button type="button" onclick="startExam()" id="startexambutton" class="btn btn-secondary ">
                            Start Exam
                        </button>
                    @endif


                    <button type="button" onclick="startNextLevelQuestion()" id="startnextexambutton"
                            class="btn btn-secondary hidden">Go to Next Level
                    </button>


                </div>

            </div>
        </div>
    </div>



    <!-- Pre-loader end -->
    <div class="pcoded-content hidden" id="show_exam">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">

                    <div class="page-body">
                        <div class="row question_rearrange">

                            <!-- Questions -->
                            <?php $no = 1; $tmarks = 0;?>
                            @foreach($subjectquestion as $value)
                                @if (($value->qdifficulty  >= $student->pability) && ($value->qdifficulty * 0.01 <= $student->abilityright))



                                    @if ($no===1)
                                        <div id="ques_block{{$value->id}}" class="col-sm-8 hideme ">
                                            <script>
                                                var c_s_set = '{{$value->subject}}';
                                            </script>
                                            @else
                                                <div id="ques_block{{$value->id}}"
                                                     class="col-sm-8 hideme hidden">

                                                    @endif
                                                    <div class="card">
                                                        <div class="alert alert-light text-justify col-sm-12">
                                                            <input type="hidden" class="current_qusetion_no" id=""
                                                                   value='{{$no}}'>

                                                            <h4 id="quest" class=" modal-title text-dark"><b> <span
                                                                            class="setqno">{{$no++}}</span>
                                                                    :</b> {{$value->question}}</h4>
                                                            {{-- @if ($value->image != NULL)
                                                                 --}}{{--<div>
                                                                     <img class="img-responsive center-block"
                                                                          src="http://www.allexamcorner.org/public/images/{!!$value->image!!}">
                                                                 </div>--}}{{--
                                                             @endif--}}
                                                        </div>
                                                        <div class="card-block ">
                                                            <!-- radio button -->
                                                            <form action="#" id="examopt">
                                                                <p id="opt1" class="col-sm-12">
                                                                    <input type="radio"
                                                                           id="optionA{{$value->id}}"
                                                                           name="option{{$value->id}}"
                                                                           value="A">
                                                                    <label for="optionA{{$value->id}}">{!!$value->option_A!!}</label>
                                                                    @if ($value->image_A != NULL)
                                                                        {{--<div>
                                                                            <img class="img-responsive center-block"
                                                                                 style="max-width: 250px; max-height: 359px;"
                                                                                 src="http://www.allexamcorner.org/aecapp/public/images/{!!$value->image_A!!}">
                                                                        </div>--}}
                                                                    @endif

                                                                </p>

                                                                <p id="opt2" class="col-sm-12">
                                                                    <input type="radio"
                                                                           id="optionB{{$value->id}}"
                                                                           name="option{{$value->id}}"
                                                                           value="B">
                                                                    <label for="optionB{{$value->id}}">{!!$value->option_B!!}</label>
                                                                    @if ($value->image_B != NULL)
                                                                        {{-- <div>
                                                                             <img class="img-responsive center-block"
                                                                                  style="max-width: 250px; max-height: 359px;"
                                                                                  src="http://www.allexamcorner.org/aecapp/public/images/{!!$value->image_B!!}">
                                                                         </div>--}}
                                                                    @endif

                                                                </p>

                                                                <p id="opt3" class="col-sm-12">
                                                                    <input type="radio"
                                                                           id="optionC{{$value->id}}"
                                                                           name="option{{$value->id}}"
                                                                           value="C">
                                                                    <label id="optc"
                                                                           for="optionC{{$value->id}}">{!!$value->option_C!!}</label>
                                                                    @if ($value->image_C != NULL)
                                                                        {{--<div>
                                                                            <img class="img-responsive center-block"
                                                                                 style="max-width: 250px; max-height: 359px;"
                                                                                 src="http://www.allexamcorner.org/aecapp/public/images/{!!$value->image_C!!}">
                                                                        </div>--}}
                                                                    @endif

                                                                </p>

                                                                <p id="opt4" class="col-sm-12">
                                                                    <input type="radio"
                                                                           id="optionD{{$value->id}}"
                                                                           name="option{{$value->id}}"
                                                                           value="D">
                                                                    <label for="optionD{{$value->id}}">{!!$value->option_D!!}</label>
                                                                    @if ($value->image_D != NULL)
                                                                        {{--  <div>
                                                                              <img style="max-width: 250px; max-height: 359px;"
                                                                                   class="img-responsive center-block"
                                                                                   src="http://www.allexamcorner.org/aecapp/public/images/{!!$value->image_D!!}">
                                                                          </div>--}}
                                                                    @endif

                                                                </p>

                                                            </form>
                                                            <input name="correctoption" type="hidden"
                                                                   id="correctoption{{$value->id}}"
                                                                   value="{{$value->correct_option}}">
                                                            <input name="marks" type="hidden"
                                                                   id="marks{{$value->id}}"
                                                                   value="{{$value->marks}}">
                                                            <input name="negmarks" type="hidden"
                                                                   id="negmarks{{$value->id}}"
                                                                   value="{{$value->negative_marks}}">
                                                            <input name="qid" type="hidden"
                                                                   id="qid"
                                                                   value="{{$value->id}}">


                                                            <input name="qdifficulty" type="hidden"
                                                                   id="qdifficulty"
                                                                   value="{{$value->qdifficulty}}">
                                                            <!-- End Radio Button -->
                                                            <?php $tmarks = $tmarks + $value->marks; ?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 text-center"
                                                                 style="margin-bottom:20px;">
                                                                @if ($no ==1)
                                                                    {{-- <button type="button"
                                                                             onclick="Previous('{{$no-1}}',{{$value}})"
                                                                             id="previous" style="background: #298c38"
                                                                             class="btn btn-outline-secondary text-white select-button">
                                                                         Previous
                                                                     </button>--}}
                                                                @endif
                                                                <button type="button"
                                                                        onclick="Save('{{$value->qdifficulty}}','{{$student->pability}}','{{$value->subject_id}}','{{$value->examcode}}')"
                                                                        style="background: #298c38"
                                                                        class="btn btn-outline-secondary text-white select-button">
                                                                    Save &
                                                                    Next
                                                                </button>
                                                              {{--  <button type="button"
                                                                        onclick="Reminder('{{$no-1}}',{{$value->question}})"
                                                                        style="background: #298c38"
                                                                        class="btn btn-outline-secondary text-white select-button">
                                                                    Reminder
                                                                </button>--}}
                                                                    <button id="examfinished" type="button"

                                                                            onclick="finish('{{$value->id}}','{{$value->examcode}}','{{$userId}}','{{$value->subject_type}}','{{$value->subject_code}}','{{$value->subject_level}}','{{$value->pass_mark}}','{{$subjectId}}')"
                                                                            style="background: #298c38; background-color: #0495c9;"
                                                                            class="Finshexam btn btn-outline-secondary text-white select-button
"
                                                                    >Finish
                                                                    </button>

                                                               {{-- <button type="button"
                                                                        onclick="Skip('{{$no-1}}',{{$value->question}})"
                                                                        style="background: rgb(251, 101, 96)"
                                                                        class="btn btn-outline-secondary text-white select-button">
                                                                    Skip
                                                                </button>--}}





                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            @endif
                                            @endforeach
                                            <script>
                                                document.getElementById("total_number_of_question").innerHTML = '{{$no-1}}';
                                                document.getElementById("Total_Marks").innerHTML = '{{$tmarks}}';
                                            </script>

                                            <div class="col-sm-4">

                                                <div class=" card twitter-card">
                                                    <div class="card-header">
                                                        <!--<i class="icofont icofont-social-twitter"></i> -->
                                                        <div class="col-sm-6 d-inline-block">
                                                            <h4 id="display_selected_subject"></h4>

                                                        </div>

                                                        <div class="card-header-right">
                                                            {{-- <button id="filter_button" type="button"
                                                                     class="btn btn-info dropdown-toggle"
                                                                     data-toggle="dropdown" aria-haspopup="true"
                                                                     aria-expanded="false">
                                                                 Change Sub
                                                             </button>--}}
                                                            <input type="hidden" id="current_selected_subject"
                                                                   value='Null'>

                                                            <script type="text/javascript">
                                                                document.getElementById("current_selected_subject").setAttribute('value', c_s_set);
                                                                document.getElementById("display_selected_subject").innerHTML = c_s_set;
                                                            </script>

                                                            {{--<div class="dropdown-menu">
                                                                @foreach($subject as $item)
                                                                    <a onclick="change_selected_question('{{$item->subject}}',{{$question}})"
                                                                       class="dropdown-item"
                                                                       href="#"> {{$item->subject}} </a>
                                                                @endforeach
                                                            </div>--}}
                                                        </div>
                                                    </div>
                                                    <div class="card-block text-left rearrange_q">
                                                        <!-- Change Questions Button-->
                                                    <?php $q_no = 1; ?>

                                                    <!-- <button id="{{$value->subject}}{{$value->id}}" onclick="show_selected_question('{{$value->subject}}','{{$value->id}}', {{$q_no}})" class="btn btn-warning btn-icon circle-btn">{{ $q_no }}</button>
                                                                -->
                                                        <button id="btn{{$value->id}}"
                                                                class="one cl btn btn-light btn-outline-success border border-secondary btn-icon circle-btn">{{ $q_no++ }}</button>

                                                        <script type="text/javascript">
                                                            //  alert("qq");
                                                            $(document).ready(function () {
                                                                $('#btn{{$value->id}}').on('vclick click mousedown touchstart', function (e) {
                                                                    //      alert("qq");
                                                                    show_selected_question('{{$value->subject}}', '{{$value->id}}', '{{$q_no -1 }}');
                                                                });
                                                            });
                                                        </script>


                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                        </div>

                    </div>

                    <div id="styleSelector">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------ Script ----------------- -->
    <script type="text/javascript">
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            var countdown = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = minutes + " : " + seconds;
                if (--timer < 0) {
                    clearInterval(countdown);
                    let questionId = set_current_subject_state[0];
                    let examCode = set_current_subject_state[1];
                    let userId = set_current_subject_state[2];
                    let subjectType = set_current_subject_state[3];
                    let subjectId = set_current_subject_state[4];
                    let subjectLevel = set_current_subject_state[5];
                    let passMark = set_current_subject_state[6];
                    finish(questionId, examCode, userId, subjectType, subjectId, subjectLevel, passMark, '{{$subjectId}}');
                }
            }, 1000);
        }

        //referesh ref_result table and fetch the same question but now lets change this to fetch new level question
        function startExam() {
            $("#startexambutton").addClass('hidden');
            $("#examloader").removeClass('hidden');
            $("#pls_wait_preparing_exam_room").removeClass('hidden');
            var data = new FormData();
            data.append('subject_id', "\''{{$id}}'\'");
            data.append('examcode', '{{$examcode}}');
            $.ajax({
                type: 'POST',
                url: '/refresult',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                },
                data: data,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#instruction").addClass('hidden');
                    $("#show_exam").removeClass('hidden');
                    var fiveMinutes = 60 * '{{$time}}',
                        display = document.querySelector('#timmer');
                    startTimer(fiveMinutes, display);
                }
            })
        }

        function startNextLevelQuestion() {
            $("#startnextexambutton").addClass('hidden');
            $("#examloader").removeClass('hidden');
            $("#pls_wait_preparing_exam_room").removeClass('hidden');
        }

        // Show Selected Question
        /*  function show_selected_question($sub, $id, $q_no) {
              //  alert($sub+ $id+ $q_no)
              $('.hideme').addClass('hidden');
              $('#ques_block' + '' + $id).removeClass('hidden');
              //   alert('#ques_block'+''+$id);
              if ({{$no-1}} == $q_no)
            {
                $('.Finshexam').removeClass('hidden');
            }
            $('.setqno').text($q_no);
            $('.current_qusetion_no').val($q_no);
            $('#current_selected_subject').val($sub);
            $("#display_selected_subject").text($sub);
        }*/
        // Save Answer
        function Save($qdifficulty, $pability, $subjectId, $examCode) {
            let PEXP = 0;
            let PVAR = 0;

            let questionId = $('input[name="qid"]:hidden').val();
            let marks = $('input[name="marks"]:hidden').val();
            let negmarks = $('input[name="negmarks"]:hidden').val();
            let correctoption = $('input[name="correctoption"]:hidden').val();
            let questdifficulty = $('input[name="qdifficulty"]:hidden').val();
            alert(questionId);

            $.ajax({
                type: 'POST',
                url: '/countquestionasked',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                },
                data: {},
                success: function (data) {

                    console.log("question_count" + data[0][0]);


                    console.log(data[0]);


                    //   console.log(data);
                    // console.log($arr);

                    let correctAnswerCount = 0;
                    let SE = 0;
                    let lowLevelabilitysofar = 0;
                    let abilityforCorrectAnswer = 0;
                    console.log($qdifficulty);


                    for (let i = 0; i < data[0].length; i++) {

                        var totaldifficulty = parseInt(data[0][i].qdifficulty * 0.1) + parseInt(questdifficulty * 0.1);
                        console.log("total dificulty of asked question" + questdifficulty);
                        console.log(data[0][i].givenmarks);
                        //calculating total item count so far
                        if (data[0][i].givenmarks > 0) {
                            correctAnswerCount += 1;
                            console.log("score count" + correctAnswerCount);

                        }


                        //all the estimation should be inside the total question asked length
                        let SUCCESS = 1 / (1 + Math.exp((totaldifficulty - $pability)));
                        PEXP = (PEXP + SUCCESS);
                        console.log(SUCCESS + "AND" + PEXP);
                        PVAR = PVAR + (SUCCESS * (1 - SUCCESS));
                        console.log(PVAR);
                        SE = Math.sqrt(1 / PVAR);
                        if (PVAR < 1) {
                            PVAR = 1;
                        }

                        //'ability so far
                        lowLevelabilitysofar = parseFloat($pability) + (parseFloat((correctAnswerCount - PEXP)) / PVAR);
                        console.log("abilitysofar" + " :" + lowLevelabilitysofar);
                        console.log("abs of abilitysofar and pability" + Math.abs(parseFloat(lowLevelabilitysofar) - parseFloat($pability)));

                        /* if(Math.abs(parseFloat(lowLevelabilitysofar)-parseFloat($pability)) > 0.01) {
                             lowLevelabilitysofar=  $pability;

                         }*/


                    }

                    $.ajax({
                        type: 'POST',
                        url: '/checkforcorrectanswer',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                        },
                        data: {
                            ques_id: questionId,
                        },
                        success: function (data) {
                            console.log("givenmarks" + data[0][0].givenmarks);
                            if (data[0][0].givenmarks > 0) {
                                // ability if next answer right
                                let ABILITYRIGHT = lowLevelabilitysofar + (1 / PVAR);
                                abilityforCorrectAnswer = ABILITYRIGHT;

                                $.ajax({
                                    type: 'POST',
                                    url: '/updatestudentability',
                                    beforeSend: function (xhr) {
                                        xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                                    },
                                    data: {
                                        pability: lowLevelabilitysofar,
                                        abilityright: abilityforCorrectAnswer,
                                        se: SE,
                                        subjectId: $subjectId,
                                        examCode: $examCode
                                    },
                                    success: function (data) {
                                        console.log(data);

                                        $('input[name="marks"]:hidden').val(data.marks);

                                        $('input[name="negmarks"]:hidden').val(data.negative_marks);
                                        $('input[name="correctoption"]:hidden').val(data.correct_option);
                                        $('input[name="qdifficulty"]:hidden').val(data.qdifficulty);


                                        $('input[name="qid"]:hidden').val(data.id);


                                        let count = 1;
                                        $('#quest').text(++count + '.' + data.question);

                                        var html1 =
                                            '<p id ="opt1" class="col-sm-12" >' +
                                            '<input type="radio" name="option' + data.id + '" id="optionA' + data.id + '" value="A" >' +
                                            '<label for="optionA' + data.id + '">' + data.option_A + '</label>' +
                                            '</p>';


                                        var html2 = '<p id ="opt2" class="col-sm-12" >' +
                                            '<input type="radio" name="option' + data.id + '" id="optionB' + data.id + '" value="B" >' +
                                            '<label for="optionB' + data.id + '">' + data.option_B + '</label>' +
                                            '</p>';

                                        var html3 = '<p id ="opt3" class="col-sm-12" >' +
                                            '<input type="radio" name="option' + data.id + '" id="optionC' + data.id + '" value="C" >' +
                                            '<label for="optionC' + data.id + '">' + data.option_C + '</label>' +
                                            '</p>';
                                        var html4 = '<p id ="opt4" class="col-sm-12" >' +
                                            '<input type="radio" name="option' + data.id + '" id="optionD' + data.id + '" value="D" >' +
                                            '<label for="optionD' + data.id + '">' + data.option_D + '</label>' +
                                            '</p>';
                                        // }


                                        $('#opt1').replaceWith(html1);
                                        $('#opt2').replaceWith(html2);
                                        $('#opt3').replaceWith(html3);
                                        $('#opt4').replaceWith(html4);


                                    }
                                });


                            }
                            else {
                                console.log("wrong answer quest"+data[0]);
                                $.ajax({
                                    type: 'POST',
                                    url: '/updatestudentability',
                                    beforeSend: function (xhr) {
                                        xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                                    },
                                    data: {
                                        pability: $pability,
                                        abilityright: '{{$student->abilityright}}',
                                        se: SE,
                                        subjectId: $subjectId,
                                        examCode: $examCode
                                    },
                                    success: function (data) {
                                        console.log(data);

                                        $('input[name="marks"]:hidden').val(data.marks);

                                        $('input[name="negmarks"]:hidden').val(data.negative_marks);
                                        $('input[name="correctoption"]:hidden').val(data.correct_option);

                                        $('input[name="qid"]:hidden').val(data.id);


                                        let count = 1;
                                        $('#quest').text(++count + '.' + data.question);

                                        var html1 =
                                            '<p id ="opt1" class="col-sm-12" >' +
                                            '<input type="radio" name="option' + data.id + '" id="optionA' + data.id + '" value="A" >' +
                                            '<label for="optionA' + data.id + '">' + data.option_A + '</label>' +
                                            '</p>';


                                        var html2 = '<p id ="opt2" class="col-sm-12" >' +
                                            '<input type="radio" name="option' + data.id + '" id="optionB' + data.id + '" value="B" >' +
                                            '<label for="optionB' + data.id + '">' + data.option_B + '</label>' +
                                            '</p>';

                                        var html3 = '<p id ="opt3" class="col-sm-12" >' +
                                            '<input type="radio" name="option' + data.id + '" id="optionC' + data.id + '" value="C" >' +
                                            '<label for="optionC' + data.id + '">' + data.option_C + '</label>' +
                                            '</p>';
                                        var html4 = '<p id ="opt4" class="col-sm-12" >' +
                                            '<input type="radio" name="option' + data.id + '" id="optionD' + data.id + '" value="D" >' +
                                            '<label for="optionD' + data.id + '">' + data.option_D + '</label>' +
                                            '</p>';
                                        // }


                                        $('#opt1').replaceWith(html1);
                                        $('#opt2').replaceWith(html2);
                                        $('#opt3').replaceWith(html3);
                                        $('#opt4').replaceWith(html4);


                                    }
                                });
                            }
                        }
                    });


                    // console.log("current ability"+ABILITY);


                }
            });


            //alert("correctiopt"+correctoption);

            if ($('input[name=option' + questionId + ']:checked').val() == correctoption) {
                AddUserResponse(questionId, $('input[name=option' + questionId + ']:checked').val(), marks);
            } else {
                AddUserResponse(questionId, $('input[name=option' + questionId + ']:checked').val(), negmarks);

            }

        }

        // Skip Question
        function Skip($abs_qno, $arr) {
            let $current_subject = set_question[$abs_qno][1];
            let $current_question_id = set_question[$abs_qno][0];
            let $current_ques_no = $abs_qno;
            colors[$current_subject + '' + $current_question_id] = "#fb6560";
            //    alert($current_subject+''+$current_question_id);
            let present = document.getElementById('btn' + $current_question_id);
            if (present)
                document.getElementById('btn' + $current_question_id).style.background = "#fb6560";
            if (!set_question.hasOwnProperty(+$abs_qno + +1)) {
                return;
            }
            let $next_ques_no = +$abs_qno + +1;
            let $next_subject = set_question[$next_ques_no][1];
            let $next_question_id = set_question[$next_ques_no][0];
            if ({{$no-1}} == $next_ques_no
        )
            {
                $('.Finshexam').removeClass('hidden');
            }
            if ($current_subject != $next_subject) {
                change_selected_question($next_subject, $arr)
            }
            $('.hideme').addClass('hidden');
            //Next Subject & id
            $('#ques_block' + '' + $next_question_id).removeClass('hidden');
            $('.setqno').text($next_ques_no);
            $('.current_qusetion_no').val($next_ques_no);
            $('#current_selected_subject').val($next_subject);
            $("#display_selected_subject").text($next_subject);
        }

        // Reminder Question
        function Reminder($abs_qno, $arr) {
            let $current_subject = set_question[$abs_qno][1];
            let $current_question_id = set_question[$abs_qno][0];
            let $current_ques_no = $abs_qno;
            colors[$current_subject + '' + $current_question_id] = "#5bc0de";
            //    alert($current_subject+''+$current_question_id);
            let present = document.getElementById('btn' + $current_question_id);
            if (present)
                document.getElementById('btn' + $current_question_id).style.background = "#5bc0de";
            /*if (!set_question.hasOwnProperty(+$abs_qno + +1)) {
                return;
            }*/
            /*let $next_ques_no = +$abs_qno + +1;
            let $next_subject = set_question[$next_ques_no][1];
            let $next_question_id = set_question[$next_ques_no][0];
            if ({{$no-1}} == $next_ques_no)
            {
                $('.Finshexam').removeClass('hidden');
            }
            if ($current_subject != $next_subject) {
                change_selected_question($next_subject, $arr)
            }
            $('.hideme').addClass('hidden');
            //Next Subject & id
            $('#ques_block' + '' + $next_question_id).removeClass('hidden');
            $('.setqno').text($next_ques_no);
            $('.current_qusetion_no').val($next_ques_no);
            $('#current_selected_subject').val($next_subject);
            $("#display_selected_subject").text($next_subject);*/
        }

        // Previous Question
        function Previous($abs_qno, $arr) {
            let $current_subject = set_question[$abs_qno][1];
            let $current_question_id = set_question[$abs_qno][0];
            let $current_ques_no = $abs_qno;
            //     colors[$current_subject+''+$current_question_id] = "#5bc0de";
            //   document.getElementById($current_subject+''+$current_question_id).style.background = "#5bc0de";
            if (!set_question.hasOwnProperty(+$abs_qno - +1)) {
                return;
            }
            let $next_ques_no = +$abs_qno - +1;
            let $next_subject = set_question[$next_ques_no][1];
            let $next_question_id = set_question[$next_ques_no][0];
            if ($current_subject != $next_subject) {
                change_selected_question($next_subject, $arr)
            }
            $('.hideme').addClass('hidden');
            //Next Subject & id
            $('#ques_block' + '' + $next_question_id).removeClass('hidden');
            $('.setqno').text($next_ques_no);
            $('.current_qusetion_no').val($next_ques_no);
            $('#current_selected_subject').val($next_subject);
            $("#display_selected_subject").text($next_subject);
        }

        // Change Subject
        function change_selected_question($sub, $arr) {
            let $q = 1;
            $('#current_selected_subject').val($sub);
            $("#display_selected_subject").text($sub);
            $('.rearrange_q').text('');
            for (let k in $arr) {
                if ($sub == $arr[k].subject) {
                    $('.rearrange_q').append('<button id="btn' + $arr[k].id + '" class="btn btn-warning btn-icon circle-btn" >' + $q + '</button>')
                    document.getElementById('btn' + $arr[k].id).style.background =
                        colors[$sub + '' + $arr[k].id];
                    let s = "$('#btn" + $arr[k].id + "').on('click', function (e) { " +
                        "show_selected_question('" + $arr[k].subject + "','" + $arr[k].id + "','" + $q + "');" +
                        "});";
                    $('.rearrange_q').append("<script type='text\/javascript'>" + s
                        + "<\/script>");
                    //    set_question[$sub+''+$q] = $arr[k].id;
                }
                $q++;
            }
        }

        // Add AddUserResponse
        function AddUserResponse(ques_id, selected_option, givenmarks) {
            //    $("#add").addClass('hidden');
            //    $("#spin").removeClass('hidden');
            let data = new FormData();
            //    ques_id = 111;
            //    selected_option = "A";
            //    givenmarks = 1;
            data.append('ques_id', ques_id);
            data.append('selected_option', selected_option);
            data.append('givenmarks', givenmarks);
            data.append('examcode', '{{$examId}}');
            active_process = +active_process + +1;
            $("#active_process").removeClass('hidden');
            $.ajax({
                type: 'POST',
                url: '/adduserreponse',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                },
                data: data,
                contentType: false,
                processData: false,
                success: function (data) {
                    active_process = +active_process - +1;
                    if (active_process == 0) {
                        $("#active_process").addClass('hidden');
                    }
                    //     $("#add").removeClass('hidden');
                    //     $("#spin").addClass('hidden');
                    console.log("ABC");
                }
            }).fail(function (jqXHR, textStatus, error) {
                // Handle error here
                //alert(jqXHR); alert(textStatus);
                active_process = +active_process - +1;
                if (active_process == 0) {
                    $("#active_process").addClass('hidden');
                }
                $('#errorModal').modal('show');
                // $('.modal-title').text('Error !!!');
            });
        }

        function finish($questionId, $examCode, $studentId, $subjectType, $subjectId, $subjectLevel, $passMark, $subjectIdPk) {
            console.log("passmark"+$passMark);
            /* $.ajax({
                 type: "POST",
                 url: '/ajaxupdateexamcount',
                 beforeSend: function (xhr) {
                     xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                 },
                 data: {
                     'student_id': $studentId,
                     'examcode': $examCode,
                     'subjectLevel': $subjectLevel,
                     'subject_id': $subjectId,
                     'ispassed': 0,
                 },
                 success: function (result) {
                     console.log($questionId);
                 }
             });*/
            $.ajax({
                type: "POST",
                url: '/chespassorfaillevel',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                },
                data: {
                    'student_id': $studentId,
                    'examcode': $examCode,
                    'question_id': $questionId,
                },
                success: function (data) {
                    console.log(data);
                    let i = 0;
                    let calculated_marks = {};
                    let referencevalue = 0;
                    let question_id = 0;
                    let tot_marks = {};
                    //calculating the total marks
                    for (let k in data.level_result) {
                        //check if object has this property called k
                        if (data.level_result.hasOwnProperty(k)) {
                            i++;
                            //increase i+1
                            //calculate and keep each marks value for the correct answer
                            if (tot_marks.hasOwnProperty(data.level_result[k].student_id)) {
                                console.log("student_id=>" + tot_marks[data.level_result[k].student_id]);
                                tot_marks[data.level_result[k].student_id] = +tot_marks[data.level_result[k].student_id] + +data.level_result[k].givenmarks;
                                console.log("given_marks=>" + data.level_result[k].givenmarks);
                            }
                            else {
                                tot_marks[data.level_result[k].student_id] = data.level_result[k].givenmarks;
                                console.log("else" + data.level_result[k].givenmarks);
                            }
                            //sum up the total value
                            if (calculated_marks.hasOwnProperty(data.level_result[k].student_id + data.level_result[k].subject)) {
                                calculated_marks[data.level_result[k].student_id + data.level_result[k].subject] = +calculated_marks[data.level_result[k].student_id + data.level_result[k].subject] + +data.level_result[k].givenmarks;
                                console.log("calculated marks:" + calculated_marks[data.level_result[k].student_id + data.level_result[k].subject]);
                            }
                            else {
                                calculated_marks[data.level_result[k].student_id + data.level_result[k].subject] = data.level_result[k].givenmarks;
                            }
                            referencevalue = calculated_marks[data.level_result[k].student_id + data.level_result[k].subject];
                            question_id = calculated_marks[data.level_result[k].question_id + data.level_result[k].question_id];
                            console.log(calculated_marks[data.level_result[k].student_id + data.level_result[k].subject]);
                            console.log(calculated_marks[data.level_result[k].question_id + data.level_result[k].question_id])
                        }
                    }
                    console.log("passmark:" + $passMark);
                    console.log("obtainmarks:" + referencevalue);
                    $("#examover").removeClass('hidden');
                    $("#show_exam").addClass('hidden');
                    if (referencevalue >= $passMark) {
                        $("#pass_examover_footer").removeClass('hidden');
                        $("#examover_footer").addClass('hidden');
                        var title = document.getElementById('title');
                        var subtitle = document.getElementById('subtitle');
                        title.innerHTML = 'Congratulation Level Completed!';
                        subtitle.innerHTML = 'You can now try next Level.';
                        console.log($subjectType);
                        $.ajax({
                            type: "POST",
                            url: '/nextlevelsubject',
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                            },
                            data: {
                                'student_id': $studentId,
                                'subject_id': $subjectIdPk,
                                'examcode': $examCode,
                                'subjectLevel': $subjectLevel,
                            },
                            success: function (data) {
                                console.log($examCode);
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: '/ajaxupdateexamcount',
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                            },
                            data: {
                                'student_id': $studentId,
                                'examcode': $examCode,
                                'subjectLevel': $subjectLevel,
                                'subject_id': $subjectId,
                                'subject_passed': 1,
                            },
                            success: function (result) {
                                console.log($questionId);
                            }
                        });
                    }
                    else {
                        $("#examover").removeClass('hidden');
                        $("#show_exam").addClass('hidden');
                        $.ajax({
                            type: "POST",
                            url: '/ajaxupdateexamcount',
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                            },
                            data: {
                                'student_id': $studentId,
                                'examcode': $examCode,
                                'subjectLevel': $subjectLevel,
                                'subject_id': $subjectId,
                                'subject_passed': 0,
                            },
                            success: function (result) {
                                console.log($questionId);
                            }
                        });
                    }
                }
            });
        }

        function home() {
            $("#examover_footer").text("");
            $("#examover_footer").append('<i class="fa fa-spinner fa-spin" ></i> ' + " " + " Pls Wait... ");
            window.location.href = "/home";
        }

        function result() {
            $("#examover_footer").text("");
            $("#examover_footer").append('<i class="fa fa-spinner fa-spin" ></i> ' + " " + " Pls Wait... ");
            window.location.href = "/result";
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".create-model").click(function () {
                $('#create').modal('show');
                $('.form-horizontal').show();
                $('.modal-title').text('Add Student');
            });
        });
        $(document).ready(function () {
            $(".addsubject").click(function () {
                $('#addsubject').modal('show');
                $('.form-horizontal').show();
                $('.modal-title').text('Add Subject');
            });
        });
        //add_subject_to_db
        $(document).ready(function () {
            $("#add_subject_to_db").click(function () {
                $("#add_subject_to_db").addClass('hidden');
                $("#add_subject_to_db_spin").removeClass('hidden');
                $('#add_subject_msg').text("Processing ... ");
                $.ajax({
                    type: 'POST',
                    url: '/Addquestiontodb',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                    },
                    data: {
                        'subject': $('input[name=subject]').val(),
                        'examcode': $('input[name=examcode]').val(),
                        'admin_id': $('input[name=admin_id]').val(),
                        'admin_email': $('input[name=admin_email]').val(),
                    },
                    success: function (data) {
                        $("#add_subject_to_db").removeClass('hidden');
                        $("#add_subject_to_db_spin").addClass('hidden');
                        $('.subject_error').addClass('hidden');
                        if ((data.errors)) {
                            $('#add_subject_msg').text("Error Encounter !!! ");
                            if ((data.errors.subject)) {
                                $('.subject_error').removeClass('hidden');
                                $('.subject_error').text(data.errors.subject);
                            }
                            else {
                                $('#add_subject_msg').text("Unknown Error !!! ");
                            }
                        } else {
                            $('.dropdown-subject').append('<a class="dropdown-item" onclick="set_current_subject(\'' + data.subject + '\',' + data.id + ')" href="#">' + data.subject + '</a>');
                            $('#add_subject_msg').text("Subject Successfully Added");
                            $('#subject').val('');
                        }
                    }
                })
            });
        });
        $(document).ready(function () {
            $(".show_add_question-model").click(function () {
                if ($('#current_subject_id').val() == '') {
                    //   alert("Pls. Add / Select Subject");
                    $('#alert_msg').modal('show');
                    $('.form-horizontal').show();
                    $('.modal-title').text('Warring');
                    $('#alert_msg_show').text('Pls Add / Select Subject');
                    return;
                }
                $('#MathPreview').text("");
                $('#MathBuffer').text("");
                $('#OptionDPreview').text("");
                $('#OptionCPreview').text("");
                $('#OptionBPreview').text("");
                $('#OptionPreview').text("");
                $("#addquestion").removeClass('hidden');
                $('#OptionDBuffer').text("");
                $('#OptionCBuffer').text("");
                $('#OptionBBuffer').text("");
                $('#OptionBuffer').text("");
                $('#show_img').addClass('hidden');
                $('#option_A').val('');
                $('#option_B').val('');
                $('#option_C').val('');
                $('#option_D').val('');
                $('#MathInput').val('');
                $('#marks').val('');
                $('#negative_marks').val('0');
                $('#correct_option').val('A');
                $('#level').val('none');
                Preview.Init();
                PreviewA.InitA();
                PreviewB.InitB();
                PreviewC.InitC();
                PreviewD.InitD();
                $('#create_question-model').modal('show');
                $('.form-horizontal').show();
                $('.modal-title').text('Add Question');
            });
        });

        function set_current_subject($sub, $id) {
            $('#current_subject_id').val($id);
            $('#current_subject_name').val($sub);
            $('#subject_button').text($sub);
        }

        function DisplayQuestion($no, $id, $question, $A, $B, $C, $D, $m, $nm, $co, $l, $image) {
            $('#show_selected_question-model').modal('show');
            $('.modal-title').text('Question ');
            $('#A').text($A);
            $('#B').text($B);
            $('#C').text($C);
            $('#D').text($D);
            $('#qno').text("Ques no. " + $no + " : ");
            $('#q').text($question);
            $('#M').text($m);
            $('#NM').text($nm);
            $('#CO').text($co);
            $('#L').text($l);
        }

        function EditQuestion($no, $id, $question, $A, $B, $C, $D, $m, $nm, $co, $l, $image) {
            $('#MathPreview').text("");
            $('#MathBuffer').text("");
            $('#OptionDPreview').text("");
            $('#OptionCPreview').text("");
            $('#OptionBPreview').text("");
            $('#OptionPreview').text("");
            $('#OptionDBuffer').text("");
            $('#OptionCBuffer').text("");
            $('#OptionBBuffer').text("");
            $('#OptionBuffer').text("");
            $('#show_img').addClass('hidden');
            $('#option_A').val($A);
            $('#option_B').val($B);
            $('#option_C').val($C);
            $('#option_D').val($D);
            $('#edit_qno').val("Ques no. " + $no + " : ");
            $('#MathInput').val($question);
            $('#marks').val($m);
            $('#negative_marks').val($nm);
            $('#correct_option').val($co);
            $('#level').val($l);
            $img = "images/" + $image;
            if ($image) {
                $('#show_img').text('');
                $('#show_img').removeClass('hidden');
                //    $('#show_img').append("<img id=\"ques_image\" src=\"{{ asset('assets/images/avatar-4.jpg')}}\" >");
                $('#show_img').append("<img class=\"img-responsive center-block\" src=\"{{ asset('images/')}}" + '/' + $image + "\">");
            }
            //  $('#ques_image').attr('src','{{ asset('+$img+')}}');
            Preview.Init();
            PreviewA.InitA();
            PreviewB.InitB();
            PreviewC.InitC();
            PreviewD.InitD();
            $("#addquestion").addClass('hidden');
            $('#create_question-model').modal('show');
            $('.form-horizontal').show();
            $('.modal-title').text('Add Question');
        }

        function viewdetil(name, student_id, admin_id, created_at, validity) {
            //          console.log(d.fee);
            $('#show').modal('show');
            $('.modal-title').text('Student Detail');
            $('#view_name').text(name);
            $('#view_student_id').text(student_id);
            $('#view_institution_id').text(admin_id);
            $('#view_created_at').text(created_at);
            $('#view_validity').text(validity);
        }

        function Editdetail(id, name, student_id) {
            //        console.log(d.fee);
            $('#edit').modal('show');
            $('.modal-title').text('Change Password');
            $('#uid').val(id);
            $('#uname').val(name);
            $('#ustudent_id').val(student_id);
        }

        function Delete_user(id, name, student_id) {
            // console.log(d.fee);
            $('#delete').modal('show');
            $('.modal-title').text('Are your sure want to delete');
            $('#delete_id').text(id);
            $('#did').val(id);
            $('#delete_name').text(name);
            $('#delete_student_id').text(student_id);
        }

        // Add Question
        $(document).ready(function () {
            $("#addquestion").click(function () {
                $("#addquestion").addClass('hidden');
                $("#add_question_spin").removeClass('hidden');
                $('#add_question_msg').text("Processing ...");
                let data = new FormData();
                data.append('question', $('textarea[name=question]').val());
                data.append('option_A', $('input[name=option_A]').val());
                data.append('option_B', $('input[name=option_B]').val());
                data.append('option_C', $('input[name=option_C]').val());
                data.append('option_D', $('input[name=option_D]').val());
                data.append('marks', $('input[name=marks]').val());
                data.append('category', $('input[name=category]').val());
                data.append('examcode', $('input[name=examcode]').val());
                data.append('subject_code', $('input[name=current_subject_id]').val());
                data.append('subject', $('input[name=current_subject_name]').val());
                data.append('image', $('#image')[0].files[0]);
                data.append('negative_marks', $('input[name=negative_marks]').val());
                data.append('admin_email', $('input[name=admin_email]').val());
                data.append('admin_id', $('input[name=admin_id]').val());
                data.append('correct_option', $('select[name=correct_option]').val());
                data.append('level', $('select[name=level]').val());
                //     let postData = new FormData($("#modal_form_id")[0]);
                //     postData.append('subject_code': $('input[name=current_subject_id]').val(),
                //     'subject': $('input[name=current_subject_name]').val(),);
                $.ajax({
                    type: 'POST',
                    url: '/addquestion',
                    data: data,
                    contentType: false,
                    processData: false,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                    },
                    success: function (data) {
                        $("#addquestion").removeClass('hidden');
                        $("#add_question_spin").addClass('hidden');
                        $('.question_error').addClass('hidden');
                        $('.option_A_error').addClass('hidden');
                        $('.option_B_error').addClass('hidden');
                        $('.option_C_error').addClass('hidden');
                        $('.option_D_error').addClass('hidden');
                        $('.marks_error').addClass('hidden');
                        $('.negative_marks_error').addClass('hidden');
                        if ((data.errors)) {
                            if ((data.errors.question)) {
                                $('.question_error').removeClass('hidden');
                                $('.question_error').text(data.errors.question);
                            }
                            else if ((data.errors.option_A)) {
                                $('.option_A_error').removeClass('hidden');
                                $('.option_A_error').text(data.errors.option_A);
                            }
                            else if ((data.errors.option_B)) {
                                $('.option_B_error').removeClass('hidden');
                                $('.option_B_error').text(data.errors.option_B);
                            }
                            else if ((data.errors.option_C)) {
                                $('.option_C_error').removeClass('hidden');
                                $('.option_C_error').text(data.errors.option_C);
                            }
                            else if ((data.errors.option_D)) {
                                $('.option_D_error').removeClass('hidden');
                                $('.option_D_error').text(data.errors.option_D);
                            }
                            else if ((data.errors.marks)) {
                                $('.marks_error').removeClass('hidden');
                                $('.marks_error').text(data.errors.marks);
                            }
                            else if ((data.errors.negative_marks)) {
                                $('.negative_marks_error').removeClass('hidden');
                                $('.negative_marks_error').text(data.errors.negative_marks);
                            }
                            else {
                                $('#add_question_msg').text("Error : " + data.errors);
                            }
                        } else {
                            $('#add_question_msg').text("Question Successfully Added");
                            $('#MathInput').val('');
                            $('#option_A').val('');
                            $('#option_B').val('');
                            $('#option_C').val('');
                            $('#option_D').val('');
                            $('#marks').val('');
                            $('#negative_marks').val('');
                            $('#image').val('');
                            $('#correct_option').val('A');
                            console.log("ABC");
                        }
                    }
                })
            });
        });
        //Update Student Password
        $(document).ready(function () {
            $("#update").click(function () {
                $("#update").addClass('hidden');
                $("#upspin").removeClass('hidden');
                $.ajax({
                    type: 'POST',
                    url: 'ChangePassword',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                    },
                    data: {
                        'id': $('input[name=uid]').val(),
                        'name': $('input[name=uname]').val(),
                        'student_id': $('input[name=ustudent_id]').val(),
                        'password': $('input[name=upassword]').val(),
                        'password_confirmation': $('input[name=upassword_confirmation]').val(),
                    },
                    success: function (data) {
                        $("#update").removeClass('hidden');
                        $("#upspin").addClass('hidden');
                        $('.uname_error').addClass('hidden');
                        $('.ustudent_id_error').addClass('hidden');
                        $('.upass_error').addClass('hidden');
                        if ((data.errors)) {
                            if ((data.errors.student_id)) {
                                $('.ustudent_id_error').removeClass('hidden');
                                $('.ustudent_id_error').text(data.errors.student_id);
                            }
                            else {
                                $('.ustudent_id_error').addClass('hidden');
                            }
                            if ((data.errors.name)) {
                                $('.uname_error').removeClass('hidden');
                                $('.uname_error').text(data.errors.name);
                            }
                            else {
                                $('.uname_error').addClass('hidden');
                            }
                            if ((data.errors.password)) {
                                $('.upass_error').removeClass('hidden');
                                $('.upass_error').text(data.errors.password);
                            }
                            else {
                                $('.upass_error').addClass('hidden');
                            }
                        } else {
                            $('#umsg').text("Student Successfully Added");
                            //    $('#uname').val('');
                            //    $('#ustudent_id').val('');
                            //    $('#upassword').val('');
                            //    $('#upassword_confirmation').val('');
                            console.log("ABC");
                        }
                    }
                })
            });
        });
        //Delete Student
        $(document).ready(function () {
            $("#delete").click(function () {
                $("#delete").addClass('hidden');
                $("#dspin").removeClass('hidden');
                console.log($("#delete_id").val())
                $.ajax({
                    type: 'POST',
                    url: 'RemoveStudent',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                    },
                    data: {
                        'id': $('input[name=did]').val(),
                    },
                    success: function (data) {
                        $("#delete").removeClass('hidden');
                        $("#dspin").addClass('hidden');
                        console.log('ABCD', $('.student' + $('.id').val()));
                        $('.student' + $('#did').val()).remove();
                        //    $('#dmsg').text("Student Record Successfully Deleted");
                        $('#delete').modal('hide');
                    }
                })
            });
        });
    </script>

    <script type="text/javascript">
        function create_new_exam() {
            $('#add_new_exam').modal('show');
            $('.modal-title').text('Create Exam');
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#addexam").click(function () {
                $("#addexam").addClass('hidden');
                $("#aespin").removeClass('hidden');
                $.ajax({
                    type: 'POST',
                    url: 'addexam',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                    },
                    data: {
                        'tname': $('input[name=tname]').val(),
                        'examtitle': $('input[name=examtitle]').val(),
                        'admin_id': $('input[name=admin_id]').val(),
                        'admin_email': $('input[name=admin_email]').val(),
                        'category': $('select[name=category]').val(),
                        'examtime': $('input[name=examtime]').val(),
                    },
                    success: function (data) {
                        console.log(data);
                        $('.tname_error').addClass('hidden');
                        $('.examtitle_error').addClass('hidden');
                        $('.examtime_error').addClass('hidden');
                        if ((data.errors)) {
                            $("#addexam").removeClass('hidden');
                            $("#aespin").addClass('hidden');
                            if ((data.errors.tname)) {
                                $('.tname_error').removeClass('hidden');
                                $('.tname_error').text(data.errors.tname);
                            }
                            else if ((data.errors.examtitle)) {
                                $('.examtitle_error').removeClass('hidden');
                                $('.examtitle_error').text(data.errors.examtitle);
                            }
                            else if ((data.errors.examtime)) {
                                $('.examtime_error').removeClass('hidden');
                                $('.examtime_error').text(data.errors.examtime);
                            }
                            else {
                                $('#create_exam_error_msg').text("Unknown Error Encounter! Fill detail correctly");
                            }
                        } else {
                            $('#create_exam_error_msg').text("Exam Added, Redirecting...");
                            $('#aespin').text("Redirecting ....");
                            //  alert(data.examcode);
                            $('#name').val('');
                            $('#student_id').val('');
                            $('#password').val('');
                            $('#password_confirmation').val('');
                            window.location.href = "/addquestion/examcode/" + data.id + "/" + data.examtitle + "/" + data.tname + "/" + data.category + "/" + data.examtime;
                        }
                    }
                })
            });
        });
    </script>
@endsection