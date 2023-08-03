<?php
session_start();
include "../../others/include/conn.php";
$test_id = $_POST["id-t"];
$number_of_subjects;
$name_of_subjects;
$per_subject_question;
$question;
$options;
$duration;

$sql = "select * from paper where test_id= '$test_id'";
$result = mysqli_query($con, $sql);
while ($pass = mysqli_fetch_assoc($result)) {
    $number_of_subjects = $pass['number_of_subjects'];
    $name_of_subjects = $pass['name_of_subjects'];
    $per_subject_question = $pass['per_subject_question'];
    $question = $pass['question'];
    $options = $pass['options'];
    $duration = $pass['duration'];
}

$total = 0;
$string = " ";
for ($i = 0; $i < strlen($per_subject_question); $i++) {
    if ($per_subject_question[$i] != "*") {
        $string = $string . $per_subject_question[$i];
    } else {
        $total = $total + (int)$string;
        $string = " ";
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
    <link rel="stylesheet" type="text/css" href="../style/testPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../../others/files/jquery-3.6.0.js"></script>
</head>

<body>
    <div id="screen">
        <div id="head">

            <div id="timer">
                <div id="m-course">JEE Test #345A</div><br>
                <div id="time"></div>
            </div>
            <div id="course">JEE Test #345A<br>by teacher name</div>
            <div id="profile">Student name<br>
                <button id="sbmt" class="final" onclick="ask()">Submit</button>
            </div>
        </div>
        <div id="box">
            <div id="paper">
                <div id="question">
                    <p><b> Question. <span id="qn"></span>:</b></p>
                    <p id="q"></p>
                </div>
                <div id="options">
                    <div class="op" id="op1" onclick="selectBox(this)">
                        (a)<input class="opt" type="radio" name="q0" id="b1"><span class="oo" id="o1"></span>
                    </div>
                    <div class="op" id="op2" onclick="selectBox(this)">
                        (b)<input class="opt" type="radio" name="q0" id="b2"><span class="oo" id="o2"></span>
                    </div>
                    <div class="op" id="op3" onclick="selectBox(this)">
                        (c)<input class="opt" type="radio" name="q0" id="b3"><span class="oo" id="o3"></span>
                    </div>
                    <div class="op" id="op4" onclick="selectBox(this)">
                        (d)<input class="opt" type="radio" name="q0" id="b4"><span class="oo" id="o4"></span>
                    </div>
                </div>
            </div>
            <div id="status">
                <div id="mark">
                    <?php
                    for ($i = 0; $i < $total; $i++) { ?>
                        <button id="m<?php echo $i; ?>" class="m" onclick="show(this)"><?php echo $i + 1; ?></button>
                    <?php
                    }
                    ?>
                </div>
                <div id="final">

                </div>
            </div>
        </div>
        <div id="buttons">

            <button class="btn" id="rlbtn" onclick="review()">review later</button>
            <button class="btn" id="clbtn" onclick="clears()">clear</button>
            <button class="btn" id="pqbtn" onclick="previous()">previous question</button>
            <button class="btn" id="snbtn" onclick="SaveNext()">save and next</button>
            <button class="btn" id="nbtn" onclick="next()">next</button>

        </div>
        <div id="m-buttons">
            <button class="m-btn" id="m-pqbtn" onclick="previous()"><i class="fa fa-angle-left"></i></button>
            <button class="m-btn" id="m-rlbtn" onclick="review()">review</button>
            <button class="m-btn" id="m-clbtn" onclick="clears()">clear</button>
            <button class="m-btn" id="m-snbtn" onclick="SaveNext()">save & next</button>
            <button class="m-btn" id="m-nbtn" onclick="next()">
                <i class="fa fa-angle-right"></i>
            </button>

        </div>
        <button id="m-status" onclick="showStatus()"><i class="fa fa-bolt"></i></button>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Are you sure to submit your paper?</p>
            <input type="radio" id="yes" name="yes" onclick="toggle()">Yes I am ready to submit<br>
            <button id="final" onclick="submit_exam_before()">yes submit</button>
        </div>

    </div>

    <script type="text/javascript">
        const subject = [];
        const question = [];
        const options = [];
        const answers = [];
        const status = [];
        var qs = 0;
        var num_qs = 0;
    </script>

    <?php

    $string = " ";
    for ($i = 0; $i < strlen($name_of_subjects); $i++) {
        if ($name_of_subjects[$i] != "*") {
            $string = $string . $name_of_subjects[$i];
        } else {
    ?>
            <script type="text/javascript">
                subject.push("<?php echo $string; ?>");
            </script>
    <?php
            $string = " ";
        }
    }

    ?>
    <?php

    $string = " ";
    for ($i = 0; $i < strlen($question); $i++) {
        if ($question[$i] != "*") {
            $string = $string . $question[$i];
        } else {
    ?>
            <script type="text/javascript">
                console.log("<?php echo $string; ?>");
                var str = "<?php echo $string; ?>";
                var finalstr = " ";
                for (var j = 0; j < str.length; j++) {
                    if (str[j + 1] + str[j + 2] + str[j + 3] == "%20") {
                        finalstr = finalstr + "'";
                        j = j + 3;
                        continue;
                    } else {
                        finalstr = finalstr + str[j];
                    }
                }
                console.log(finalstr);
                question.push(finalstr);
                num_qs++;
            </script>
    <?php
            $string = " ";
        }
    }

    ?>
    <?php

    $string = " ";
    for ($i = 0; $i < strlen($options); $i++) {
        if ($options[$i] != "*") {
            $string = $string . $options[$i];
        } else {
    ?>
            <script type="text/javascript">
                var opt = "<?php echo $string; ?>";
                var finalstr = " ";
                for (var j = 0; j < opt.length; j++) {
                    if (opt[j + 1] + opt[j + 2] + opt[j + 3] == "%20") {
                        finalstr = finalstr + "'";
                        j = j + 3;
                        continue;
                    } else if (opt[j + 1] + opt[j + 2] + opt[j + 3] == "%21") {
                        options.push(finalstr);
                        finalstr = " ";
                        j = j + 3;
                        continue;
                    } else {
                        finalstr = finalstr + opt[j];
                    }
                }
            </script>
    <?php
            $string = " ";
        }
    }

    ?>

    <script type="text/javascript">
        console.log(question[0]);
        for (var i = 0; i < num_qs; i++) {
            answers.push(0);
            status.push(0);
        }
    </script>

    <script type="text/javascript">
        function color() {
            var clr;
            if (status[qs] == 0) {
                clr = "red";
            }
            if (status[qs] == 1) {
                clr = "green";
            }
            if (status[qs] == 2) {
                clr = "blue";
            }
            if (status[qs] == 3) {
                clr = "purple";
            }
            document.getElementById("m" + qs).style.backgroundColor = clr;
        }
    </script>

    <script type="text/javascript">
        document.getElementById('qn').innerHTML = qs + 1;
        document.getElementById('q').innerHTML = question[qs];
        document.getElementById('o1').innerHTML = options[qs * 4 + 0];
        document.getElementById('o2').innerHTML = options[qs * 4 + 1];
        document.getElementById('o3').innerHTML = options[qs * 4 + 2];
        document.getElementById('o4').innerHTML = options[qs * 4 + 3];
        status[qs] = 1;
        color();


        function SaveNext() {

            var selected = 0;
            if (document.getElementById("b1").checked) {
                selected = 1;
            }
            if (document.getElementById("b2").checked) {
                selected = 2;
            }
            if (document.getElementById("b3").checked) {
                selected = 3;
            }
            if (document.getElementById("b4").checked) {
                selected = 4;
            }
            answers[qs] = selected;
            if (selected != 0) {
                status[qs] = 2;
                color();
            }

            if (qs != num_qs - 1) {
                qs++;
            } else {
                qs = 0;
            }
            document.getElementById('b1').setAttribute("name", "q" + qs);
            document.getElementById('b2').setAttribute("name", "q" + qs);
            document.getElementById('b3').setAttribute("name", "q" + qs);
            document.getElementById('b4').setAttribute("name", "q" + qs);
            document.getElementById('qn').innerHTML = qs + 1;
            document.getElementById('q').innerHTML = question[qs];
            document.getElementById('o1').innerHTML = options[qs * 4 + 0];
            document.getElementById('o2').innerHTML = options[qs * 4 + 1];
            document.getElementById('o3').innerHTML = options[qs * 4 + 2];
            document.getElementById('o4').innerHTML = options[qs * 4 + 3];

            document.getElementById("b1").checked = false;
            document.getElementById("b2").checked = false;
            document.getElementById("b3").checked = false;
            document.getElementById("b4").checked = false;
            if (status[qs] == 0) {
                status[qs] = 1;
                color();
            }
            if (answers[qs] != 0) {
                document.getElementById("b" + answers[qs]).checked = true;
            }
            backgroundChange();
        }

        function previous() {
            var selected = 0;
            if (document.getElementById("b1").checked) {
                selected = 1;
            }
            if (document.getElementById("b2").checked) {
                selected = 2;
            }
            if (document.getElementById("b3").checked) {
                selected = 3;
            }
            if (document.getElementById("b4").checked) {
                selected = 4;
            }
            answers[qs] = selected;
            if (qs == 0) {
                qs = num_qs - 1;
            } else {
                qs--;
            }
            document.getElementById('b1').setAttribute("name", "q" + qs);
            document.getElementById('b2').setAttribute("name", "q" + qs);
            document.getElementById('b3').setAttribute("name", "q" + qs);
            document.getElementById('b4').setAttribute("name", "q" + qs);
            document.getElementById('qn').innerHTML = qs + 1;
            document.getElementById('q').innerHTML = question[qs];
            document.getElementById('o1').innerHTML = options[qs * 4 + 0];
            document.getElementById('o2').innerHTML = options[qs * 4 + 1];
            document.getElementById('o3').innerHTML = options[qs * 4 + 2];
            document.getElementById('o4').innerHTML = options[qs * 4 + 3];
            document.getElementById("b1").checked = false;
            document.getElementById("b2").checked = false;
            document.getElementById("b3").checked = false;
            document.getElementById("b4").checked = false;

            if (answers[qs] != 0) {
                document.getElementById("b" + answers[qs]).checked = true;
            }
            backgroundChange();
            if (status[qs] == 0) {
                status[qs] = 1;
                color();
            }

        }

        function clears() {
            answers[qs] = 0;
            status[qs] = 1;
            color();
            document.getElementById("b1").checked = false;
            document.getElementById("b2").checked = false;
            document.getElementById("b3").checked = false;
            document.getElementById("b4").checked = false;
            backgroundChange();
        }

        function next() {
            if (qs != num_qs - 1) {
                qs++;
            } else {
                qs = 0;
            }
            document.getElementById('b1').setAttribute("name", "q" + qs);
            document.getElementById('b2').setAttribute("name", "q" + qs);
            document.getElementById('b3').setAttribute("name", "q" + qs);
            document.getElementById('b4').setAttribute("name", "q" + qs);
            document.getElementById('qn').innerHTML = qs + 1;
            document.getElementById('q').innerHTML = question[qs];
            document.getElementById('o1').innerHTML = options[qs * 4 + 0];
            document.getElementById('o2').innerHTML = options[qs * 4 + 1];
            document.getElementById('o3').innerHTML = options[qs * 4 + 2];
            document.getElementById('o4').innerHTML = options[qs * 4 + 3];

            document.getElementById("b1").checked = false;
            document.getElementById("b2").checked = false;
            document.getElementById("b3").checked = false;
            document.getElementById("b4").checked = false;

            if (answers[qs] != 0) {
                document.getElementById("b" + answers[qs]).checked = true;
            }
            backgroundChange();
            if (status[qs] == 0) {
                status[qs] = 1;
                color();
            }
        }

        function review() {
            var selected = 0;
            if (document.getElementById("b1").checked) {
                selected = 1;
            }
            if (document.getElementById("b2").checked) {
                selected = 2;
            }
            if (document.getElementById("b3").checked) {
                selected = 3;
            }
            if (document.getElementById("b4").checked) {
                selected = 4;
            }
            answers[qs] = selected;
            status[qs] = 3;
            color();
            backgroundChange();
        }
    </script>

    <script type="text/javascript">
        var count = <?php echo $duration; ?>;
        var h;
        var m;
        var s;
        var interval = setInterval(function() {
            h = parseInt(count / 3600);
            m = parseInt((count / 60) % 60);
            s = parseInt(count % 60);
            if (h < 10) {
                h = "0" + h;
            }
            if (m < 10) {
                m = "0" + m;
            }
            if (s < 10) {
                s = "0" + s;
            }
            document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
            count--;
            if (count === 0) {
                clearInterval(interval);
                document.getElementById('time').innerHTML = 'Done';
                submit_exam();
                document.getElementById('screen').innerHTML = "time is out";
            }
        }, 1000);
    </script>
    <script type="text/javascript">
        function show(qid) {
            var idr = qid.id;
            var ids = idr.substring(1);
            qs = parseInt(ids);
            document.getElementById('b1').setAttribute("name", "q" + qs);
            document.getElementById('b2').setAttribute("name", "q" + qs);
            document.getElementById('b3').setAttribute("name", "q" + qs);
            document.getElementById('b4').setAttribute("name", "q" + qs);
            document.getElementById('qn').innerHTML = qs + 1;
            document.getElementById('q').innerHTML = question[qs];
            document.getElementById('o1').innerHTML = options[qs * 4 + 0];
            document.getElementById('o2').innerHTML = options[qs * 4 + 1];
            document.getElementById('o3').innerHTML = options[qs * 4 + 2];
            document.getElementById('o4').innerHTML = options[qs * 4 + 3];

            document.getElementById("b1").checked = false;
            document.getElementById("b2").checked = false;
            document.getElementById("b3").checked = false;
            document.getElementById("b4").checked = false;

            if (answers[qs] != 0) {
                document.getElementById("b" + answers[qs]).checked = true;
            }
            if (status[qs] == 0) {
                status[qs] = 1;
                color();
            }
        }
    </script>
    <script type="text/javascript">
        function submit_exam_before() {
            var bcheck = document.getElementById("yes");
            if (bcheck.checked) {
                submit_exam();
                document.getElementById("myModal").style.display = "none";
                clearInterval(interval);
                document.getElementById("screen").innerHTML = "You have submitted your exam<br> Now you can close the window";
            }
        }

        function submit_exam() {
            var ans = answers[0] + "*";
            for (var i = 1; i < num_qs; i++) {
                ans = ans + answers[i] + "*";
            }
            $.ajax({
                url: "../processes/submit_exam.php",
                method: "post",
                data: {
                    idq: ans
                },
                success: function getdata(result) {
                    console.log(result);
                }
            })
        }
    </script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function ask() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script type="text/javascript">
        var flag = 0;

        function toggle() {
            var bbb = document.getElementById("yes");
            if (flag == 0) {
                bbb.checked = true;
                flag = 1;
            } else {
                bbb.checked = false;
                flag = 0;
            }
        }
        var ms = 0;

        function showStatus() {
            var btn = document.getElementById('m-status');
            var status_box = document.getElementById('status');
            if (ms == 0) {
                btn.innerHTML = '<i class="fa fa-close"></i>';
                status_box.style.display = "block";
                ms = 1;
            } else {
                btn.innerHTML = '<i class="fa fa-bolt"></i>';
                status_box.style.display = "none";
                ms = 0;
            }

        }

        function selectBox(box) {
            var bid = box.id;
            if (bid == "op1") {
                if (document.getElementById("b1").checked == true) {
                    document.getElementById("b1").checked = false;
                } else {
                    document.getElementById("b1").checked = true;
                }
            }
            if (bid == "op2") {
                if (document.getElementById("b2").checked == true) {
                    document.getElementById("b2").checked = false;
                } else {
                    document.getElementById("b2").checked = true;
                }
            }
            if (bid == "op3") {
                if (document.getElementById("b3").checked == true) {
                    document.getElementById("b3").checked = false;
                } else {
                    document.getElementById("b3").checked = true;
                }
            }
            if (bid == "op4") {
                if (document.getElementById("b4").checked == true) {
                    document.getElementById("b4").checked = false;
                } else {
                    document.getElementById("b4").checked = true;
                }
            }
            backgroundChange();
        }

        function backgroundChange() {
            if (document.getElementById("b1").checked == true) {
                document.getElementById("op1").style.backgroundColor = "powderblue";
            } else {
                document.getElementById("op1").style.backgroundColor = "white";
            }
            if (document.getElementById("b2").checked == true) {
                document.getElementById("op2").style.backgroundColor = "powderblue";
            } else {
                document.getElementById("op2").style.backgroundColor = "white";
            }
            if (document.getElementById("b3").checked == true) {
                document.getElementById("op3").style.backgroundColor = "powderblue";
            } else {
                document.getElementById("op3").style.backgroundColor = "white";
            }
            if (document.getElementById("b4").checked == true) {
                document.getElementById("op4").style.backgroundColor = "powderblue";
            } else {
                document.getElementById("op4").style.backgroundColor = "white";
            }
        }
    </script>
</body>
</html>