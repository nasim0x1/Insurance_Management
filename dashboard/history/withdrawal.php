<?php require_once("../../includes/config.php");?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Withdrawal History - DKBSSL</title>
        <link rel="shortcut icon" href="../../image/favicon.png" />
        <link href="../../css/bootstrap.css" rel="stylesheet">
        <link href="../../css/fontawesome.css" rel="stylesheet">
        <script src="../../js/sweetalert.js"></script>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/sweetalert.css">        
        <link rel="stylesheet" href="../../css/datatable.css">
    </head>

    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">🇩​🇰​🇧​🇸​🇸​</div>
                <div class="list-group list-group-flush">
                    <a href="../index" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                  </div>
            </div>
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light ">
                    <button class="btn " id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </button>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown" style="padding-right:10px">
                                <a class="nav-link" href="index.php" onclick="print_table('data')" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-home fa-print"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown" style="padding-right:10px">
                                <a class="nav-link" href="index.php" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-home fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user fa-lg"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <center>
                                        <p style="color:green;">Welcome Admin</p>
                                    </center>
                                    <a class="dropdown-item" href="setting">Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
    <li class="breadcrumb-item active">Client Savings Withdrawal List</li>
  </ol>
</nav>

                <div class="container-fluid">
                        <div id="data" class="last_added_client">
                        <center><font size="5px" style="color:#0F82C8;font-weight: bold;"> Withdrawal History </font></center><br>

                        <table id="list" class="table table-sm table-bordered table-striped">
                            <thead >
                                <tr align="center">
                                    <th>Acc No</th>
                                    <th>Req Date</th>
                                    <th>Paid Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            <tr align="center">

                                <?php 

            $query = "SELECT * FROM withdrawal_list ORDER BY id DESC";

                if ($result = $conn->query($query)) {
                    while ($row = $result->fetch_assoc()) {

                        $acc_no = $row["acc_no"];
                        
                        $amount = $row["amount"];
                        $paid_date = $row["withdrawal_date"];
                        $req_date = $row["request_date"];
                        $status = $row["req_status"]; 

                        if($status == 0){
                            $req_status = "<div class='badge badge-info'>Complete</div>";
                        }elseif($status==1){
                            $req_status = "<div class='badge badge-warning'>Pending</div>";
                        }elseif($status==4){
                            $req_status = "";
                        }else{
                            $req_status = "<div class='badge badge-danger'>Cancelled </div>";
                        }

    
                        echo '
                        <td align="center"><a href="../client/check_client.php?acc_no='.$acc_no.'">'.$acc_no.'</a></td>
                        <td align="center">'.$req_date.'</td>
                        <td align="center">'.$paid_date.'</td>
                        <td align="center">'.$amount.' ৳</td>
                        <td align="center">'.$req_status.'</td>
                      </tr>';
                      echo '';
                    }
                    $result->free();
                } 

                ?></tr>
                            </tbody>
                        </table>
                        
                    </div>

                </div>

                

                

    </body>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/fontawesome.js"></script>


<!-- datatable -->
    <script src="../../js/datatable.js""></script>
    <script src="../../js/datatable-bootstrap.js""></script>


    <script src="../../js/main.js"></script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        $('#list').dataTable( {
    "order": [[ 0, 'desc' ]]
} );    

    </script>

    </html>