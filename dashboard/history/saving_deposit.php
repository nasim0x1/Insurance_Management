<?php require_once("../../includes/config.php");?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Savings Deposit History - DKBSSL</title>
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
                                    <a class="dropdown-item" href="../logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Savings Deposit List</li>
  </ol>
</nav>

                <div class="container-fluid">
                        <div id="data" class="last_added_client">
                        <center><font size="5px" style="color:#0F82C8;font-weight: bold;"> Saving Deposit History </font></center><br>

                        <table id="list" class="table table-sm table-bordered table-striped">
                            <thead >
                                <tr align="center">
                                    <th >Acc No</th>
                                    <th >Date</th>
                                    <th >Amount</th>
                                    <th >Total Savings</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

            $query = "SELECT * FROM saving_deposit ORDER BY id DESC";

                if ($result = $conn->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $acc = $row["acc_no"];
                        $date = $row["date"];
                        $amount = $row["amount"];
                        $toatal = $row["total_saving"];
                        $deposit_id = $row['id'];
              
                        echo '
                        <td align="center">'.$acc.'</td>
                        <td align="center">'.$date.'</td>
                        <td align="center">'.$amount.'৳</td>
                        <td align="center">'.$toatal.'৳</td>
                        <td align="center"><a href="../edit/saving_deposit_delete.php?id='.$deposit_id.'"><i class="fa fa-trash-alt" style="color:green;"></i></a></td>
                      </tr>';
                      echo '';
                    }
                    $result->free();
                } 

                ?>
                            </tbody>
                        </table>

                        <hr class="style2">
                        <?php 
                            $sql = "SELECT SUM(amount) as amount FROM saving_deposit";
                            $sth = $conn->query($sql);
                            $total=mysqli_fetch_array($sth);
                           
                                                ?>
                        <div style="padding-right:550px;">
                        <div class="float-right">Total Amount : <b><?php echo $total['amount']?> ৳</b></div>
                        </div>
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
var url = window.location.toString();
    if (url.includes("record_not_found")) {
    swal("Record Not Found", "", "error");

        }
        if (url.includes("successfully_deleted")) {
    swal("Record Deleted Sucessfully", "", "success");

        }
    </script>

    </html>