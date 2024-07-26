<?php
session_start();

function getAccessToken()
{
    $tokenData = json_decode(@file_get_contents('token.json'), true);

    // Check if the token is expired or doesn't exist
    if (!$tokenData || time() >= $tokenData['expires_at']) {
        // Token is expired or doesn't exist, refresh it
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://accounts.zoho.in/oauth/v2/token?refresh_token=1000.1c35e22b3710eb57496e09c7baa45652.dd641bf13e715993132e6c5be95e5b1f&client_id=1000.YKAA6FNUQJ6NL13TSM6JZ6MFNZ821U&client_secret=04c2314557bdd48ad3f394815a624680c3b890c93b&grant_type=refresh_token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Cookie: 6e73717622=94da0c17b67b4320ada519c299270f95; _zcsr_tmp=a6db683c-10b5-405f-8ba1-174c33dbc4e2; iamcsr=a6db683c-10b5-405f-8ba1-174c33dbc4e2'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        if (isset($data['access_token'])) {
            // Save the new token and its expiration time (1 hour from now)
            $tokenData = [
                'access_token' => $data['access_token'],
                'expires_at' => time() + 3600 // Tokens are valid for 1 hour
            ];
            file_put_contents('token.json', json_encode($tokenData));
        } else {
            // Handle error
            error_log('Failed to refresh access token: ' . $response);
            return null;
        }
    }
    // $logoutsessionCheck = json_decode(@file_get_contents('logoutsession.json'), true);
    // if (isset($_SESSION['modifytime']) || $logoutsessionCheck['expires_at'] == true) {
    //     checkSessionTimeout($_SESSION['modifytime']);
    //     echo " check logout session ";
    // } else {
    //     $expirationTime = "true";
    //     $tokenData = [
    //         'expires_at' => date("d-M-Y H:i:s", $expirationTime)
    //     ];
    
    //     // Write the token data back to the JSON file
    //     file_put_contents('logoutsession.json', json_encode($tokenData));
    //         // Handle case where modifytime is not set
    //         header("Location: index.php?error=session_expired");
    //         exit();
    //     }
    return $tokenData['access_token'];
}

// if (isset($_SESSION['modifytime'])) {
//     checkSessionTimeout($_SESSION['modifytime']);
//     echo " check logout session ";
// } 
// else {
//     // Handle case where modifytime is not set
//     header("Location: index.php?error=session_expired");
//     exit();
// }

// function checkSessionTimeout($session_modified_time)
// {
//     // Set default timezone to IST
//     date_default_timezone_set('Asia/Kolkata');

//     // Read the token data from JSON file
//     $tokenData = json_decode(@file_get_contents('logoutsession.json'), true);

//     // Get current time and session modified time
//     $currentTime = time();
//     $modifyTime = strtotime($session_modified_time);

//     // Set the expiration time (e.g., 5 minutes from the modified time)
//     $expirationTime = $modifyTime + (1 * 60); // 5 minutes in seconds
//     $tokenData = [
//         'expires_at' => ($expirationTime)
//     ];

//     // Write the token data back to the JSON file
//     file_put_contents('logoutsession.json', json_encode($tokenData));

//     // Output the formatted times for debugging purposes
//     // echo "currentTime: " . date("d-M-Y H:i:s", $currentTime) . "<br>";
//     // echo "modifyTime: " . date("d-M-Y H:i:s", $modifyTime) . "<br>";
//     // echo "expires_at: " . $tokenData['expires_at'] . "<br>";

//     // Check if the token is expired or doesn't exist
//     if (!$tokenData || $currentTime >= strtotime($tokenData['expires_at'])) {
//         // Session has expired
//         session_unset();
//         session_destroy();
//         header("Location: index.php?error=session_expired");
//         exit();
//     }
// }


//login code

function fetchDataOfUsers($reportname, $appname)
{
    $access_token = getAccessToken();
    if (!$access_token) {
        echo "Failed to get access token.";
        exit;
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://creator.zoho.in/api/v2.1/arun.ramu_machinemaze/" . urlencode($appname) . "/report/" . $reportname,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "Authorization: Zoho-oauthtoken $access_token",
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: ZCNEWLIVEUI=true; _zcsr_tmp=b451eca6-6321-4a12-b81e-b9d87897881f; f8176abf63=ac0bf5971029d5628fd013d3a9099af0; zccpn=b451eca6-6321-4a12-b81e-b9d87897881f'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    // echo json_encode($response);
    return $response;
}

function createRecord($email, $reportname, $appname)
{
    $access_token = getAccessToken();
    if (!$access_token) {
        echo "Failed to get access token.";
        exit;
    }

    $jsonData = json_encode([
        "data" => [
            "To_check" => "true",
            "Customer_Email" => $email,
            "trigger" => [
                "form_workflow"
            ]
        ]
    ]);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://creator.zoho.in/api/v2.1/arun.ramu_machinemaze/" . urlencode($appname) . "/form/" . $reportname,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Zoho-oauthtoken $access_token",
            'Content-Type: application/json',
            'Cookie: ZCNEWLIVEUI=true; _zcsr_tmp=150bdda3-8d38-4656-85ee-c1e269e2aff7; zalb_f8176abf63=1920247976c316b14a7c52e70618ba1f; zccpn=150bdda3-8d38-4656-85ee-c1e269e2aff7'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
    return $response;
}

function updateRecord($email, $reportname, $appname)
{
    $access_token = getAccessToken();
    if (!$access_token) {
        echo "Failed to get access token.";
        exit;
    }

    $jsonData = '{
        "criteria": "(Customer_Email.contains(\"' . addslashes($email) . '\"))",
        "data": {
            "To_check": "true",
            "Customer_Email": "' . addslashes($email) . '",
            "trigger": [
                "form_workflow"
            ]
        }
    }';

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://creator.zoho.in/api/v2.1/arun.ramu_machinemaze/' . urlencode($appname) . "/report/" . $reportname,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PATCH',
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Zoho-oauthtoken $access_token",
            'Content-Type: application/json',
            'Cookie: ZCNEWLIVEUI=true; _zcsr_tmp=150bdda3-8d38-4656-85ee-c1e269e2aff7; zalb_f8176abf63=1920247976c316b14a7c52e70618ba1f; zccpn=150bdda3-8d38-4656-85ee-c1e269e2aff7'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
    return $response;
}

function simulateLogin($email, $inputPassword, $users)
{
    foreach ($users as $user) {
        if ($user['Email'] === $email) {
            // Compare the hash of the input password with the stored hash
            if (md5($inputPassword) === $user['password']) {
                return $user; // Return user data on successful login
            } else {
                return false;
            }
        }
    }
    return false;
}

function getSummaryDetails(){
    $_SESSION['action_required'] = "";
     // Fetch User Summary
     $userSummary = fetchDataOfUsers('summary_dashboard_customer_portal_Report', 'machinemaze-project-management');
     $userSummaryData = json_decode($userSummary, true);
     if ($userSummaryData) {
         $actionRequired = false;
         $_SESSION['loggedin'] = true;
         if ($userSummaryData['code'] == 3000) {
             foreach ($userSummaryData['data'] as $eachSummaryUserData) {
                 if ($eachSummaryUserData['Customer_Email'] == $_SESSION['email']) {
                     $actionRequired = true;
                     break;
                 }
             }
             if ($actionRequired == true) {
                 $_SESSION['action_required'] = "update";
             } else {
                 $_SESSION['action_required'] = "create";
             }
         } else {
             $_SESSION['action_required'] = "no record";
         }
     }
     return $_SESSION['action_required'];
}

// Check if form is submitted 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['id'] = "";

    // Fetch User Data
    $resUser = fetchDataOfUsers('Customer_Portal_Database_Report', 'machinemaze-project-management');
    $resUserData = json_decode($resUser, true);

    if ($resUserData && $resUserData['code'] === 3000) {

        $user = simulateLogin($email, $password, $resUserData['data']);
        if ($user) {
            $_SESSION['loggedin'] = true;
            // user further data
            $userRecEmail = $user['Organisation_Name']['Customer_Email'];
            if ($userRecEmail != null && $userRecEmail != "") {
                $resUserDetailed = fetchDataFromZohoCreator('Customers', 'customer-invoice', $userRecEmail, "Customer_Email", 1000);
                $resUserDetailedDecode = json_decode($resUserDetailed, true);
                $resUserDetailedData = $resUserDetailedDecode['data'][0];
            }
            $_SESSION['email'] = isset($user['Organisation_Name']['Customer_Email']) ? $user['Organisation_Name']['Customer_Email'] : 'No Org';
            $_SESSION['address'] = isset($resUserDetailedData['Customer_Contact_Address']['zc_display_value']) ? $resUserDetailedData['Customer_Contact_Address']['zc_display_value'] : 'No Address';
            $_SESSION['orgname'] = isset($resUserDetailedData['Select_Org']['Name']) ? $resUserDetailedData['Select_Org']['Name'] : 'No Org';
            $_SESSION['Contact_No'] = isset($resUserDetailedData['Customer_Mobile_Number_Land_Line']) ? $resUserDetailedData['Customer_Mobile_Number_Land_Line'] : 'No Contact';
            $_SESSION['name'] = isset($resUserDetailedData['Customer_Name']['zc_display_value']) ? $resUserDetailedData['Customer_Name']['zc_display_value'] : 'User';
            $_SESSION['logo'] =  isset($resUserDetailedData['Customer_Logo']) ? $resUserDetailedData['Customer_Logo'] : null;
            $_SESSION['id'] =  isset($resUserDetailedData['ID']) ? $resUserDetailedData['ID'] : null;
            $_SESSION['Give_Access_To'] = isset($resUserDetailedData['Give_Access_To1']) ? $resUserDetailedData['Give_Access_To1'] : null;

            getSummaryDetails();

            header("Location: mf_dashboard.php");
            exit();
        } else {
            header("Location: index.php?error=invalid");
            if (isset($_GET['error']) && $_GET['error'] === 'invalid') {
                echo '<div class="alert alert-danger" role="alert">
                        Invalid email or password. Please try again.
                    </div>';
            }
            exit();
        }
    } else {
        echo 'Failed to fetch user data or invalid response code.';
    }
}

/////////////////////////////////////////


function fetchDataFromZohoCreator($reportname, $appname, $email, $emailfield, $maxLimit)
{
    $access_token = getAccessToken();
    if (!$access_token) {
        echo "Failed to get access token.";
        exit;
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://creator.zoho.in/api/v2.1/arun.ramu_machinemaze/" . urlencode($appname) . "/report/" . $reportname . "?" . $emailfield . "=" . urlencode($email) . "&max_records=" . $maxLimit,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => '%40newrecords.json=',
        CURLOPT_HTTPHEADER => array(
            "Authorization: Zoho-oauthtoken $access_token",
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: ZCNEWLIVEUI=true; _zcsr_tmp=b451eca6-6321-4a12-b81e-b9d87897881f; f8176abf63=ac0bf5971029d5628fd013d3a9099af0; zccpn=b451eca6-6321-4a12-b81e-b9d87897881f'
        ),
    ));

    $response = curl_exec($curl);
    //echo $response;
    curl_close($curl);
    return $response;
}

function getCountFromResponse($response)
{
    $data = json_decode($response, true);
    if (isset($data['data']) && is_array($data['data'])) {
        return count($data['data']);
    } else {
        return 0;
    }
}

function fetchDataFromZohoCreatorCriteria($reportname, $appname, $projIDs, $emailfield, $maxLimit)
{
    $access_token = getAccessToken();
    if (!$access_token) {
        echo "Failed to get access token.";
        exit;
    }

    $responses = [];
    foreach ($projIDs as $eachProjID) {
        $curl = curl_init();
        $url = "https://creator.zoho.in/api/v2.1/arun.ramu_machinemaze/" . urlencode($appname) . "/report/" . urlencode($reportname) . "?";
        $url .= urlencode($emailfield) . "=" . urlencode($eachProjID) . "&max_records=" . urlencode($maxLimit);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Zoho-oauthtoken " . $access_token,
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: ZCNEWLIVEUI=true; _zcsr_tmp=b451eca6-6321-4a12-b81e-b9d87897881f; f8176abf63=ac0bf5971029d5628fd013d3a9099af0; zccpn=b451eca6-6321-4a12-b81e-b9d87897881f',
            ),
        ));

        $response = curl_exec($curl);
        if ($response === false) {
            echo "Curl Error: " . curl_error($curl);
        } else {
            $decoded_response = json_decode($response, true);
            if (isset($decoded_response['data'])) {
                foreach ($decoded_response['data'] as $eachOfRec) {
                    //     $constructData["Project_Number"] = $eachOfRec['Project_Number'];
                    //     $constructData["Customer_PO1"] = $eachOfRec['Customer_PO1'];
                    //     $constructData["Delivery_Schedule_Type"] = $eachOfRec['Delivery_Schedule_Type'];
                    //     $constructData["Part_Names"] = $eachOfRec['Part_Names']['Part_Name'];
                    //     $constructData["Item_Description_Item_Part_No"] = $eachOfRec['Item_Description_Item_Part_No'];
                    //     $constructData["Delivery_Date"] = $eachOfRec['Delivery_Date'];
                    //     $constructData["Actual_Date_of_Delivery"] = $eachOfRec['Actual_Date_of_Delivery'];
                    //     $constructData["Quality_Acceptance_Rate_MachineMaze"] = $eachOfRec['Quality_Acceptance_Rate_MachineMaze'];
                    //     $constructData["Upload_TPI_Docs_MachineMaze"] = $eachOfRec['Upload_TPI_Docs_MachineMaze'];
                    $responses['data'][] = $decoded_response;
                }
                // echo " ******** " . json_encode($eachOfRec['Project_Number']);

            } else {
                // echo "Error: No data found in response.";
            }
        }

        curl_close($curl);
    }

    return $responses;
}

function fetchDataFromZohoCreatorByID($ID, $reportName, $applicationName)
{

    $access_token = getAccessToken();
    if (!$access_token) {
        echo "Failed to get access token.";
        exit;
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://creator.zoho.in/api/v2.1/arun.ramu_machinemaze/' . $applicationName . '/report/' . $reportName . '/' . (int)$ID,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => '%40newrecords.json=',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken ' . $access_token,
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: ZCNEWLIVEUI=true; _zcsr_tmp=e9fa7908-fb72-4474-a9cf-b983e9ead11d; zalb_f8176abf63=d905932461c6b3a721ff8fa0d796e1b5; zccpn=e9fa7908-fb72-4474-a9cf-b983e9ead11d'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

$ContactNo = "";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // echo "action required : " . json_encode($_SESSION['action_required']);
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $orgName = $_SESSION['orgname'];
    $ContactNo = $_SESSION['Contact_No'];
    $address = $_SESSION['address'];
    $Org_Logo = isset($_SESSION['logo']) ? $_SESSION['logo'] : 'No Logo';
    $userPId = isset($_SESSION['id']) ? $_SESSION['id'] : 'No ID';
    $giveAccesTo = json_encode($_SESSION['Give_Access_To']);

    // date_default_timezone_set('Asia/Kolkata');
    // $currentTime = date('H:i:s');
    // echo "Current time : " . $currentTime;

    /** Summary title validations - start */
    if (strpos($giveAccesTo, "M&F Summary") !== false) {
        $summaryTitleArray[] = "Manufacturing Summary";
        $summaryTitleUnique = "Manufacturing Summary";
    }
    if (strpos($giveAccesTo, "Fabrication Summary") !== false) {
        $summaryTitleArray[] = "Fabrication Summary";
        $summaryTitleUnique = "Fabrication Summary";
    }
    if (strpos($giveAccesTo, "EMS Summary") !== false) {
        $summaryTitleArray[] = "EMS Summary";
        $summaryTitleUnique = "EMS Summary";
    }

    if (count($summaryTitleArray) > 1) {
        $summaryTitle = "Summary";
    } else {
        $summaryTitle = $summaryTitleUnique;
    }

    /** Summary title validations - end */

    /** Create record under the zoho report */
    $summaryData = "NoData";
    if ($_SESSION['action_required'] == "create") {
        $summaryData = createRecord($email, "summary_dashboard_customer_portal", "machinemaze-project-management");
    } elseif ($_SESSION['action_required'] == "update") {
        $summaryData = updateRecord($email, "summary_dashboard_customer_portal_Report", "machinemaze-project-management");
    } else {
        $summaryData = "NoData";
    }

    $summaryResponse = fetchDataFromZohoCreator('summary_dashboard_customer_portal_Report', 'machinemaze-project-management', $email, "Customer_Email", 200);
    $summaryDetails = json_decode($summaryResponse, true);
    if(isset($summaryDetails['data'][0]['Modified_Time'])){
        $_SESSION['modifytime'] = $summaryDetails['data'][0]['Modified_Time'];
    }
    // echo "summaryData var " . json_encode($summaryData);
    // echo "summary details " . json_encode($summaryDetails);

    // $total_project_count = $project_dash_res_count + $completepro_dash_res_count + $cancelledpro_dash_res_count + $holdpro_dash_res_count;



    /** partner financial fetch data - start */
    // $partner_f_res = fetchDataFromZohoCreator('All_Invoices', 'purchase-application', $email, "Customer_Organisation", 1000);
    // $partner_f_res_data = json_decode($partner_f_res, true);
    // $partner_f_res_count = getCountFromResponse($partner_f_res);
    /** partner financial fetch data - end */



    /** Project Dashboard - start */
    // $project_id_res = fetchDataFromZohoCreator('All_Machine_Maze_Project_Trackings', 'machinemaze-project-management', $email, "Customer_Email", 1000);
    // $project_id_data = json_decode($project_id_res, true);

    // $proj_ids = [];
    // $mfPartnerId = $fabPartnerId = [];
    // $emsPartnerId = [];
    // $rfPartner = [];
    // if ($project_id_data['code'] == 3000) {
    //     foreach ($project_id_data['data'] as $eachRecProjId) {
    //         $proj_ids[] = $eachRecProjId["ID"];
    //         if ($eachRecProjId["Project_Execution_Detail"] != null && $eachRecProjId["Project_Execution_Detail"] != "") {
    //             foreach ($eachRecProjId["Project_Execution_Detail"] as $eachProjExeRec) {
    //                 if (count($eachProjExeRec['Production_Allocation_to_M_F_Partner']) > 0) {
    //                     $mfPartnerId[] = $eachProjExeRec['Production_Allocation_to_M_F_Partner']['ID'] ?? 0;
    //                 }
    //                 if (count($eachProjExeRec['Allocate_to_EMS_PArtner']) > 0) {
    //                     $emsPartnerId[] = $eachProjExeRec['Allocate_to_EMS_PArtner']['ID'] ?? 0;
    //                 }
    //                 if (count($eachProjExeRec['Production_Allocation_to_Fabrication_Vendor']) > 0) {
    //                     $fabPartnerId[] = $eachProjExeRec['Production_Allocation_to_Fabrication_Vendor']['ID'] ?? 0;
    //                 }
    //             }
    //         }
    //         // $emsPartnerId[] = $eachRecProjId["Project_Execution_Detail"][0]['Allocate_to_EMS_PArtner']['ID'] ?? 0;
    //         // $rfPartner[] = $eachRecProjId["Project_Execution_Detail"][0]["Production_Allocation_to_Raw_Material"][0]["ID"];
    //     }
    // } else {
    //     $project_id_data = "";
    // }

    // $mfPartnerId_Unique = array_unique($mfPartnerId);
    // $emsPartnerId_Unique = array_unique($emsPartnerId);
    // $fabPartnerId_Unique = array_unique($fabPartnerId);
    // // echo json_encode($mfPartnerId_Unique);
    // $project_ids_count = getCountFromResponse($project_id_res);

};

    /** Delivery Schedule Fetch Data - start */
    function getDeliveryScheduleData(){
        $ds_res = fetchDataFromZohoCreator('Overall_Delivery_Schedule_Records', 'machinemaze-project-management', $_SESSION['email'], "Machine_Maze_Project_Tracking_ID.Customer_Email", 1000);
        $ds_res_data = json_decode($ds_res, true);
    
        $deliveredRes = $notYetDeliveredRes = array();
        if ($ds_res_data['code'] == 3000) {
            foreach ($ds_res_data['data'] as $eachDsRec) {
                if (isset($eachDsRec['Delivery_Status']) && $eachDsRec['Delivery_Status'] == "Delivered") {
                    $deliveredRes["data"][] = $eachDsRec;
                } else if (isset($eachDsRec['Delivery_Status']) && $eachDsRec['Delivery_Status'] == "Not Yet Delivered") {
                    $notYetDeliveredRes["data"][] = $eachDsRec;
                }
            }
        }
        return array(
            'delivered' => $deliveredRes,
            'not_yet_delivered' => $notYetDeliveredRes
        );
    }
    /** Delivery Schedule Fetch Data - end */

/** Your Partner Fetch Data - start */
function getYourPartnerData()
{
    $your_partner_res = array();
    $summaryResponse = fetchDataFromZohoCreator('summary_dashboard_customer_portal_Report', 'machinemaze-project-management', $_SESSION['email'], "Customer_Email", 200);
    $summaryDetails = json_decode($summaryResponse, true);
    $partner_category = array();
    $Partner_PCndA_IDs = (array)$summaryDetails['data'][0]['Partner_PCndA_IDs'];
    $Partner_Fabrication_IDs = (array)$summaryDetails['data'][0]['Partner_Fabrication_IDs'];
    $Partner_EMS_IDs = (array)$summaryDetails['data'][0]['Partner_EMS_IDs'];

    // echo json_encode($Partner_PCndA_IDs);
    // echo json_encode($Partner_Fabrication_IDs);

    $uniquePCndA = array_unique($Partner_PCndA_IDs);
    $uniqueFabrication = array_unique($Partner_Fabrication_IDs);
    $uniqueEMS = array_unique($Partner_EMS_IDs);

    $uniquePCndA = [];
    foreach ($Partner_PCndA_IDs as $string) {
        $uniquePCndA = array_merge($uniquePCndA, explode(",", $string));
    }
    $uniquePCndA = array_unique($uniquePCndA);

    $uniqueFabrication = [];
    foreach ($Partner_Fabrication_IDs as $string) {
        $uniqueFabrication = array_merge($uniqueFabrication, explode(",", $string));
    }
    $uniqueFabrication = array_unique($uniqueFabrication);

    $uniqueEMS = [];
    foreach ($Partner_EMS_IDs as $string) {
        $uniqueEMS = array_merge($uniqueEMS, explode(",", $string));
    }
    $uniqueEMS = array_unique($uniqueEMS);

    // echo json_encode($uniqueEMS);

    if (count($uniquePCndA) > 0) {
        $partner_category[] = "Manufacturing Partner";
        foreach($uniquePCndA as $recMFID){
            if($recMFID != ""){
                $your_partner_res['data']['Manufacturing_Partner'][] = fetchDataFromZohoCreatorByID($recMFID, 'MF_Partner_Report_For_Customer_Portal', 'request-for-quote');
            }
        }
    }
    if (count($uniqueFabrication) > 0) {
        $partner_category[] = "Fabrication Partner";
        foreach($uniqueFabrication as $recFABID){
            if($recFABID != ""){
                $your_partner_res['data']['Fabrication_Partner'][] = fetchDataFromZohoCreatorByID($recFABID, 'Fabrication_Partner_Report_For_Portal', 'request-for-quote');
            }
        }
    }
    if (count($uniqueEMS) > 0) {
        $partner_category[] = "EMS Partner";
        foreach($uniqueEMS as $recEMSID){
            if($recEMSID != ""){
                $your_partner_res['data']['EMS_Partner'][] = fetchDataFromZohoCreatorByID($recEMSID, 'EMS_Partner_Report_For_Portal', 'request-for-quote');
            }
        }
    }

    // if (isset($your_partner_res)) {
    //     $your_partner_json = json_encode($your_partner_res);
    //     $your_partner_data = json_decode($your_partner_json, true);
    //     if (isset($your_partner_data[0]['data']) && is_array($your_partner_data[0]['data']) && !empty($your_partner_data[0]['data'])) {
    //         $partnerCount = count($your_partner_data[0]['data']);
    //     } else {
    //         $partnerCount = 0;
    //     }
    // }
    // echo json_encode($your_partner_res);
    // $your_partner_data_count = $partnerCount ?? 0;

    return $your_partner_res;
}
/** Your Partner Fetch Data - end */

/** rfq list fetch data - start */
function getRFQData()
{
    $res = fetchDataFromZohoCreator('Customer_Upload_RFQ', 'rfq-management', $_SESSION['email'], "Customer_Email", 1000);
    $resData = json_decode($res, true);
    // $rfq_count = getCountFromResponse($res);
    if ($resData["code"] == 9220) {
        $resData = "";
    } else {
        // 
    }
    // echo json_encode($resData);
    return $resData;
}
/** rfq list fetch data - end */

/** open project fetch data - start */
function getOpenProjects()
{
    $project_dash_res = fetchDataFromZohoCreator('Open_Projects_R_D', 'machinemaze-project-management', $_SESSION['email'], "Customer_Email", 1000);
    $project_dash_res_data = json_decode($project_dash_res, true);
    // $project_dash_res_count = getCountFromResponse($project_dash_res);
    // echo json_encode($project_dash_res_data);
    return $project_dash_res_data;
}
/** open project fetch data - end */

/** complete project fetch data - start */
function getCompletedProjects()
{
    $completepro_dash_res = fetchDataFromZohoCreator('Completed_Projects_R_D', 'machinemaze-project-management', $_SESSION['email'], "Customer_Email", 1000);
    $completepro_dash_res_data = json_decode($completepro_dash_res, true);
    // $completepro_dash_res_count = getCountFromResponse($completepro_dash_res);
    //echo json_encode($completepro_dash_res_data);
    return $completepro_dash_res_data;
}
/** complete project fetch data - end */

/** cancel project fetch data - start */
function getCancelledProjects()
{
    $cancelledpro_dash_res = fetchDataFromZohoCreator('Cancelled_Projects_R_D', 'machinemaze-project-management', $_SESSION['email'], "Customer_Email", 1000);
    $cancelledpro_dash_res_data = json_decode($cancelledpro_dash_res, true);
    // $cancelledpro_dash_res_count = getCountFromResponse($cancelledpro_dash_res);
    ///echo json_encode($cancelledpro_dash_res_data);
    return $cancelledpro_dash_res_data;
}
/** cancel project fetch data - end */

/** hold project fetch data - start */
function getHoldProjects()
{
    $holdpro_dash_res = fetchDataFromZohoCreator('On_Hold_Projects_R_D', 'machinemaze-project-management', $_SESSION['email'], "Customer_Email", 1000);
    $holdpro_dash_res_data = json_decode($holdpro_dash_res, true);
    // $holdpro_dash_res_count = getCountFromResponse($holdpro_dash_res);
    //echo json_encode($holdpro_dash_res_data);
    return $holdpro_dash_res_data;
}
/** hold project fetch data - end */

/** costing fetch data - start */
function getCostingData()
{
    $costing_res = fetchDataFromZohoCreator('All_Sgel_Pricing_Documents', 'machinemaze-project-management', $_SESSION['email'], "", 1000);
    $costing_res_data = json_decode($costing_res, true);
    // $costing_res_count = getCountFromResponse($costing_res);
    return $costing_res_data;
}
/** costing fetch data - end */

/** po fetch data - start */
function getPoData()
{
    $po_res = fetchDataFromZohoCreator('User_Based_Customer_Pos', 'customer-invoice', $_SESSION['email'], "Customer_Details.Customer_Email", 1000);
    $po_res_data = json_decode($po_res, true);
    // $po_res_count = getCountFromResponse($po_res);
    return $po_res_data;
}
/** po fetch data - end */

/** invoice fetch data  - start */
function getinvoiceData()
{
    $invoice_res = fetchDataFromZohoCreator('User_Based_Customer_Invoice_Report', 'customer-invoice', $_SESSION['email'], "Customer_Details.Customer_Email", 1000);
    $invoice_res_data = json_decode($invoice_res, true);
    // $invoice_res_count = getCountFromResponse($invoice_res);
    return $invoice_res_data;
}
/** invoice fetch data  - end */

/** price approval fetch data - start */
function priceApprovalData(){
    $pa_res = fetchDataFromZohoCreator('Price_Approval_from_Customers_Report', 'machinemaze-project-management', $_SESSION['email'], "Customer_Email", 1000);
    $pa_res_data = json_decode($pa_res, true);
    // $pa_res_count = getCountFromResponse($pa_res);
    // echo "erong " . json_encode($pa_res_data);
    return $pa_res_data;
}
/** price approval fetch data  - end */


/** partner financial fetch data - start */
function partnerFinancial(){
    $partner_f_res = fetchDataFromZohoCreator('All_Invoices', 'purchase-application', $_SESSION['email'], "Customer_Organisation", 1000);
    $partner_f_res_data = json_decode($partner_f_res, true);
    // $partner_f_res_count = getCountFromResponse($partner_f_res);
    return $partner_f_res_data;
}
/** partner financial fetch data - end */

/** Quality Control Fecth Data - start */
function getQualityControl()
{
    $quality_controls_res = fetchDataFromZohoCreator('All_Quality_Controls', 'machinemaze-project-management', $_SESSION['email'], "Machine_Maze_Project_Tracking.Customer_Email", 1000);
    $quality_controls_data = json_decode($quality_controls_res, true);
    // $quality_controls_data_count = getCountFromResponse($quality_controls_res);
    //echo "Quality Constrol " . json_encode($quality_controls_res);
    return $quality_controls_data;
}
/** Quality Control Fecth Data - end */

//Your Partner detailed view
function return_assessment_partner_details($RecID)
{
    $prtnr_res_detailed = fetchDataFromZohoCreatorByID($RecID, 'M_F_PARTNER_REGISTRATION_Report', "request-for-quote");
    $prtnr_res_data_det = json_decode($prtnr_res_detailed, true);
    return $prtnr_res_data_det;
}


function return_project_dash_id($RecID)
{
    $proj_dashboard_title_res = fetchDataFromZohoCreatorByID($RecID, 'All_Machine_Maze_Project_Trackings', "machinemaze-project-management");
    $proj_dashboard_title_data = json_decode($proj_dashboard_title_res, true);
    //echo json_encode($proj_dashboard_title_data);
    return $proj_dashboard_title_data;
}

function return_invoices_report_id($RecID)
{
    $invoices_report_res = fetchDataFromZohoCreatorByID($RecID, 'All_Invoices1', "customer-invoice");
    $invoices_report_data = json_decode($invoices_report_res, true);
    //echo json_encode($proj_dashboard_title_data);
    return $invoices_report_data['data'];
}

function getGSTNumbers($branch)
{
    if ($branch != "" && $branch != null) {
        $res_gst_res = fetchDataFromZohoCreator('All_Gst_Numbers', 'customer-invoice', $branch, "Location", 1000);
        $res_gst_data = json_decode($res_gst_res, true);
        return $res_gst_data['data'][0];
    } else {
        return "";
    }
}

function return_item_details($RecID)
{
    if ($RecID != "" && $RecID != null) {
        $item_details_res = fetchDataFromZohoCreatorByID($RecID, 'Item_Details_Invoice_Report', 'customer-invoice');
        $item_details_data = json_decode($item_details_res, true);
        return $item_details_data['data'];
    } else {
        return "";
    }
}

// function fetchDetailsCheck($resposne){
//     if($resposne["code"] == 3000){

//     } else{
        
//     }
// }
