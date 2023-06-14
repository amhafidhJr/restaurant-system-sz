<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../admin/assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">


    <?php include("nav.php"); ?>


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tables</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                Transaction Data
                            </div>
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Category</button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order No</th>
                                    <th>From</th>
                                    <th>Reference No</th>
                                    <th>Status </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                require_once("../includes/connection.php");


                                $sqlQuery = "SELECT * FROM order_tbl
                                INNER JOIN transaction_tbl ON order_tbl.orderId = transaction_tbl.orderId
                                INNER JOIN customer_tbl ON order_tbl.userId = customer_tbl.customer_id";
                                $statement = $conn->prepare($sqlQuery);
                                $statement->execute();
                                $result = $statement->fetchAll();

                                if ($result == true) {


                                    foreach ($result as $data) {
                                        $id = $data["orderId"];
                                        $from = $data["fullname"];
                                        $reference_no = $data["reference_no"];
                                        $paymentStatus = $data["paymentStatus"];

                                        switch ($paymentStatus) {
                                            case 0:
                                                $p_status = "Unpaid";
                                                break;
                                            case 1:
                                                $p_status = "Paid";
                                                break;
                                            default:
                                                $p_status = "Unknown";
                                                break;
                                        }
                                       
                                ?>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $from; ?></td>
                                            <td><?php echo $reference_no; ?></td>
                                            <td><?php echo $p_status; ?></td>
                                           
                                        </tr>
                                        
                                <?php }
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">&copy; 2021-2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../admin/assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../admin/assets/js/datatables-simple-demo.js"></script>
</body>

</html>