<?php
session_start();

//require "php/managingTask.php";

if(!isset($_SESSION["userId"])){
    echo "<h1>you cant access to this page you need to log in first !!</h1>";
}

else{
    $userId = $_SESSION["email"];
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="MaterialDesign/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="materialize/css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <title>To Do List</title>
    </head>

    <body>

        <!--################################################################################-->

        <div class="navbar-fixed topOfAll">
            <nav>
                <div class="nav-wrapper #006064 cyan darken-4">
                <a href="#" onclick="logout()"> خروج</a>
                        <button class="btn"onclick="display()">Add Note </button>
                        <div class="weblogo right margin-left-auto">
                            <a href="#!" class="brand-logo">لیست کارها</a>
                        </div>

                </div>
            </nav>
        </div>
        <!--################################################################################-->

        <div class="row frame hide " id="noteFrame">

            <form class="col s12 m12 l12 ">
                <div class="card-panel ">
                    <div class="row">
                        <p class="align-right margin-left-auto">ثبت یادداشت</p>
                        <form action="#">
                            <p>
                                <input type="checkbox" id="test5" onclick="setTaskType()" />
                                <label for="test5">عمومی</label>
                            </p>
                        </form>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="subject" type="text" class="validate">
                            <label for="first_name">موضوع</label>
                        </div>

                        <div class="input-field col s6">
                            <input id="date" type="text" class="datepicker">
                            <label for="first_name">تاریخ اتمام</label>
                        </div>
                    </div>

                    <div class="input-field col s12">
                        <input id="note" type="text" class="validate">
                        <label for="last_name">شرح</label>
                    </div>

                    <button class="btn waves-effect waves-light" type="button" onclick="assignTask()">Submit
                    </button>
                </div>
            </form>

        </div>


        <!--################################################################################-->

        <div class="row" id="taskDisplay">
            <div class="col s12 m6 l4 right margin-left-auto">
                <h6 class="center-align"> خصوصی</h6>
                <div id="displayPrivateTasks"></div>
            </div>


            <div class="col s12 m6 l4 right margin-left-auto">
                <h6 class="center-align">عمومی</h6>
                <div id="displayPublicTasks"></div>
            </div>
            <div class="col s12 m6 l4 right margin-left-auto">
                <h6 class="center-align">انجام شده</h6>
                <div id="displayFinishedTasks"></div>
            </div>
        </div>

        <!--################################################################################-->

        <script type="text/javascript" src="jquery_library/jquery-3.2.1.js"></script>
        <script id="materilize" type='text/javascript' src="materialize/js/materialize.js"></script>
        <script type="text/javascript" src="JS/monitor.js"></script>
        <script type="text/javascript" src="JS/managingTask.js"></script>
        <?php } ?>
    </body>

    </html>