<?php
require '../php/managingTask.php';
session_start();

if (!isset($_SESSION["email"])) {
    readfile('blockPage.html');
} else {
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

    <body class="bg-color-2">

    <!--###################################################################################################-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark box-shadow-4">
        <a class="navbar-brand" href="dashboard.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION["email"]; ?></a>
                </li>

            </ul>
            <button class="btn btn-success btn-sm my-2 my-sm-0 mr-2 text-wight-2" type="submit" data-toggle="modal"
                    data-target="#addTask" onclick="displayModal(1)">Assign public task
            </button>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 form-control-sm" type="search" placeholder="Search"
                       aria-label="Search">
                <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">Search</button>
            </form>
            <button class="btn btn-danger btn-sm my-2 my-sm-0 ml-2" type="submit" onclick="logout()">Log out</button>
        </div>
    </nav>


    <!--###################################################################################################-->
    <div class="row">

        <div class="col-sm-1"></div>
        <div id="userList" class="col-sm-10 add-space-1 bg-white rounded">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Social Number</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
        <div id="taskList" class="col-sm-10 add-space-1 p-0 bg-white rounded hide">

            <!--##########################################################################################-->

            <div class="alert text-light bg-dark d-flex rounded-top rounded-0 flex-row" role="alert">
                <p id="firstName" class="mb-0"></p>
                <p id="lastName" class="mb-0"></p>
                <p id="email" class="mb-0 text-success"></p>
                <div class=" move-right">
                    <button type="button" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#addTask"
                            onclick="displayModal(0)">assign task
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="closeTaskList()">close
                    </button>
                </div>
            </div>
            <div class="p-3">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Content</th>
                        <th scope="col">Create Date</th>
                        <th scope="col">Dead Line</th>
                        <th scope="col">Finish Date</th>
                        <th scope="col">Task Type</th>
                        <th scope="col">Done</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="taskListBody"></tbody>
                </table>
            </div>
        </div>
    </div>
    <!--###################################################################################################-->

    <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><span class="badge badge-secondary text-wight-3" id="taskTitle"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

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

    <script type="text/javascript" src="../jquery_library/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../popper/popper.min.js"></script>
    <script type='text/javascript' src="../bootstrap-4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../JS/adminPanel.js"></script>

    </body>

    </html>
<?php } ?>