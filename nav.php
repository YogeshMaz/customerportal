<div id="navbar-wrapper">
    <nav class="navbar navbar-inverse p-0">
        <div class="w-100">
            <div class="navbar-header w-100 row" style="align-items: center;">
                <div class="row">
                    <div class="col-2 col-md-4">
                        <div class="sidebar-brand d-flex">
                            <img src="https://creatorapp.zohopublic.in/file/arun.ramu_machinemaze/customer-invoice/All_Org_Data/88342000001640019/Image/image-download/YfvzyEv0WUzVU0MVTC9UWsXge5UYqTexbQFDVDxrwAAwYmstm6JZSOqpFNB310Bhpsgu1zQ2VdpaC7GPjBwAq8EaeUYWW40Y8tTE?filepath=1654833412043_MM.jpeg" class="h-auto" style="width:35px;"> <strong class="d-none d-sm-block p-2">Machine Maze</strong>
                            <div class="text-end px-4 fw-bold position-relative d-lg-none d-md-block"> <span class="position-absolute fs-6" style="top:-50px;right: -10px">X</span> </div>
                        </div>
                    </div>
                    <div class="text-center col-10 col-md-8 d-flex">
                        <h3 class="text-center fw-bold small m-auto  my-4"><a class="active text-decoration-none">CUSTOMER PORTAL</a></h3>

                        <ul class="navbar-nav my-2 my-lg-0 mypro">
                            <li class="nav-item mt-1 m-0 px-2">
                                <!-- <?php //if($Org_Logo != "" && $Org_Logo != null){
                                        //$Org_Logo_FilePath = explode('?', $Org_Logo);
                                        //$Org_Logo_s = "https://creatorapp.zohopublic.in/file/arun.ramu_machinemaze/customer-invoice/Customers/" . $userPId . "/Customer_Logo/image-download/3B2NyuxjO4GOZmVwWunBsjNF7sfautP0W58FFg5hrmaquff9G1wTsvh7PXPWVWpbjppSY59xAjOFsTvrtbkjRtnpnkfeNDPtuFbr?" . $Org_Logo_FilePath[1];
                                        //} 
                                        ?> -->
                                <!-- <img src="<?php //echo $Org_Logo_s; 
                                                ?>" style="background: #fff;"> -->
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong>
                                        <span class="ss"><?php echo $orgName ?></span>
                                        <i class="fa fa-user-circle d-lg-none h5"></i>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a href="http://localhost/customerportal/datapages/profile.php" class="dropdown-item text-secondary py-2" href="#" id="showProfile"><i class="fa fa-user-circle"></i> View Profile</a></li>
                                        <li>
                                            <a class="dropdown-item py-1">
                                                <form action="../logout.php" method="post" class="m-0">
                                                    <button type="submit" name="action" class="btn border-0 bg-transparent text-secondary p-0 my-1" value="logout"><i class="fas fa-sign-out-alt "></i> Logout </button>
                                                </form>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </li>
                        </ul>

                        <div class="text-end mt-3">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid justify-content-end">

        <input type="checkbox" id="toggle" class="d-none">
        <label for="toggle" class="navbar-toggler border-0" tabindex="1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </label>

        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll">


                <li class="nav-item">
                    <a href="http://localhost/customerportal/datapages/customer_dash.php" class="nav-link sh" id="showdashboard">
                        <i class="fas fa-home"></i> <span> <?php echo $summaryTitle ?> </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="yourrfq" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tasks"></i>
                        <span>Your RFQ's</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li> <a href="http://localhost/customerportal/datapages/upload_rfq.php" class="dropdown-item sh" id="uploadRfq"><i class="fa fa-upload"></i>Create RFQ</a> </li>
                        <li> <a href="http://localhost/customerportal/datapages/rfq_list.php" class="dropdown-item sh" id="showrfqlist"><i class="fa fa-list"></i> RFQ List</a> </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="yourpro" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-industry"></i>
                        <span>Your Projects</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="http://localhost/customerportal/datapages/project_dash.php" class="dropdown-item sh" id="showProDash">
                                <i class="fas fa-tachometer-alt"></i> <span>Project Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="order_mng" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-money-bill-alt"></i><span> Order Management </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="http://localhost/customerportal/datapages/price_approve.php" class="dropdown-item sh" id="showpa"><i class="fas fa-hand-holding-usd"></i> Price Approval</a></li>
                        <li><a href="http://localhost/customerportal/datapages/invoice.php" class="dropdown-item sh" id="showInvoice"><i class="fas fa-file-invoice"></i> Invoice</a></li>
                        <li><a href="http://localhost/customerportal/datapages/po.php" class="dropdown-item sh" id="showpo"><i class="fas fa-money-check"></i> PO</a></li>

                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="dt" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analytics</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="http://localhost/customerportal/datapages/delivery_t.php" class="dropdown-item sh" id="showdt"><i class="fa fa-book"></i> Delivery Trends</a></li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="http://localhost/customerportal/datapages/your_prtnr.php" class="nav-link sh" id="showpartner"> <i class="fas fa-handshake"></i> <span>Your Partners</span> </a>
                </li>
                <li class="nav-item ">
                    <a href="http://localhost/customerportal/datapages/delivery_sch.php" class="nav-link sh" id="showds"> <i class="fas fa-calendar-week"></i> <span> Delivery Schedule</span></a>
                </li>
                <li class="nav-item d-none">
                    <a class="nav-link d-block sh" id="showqc"> <i class="fas fa-check-square"></i> <span>Quality Control</span></a>
                </li>

            </ul>


        </div>
    </div>
</nav>
<script>
    $(document).ready(function() {
        $('.sh').click(function() {
            // Check if the navbar is expanded
            if ($('#navbarScroll').hasClass('show')) {
                // Remove the 'show' class to collapse the navbar
                $('#navbarScroll').removeClass('show');
                $('#navbarScroll').css('display', 'none');
            }
        });
        $('.navbar-toggler').click(function() {
            $('#navbarScroll').removeAttr('style');
        });
    });

    // Defined all pages in an object
    var logs = {
        summary: "Summary",
        createRfq: "Create RFQ",
        rfqList: "RFQ List",
        prodash: "Project Dashboard",
        pricea: "Price Approval",
        invoice: "Show Invoice",
        po: "Purchase Order",
        deliveryt: "Analytics - Delivery Trends",
        yourp: "Your Partner",
        deliverys: "Delivery Schedule"
    };

    // Define the logAction function
    function logAction(action) {
        $.ajax({
            type: "POST",
            url: "../logaction.php",
            data: {
                action: action
            },
            success: function(response) {
                console.log("Log recorded:", response);
            },
            error: function(xhr, status, error) {
                console.error("Log recording failed:", status, error);
            }
        });
    }

    // Add click event handlers
    $("#showdashboard").click(function() {
        logAction(logs.summary);
        console.log(logs.summary);
    });
    $("#uploadRfq").click(function() {
        logAction(logs.createRfq);
        console.log(logs.createRfq);
    });
    $("#showrfqlist").click(function() {
        logAction(logs.rfqList);
        console.log(logs.rfqList);
    });
    $("#showProDash").click(function() {
        logAction(logs.prodash);
        console.log(logs.prodash);
    });
    $("#showpa").click(function() {
        logAction(logs.pricea);
        console.log(logs.pricea);
    });
    $("#showInvoice").click(function() {
        logAction(logs.invoice);
        console.log(logs.invoice);

    });
    $("#showpo").click(function() {
        logAction(logs.po);
        console.log(logs.po);
    });
    $("#showdt").click(function() {
        logAction(logs.deliveryt);
        console.log(logs.deliveryt);
    });
    $("#showpartner").click(function() {
        logAction(logs.yourp);
        console.log(logs.yourp);
    });
    $("#showds").click(function() {
        logAction(logs.deliverys);
        console.log(logs.deliverys);
    });
</script>