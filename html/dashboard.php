<?php
session_start();
if (!isset($_SESSION["email"])){
    readfile('blockPage.html');
}

else{
$admin = $_SESSION["admin"];

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link href="../MaterialDesign/css/materialDesignIcons.min.css" rel="stylesheet" type="text/css">
    <title>To Do List</title>
</head>

<body class="bg-color-1">

<!--###################################################################################################-->
<nav class="navbar navbar-expand-lg navbar-light bg-light box-shadow-4">
    <a class="navbar-brand" href="#">Forgetful Peach</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><?php echo $_SESSION["email"]; ?></a>
            </li>

        </ul>
        <button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#addTask">
            Add Task
        </button>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">Search</button>
        </form>
        <button class="btn btn-danger btn-sm my-2 my-sm-0 ml-2" type="submit" onclick="logout()">Log out</button>
    </div>
</nav>
<!--###################################################################################################-->

<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">Add Your Task Here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-secondary active btn-sm">
                        <input type="radio" name="options" id="option2" autocomplete="off" onfocus="setTaskType(0)">
                        Private
                    </label>
                    <label class="btn btn-secondary btn-sm">
                        <input type="radio" name="options" id="option3" autocomplete="off" onfocus="setTaskType(1)">
                        Public
                    </label>
                </div>
                <div>
                    <div class="row">
                        <div class="col-sm-8 form-group">
                            <label class="col-form-label" for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Type subject here">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="deadLine"> Dead Line </label>
                            <input type="text" class="form-control" id="deadLine" placeholder="22-12-2017">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">note</label>
                        <textarea class="form-control" id="note" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="assignTask()">Save Task</button>
            </div>
        </div>
    </div>
</div>

<!--###################################################################################################-->

<div class="row  p-3" id="taskDisplay">
    <!----------------------------------------------------------------------------------------->
    <div class="col-sm-4 mt-3 mb-3">
        <div class="bg-lightGray rounded p-2">
            <div class="alert alert-danger p-1 " role="alert">
                Private Tasks
            </div>
            <div id="displayPrivateTasks" data-spy="scroll">

            </div>
        </div>
    </div>
    <!----------------------------------------------------------------------------------------->
    <div class="col-sm-4 mt-3 mb-3">
        <div class="bg-lightGray rounded p-2">
            <div class="alert alert-primary p-1 " role="alert">
                Public Tasks
            </div>
            <div id="displayPublicTasks" data-spy="scroll" data-offset="0"></div>
        </div>
    </div>
    <!----------------------------------------------------------------------------------------->
    <div class="col-sm-4 mt-3 mb-3">
        <div class="bg-lightGray rounded p-2">
            <div class="alert alert-success p-1 " role="alert">
                Finished Task
            </div>
            <div id="displayFinishedTasks" data-spy="scroll"></div>

        </div>
    </div>
    <!----------------------------------------------------------------------------------------->
</div>


<!--###################################################################################################-->

<script type="text/javascript" src="../jquery_library/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../popper/popper.min.js"></script>
<script type='text/javascript' src="../bootstrap-4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../JS/monitor.js"></script>
<script type="text/javascript" src="../JS/managingTask.js"></script>
<?php } ?>
</body>

</html>