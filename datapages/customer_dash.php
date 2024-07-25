<?php
$project_dash_res_data = getOpenProjects();
$completepro_dash_res_data = getCompletedProjects();
$cancelledpro_dash_res_data = getCancelledProjects();
$holdpro_dash_res_data = getHoldProjects();
$project_dash_res_count = $completepro_dash_res_count =
  $cancelledpro_dash_res_count = $holdpro_dash_res_count = 0;
if (isset($project_dash_res_data) && array_key_exists('data', $project_dash_res_data)) {
  $project_dash_res_count = count($project_dash_res_data['data']) ?? 0;
}
if (isset($completepro_dash_res_data) && array_key_exists('data', $completepro_dash_res_data)) {
  $completepro_dash_res_count = count($completepro_dash_res_data['data']) ?? 0;
}
if (isset($cancelledpro_dash_res_data) && array_key_exists('data', $cancelledpro_dash_res_data)) {
  $cancelledpro_dash_res_count = count($cancelledpro_dash_res_data['data']) ?? 0;
}
if (isset($holdpro_dash_res_data) && array_key_exists('data', $holdpro_dash_res_data)) {
  $holdpro_dash_res_count = count($holdpro_dash_res_data['data']) ?? 0;
}
$total_project_count = $project_dash_res_count + $completepro_dash_res_count + $cancelledpro_dash_res_count + $holdpro_dash_res_count ?>
<style>
  #mapCanvas {
    width: 100%;
    height: 450px;
    /* Adjust height as needed */
  }

  button.gm-ui-hover-effect {
    position: absolute !important;
    right: 0;
    top: -9px;
    font-size: 15px;
    width: 40px !important;
  }

  .info_content p {
    margin-bottom: 0;
  }

  .info_content h6 {
    font-size: 15px !important;
    margin-bottom: 4px !important;
  }

  .gm-style-iw-ch {
    padding: 5px !important;
  }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvBZcW9MkLM0NMPG_lNqVbTyzEQQ6chUA&libraries=places&callback=initMap" defer></script>

<div class="container-fluid p-0">

  <div id="mdsec" class="rowbg">
    <!--------------Manufacturing dashboard------------->
    <div class="row px-3 m-0">
      <div class="col-xl-12">

        <div class="row my-2 mdrow1">
          <div class="col-md-6">
            <h2 class="text-dark mb-2"> <?php echo $summaryTitle ?> </h2>
          </div>
          <!-- <h2 class="text-dark mb-2 ">Manufacturing Dashboard</h2> -->

        </div>

        <div class="row mdrow1">

          <div class="col-md-7">

            <div class="card shadow h-100  border-primary mt-0">
              <div class="card-body bg-light widgets_bg py-4">
                <div class="row">

                  <div class="col-xl-4 col-md-4 mb-2">
                    <div class="card shadow h-100 border-top border-4 border-primary">
                      <div class="card-body bg-light">
                        <div class="row align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-secondary">Total Projects</div>
                            <div class="h4 mb-0 fw-bold text-dark"><?php echo $summaryDetails['data'][0]['Total_Projects'] ?? 0; ?></div>
                            <!-- <div class="mt-2 mb-0 text-secondary text-xs">                          
                                        <span class="text-dark mr-2"> <i class="fa fa-arrow-up"></i> <b> 0 </b>  </span> <span> Records Since last month</span>   
                                      </div> -->
                          </div>
                          <div class="col-auto icnCircle">
                            <i class="fas fa-receipt fa-2x text-primary"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-4 col-md-4 mb-2">
                    <div class="card shadow h-100 border-top border-4 border-primary">
                      <div class="card-body bg-light">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-secondary">Production Projects</div>
                            <div class="h5 mb-0 fw-bold text-dark"><?php echo $summaryDetails['data'][0]['Production_Projects'] ?? 0; ?></div>
                            <!-- <div class="mt-2 mb-0 text-secondary text-xs">                          
                                        <span class="text-dark mr-2"><i class="fas fa-arrow-up"></i> 
                                        <b> ( ₹ 0 )</b> </span>  <span>Since last years</span>                        </div> -->
                          </div>
                          <div class="col-auto icnCircle"> <i class="fas fa-handshake fa-2x text-success"></i> </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-4 col-md-6 mb-2">
                    <div class="card shadow h-100 border-top border-4 border-primary">
                      <div class="card-body bg-light">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-secondary"> Open Projects</div>
                            <div class="h4 mb-0 mr-3 fw-bold text-dark"><?php echo $summaryDetails['data'][0]['Open_Projects'] ?? 0; ?></div>
                            <!-- <div class="mt-2 mb-0 text-secondary text-xs">                          
                                        <span class="text-dark mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> <span>Since last month</span>                        
                                      </div> -->
                          </div>
                          <div class="col-auto icnCircle">
                            <i class="fas fa-circle-notch fa-2x text-danger"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-4 col-md-6 mb-2">
                    <div class="card shadow h-100 border-top border-4 border-primary">
                      <div class="card-body bg-light">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-secondary">Onhold Projects</div>
                            <div class="h4 mb-0 mr-3 fw-bold text-dark"><?php echo $summaryDetails['data'][0]['Onhold_Projects'] ?? 0; ?></div>
                            <!-- <div class="mt-2 mb-0 text-secondary text-xs">                          
                                        <span class="text-dark mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> <span>Since last month</span>
                                      </div> -->
                          </div>
                          <div class="col-auto icnCircle">
                            <i class="fas fa-star fa-2x text-info"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-4 col-md-6 mb-2">
                    <div class="card shadow h-100 border-top border-4 border-primary">
                      <div class="card-body bg-light">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-secondary">Cancelled Projects</div>
                            <div class="h4 mb-0 mr-3 fw-bold text-dark"><?php echo $summaryDetails['data'][0]['Cancelled_Projects'] ?? 0; ?></div>
                            <!-- <div class="mt-2 mb-0 text-secondary text-xs">                          
                                      <span class="text-dark mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> <span>Since last month</span>
                                    </div> -->
                          </div>
                          <div class="col-auto icnCircle ">
                            <i class="fas fa-star fa-2x text-info"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="card shadow h-100 border-primary mt-4">
              <div class="card-body bg-light widgets_bg">

                <div class="row">

                <?php if ($summaryDetails['data'][0]['Units_in_delivered_EA'] != 0 || $summaryDetails['data'][0]['Units_in_delivered_KG'] != 0 || $summaryDetails['data'][0]['Units_in_delivered_MTS'] != 0) { ?>
                  <div class="col-xl-6 col-md-6 mb-2">
                    <div class="card shadow h-100 border-top border-4 border-primary">
                      <div class="card-body bg-light">
                        <div class="row no-gutters align-items-center">
                          <div class="col p-1">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-secondary">Units Delivered</div>
                            <div class="h5 mb-0 mr-3 fw-bold text-dark">
                              <?php if (isset($summaryDetails['data'][0]['Units_in_delivered_EA']) && $summaryDetails['data'][0]['Units_in_delivered_EA'] != 0) { ?>
                                <span class="pd_br1"><?php echo $summaryDetails['data'][0]['Units_in_delivered_EA'] ?? "-" ?> <small><?php echo "EA" ?></small></span>
                              <?php
                              }
                              if (isset($summaryDetails['data'][0]['Units_in_delivered_KG']) && $summaryDetails['data'][0]['Units_in_delivered_KG'] != 0) {
                              ?>
                                <span class="pd_br1 pd_lft1"><?php echo $summaryDetails['data'][0]['Units_in_delivered_KG'] ?? "-" ?> <small><?php echo "kg" ?></small></span>
                              <?php
                              }
                              if (isset($summaryDetails['data'][0]['Units_in_delivered_MTS']) && $summaryDetails['data'][0]['Units_in_delivered_MTS'] != 0) {
                              ?>
                                <span class="pd_lft1"><?php echo $summaryDetails['data'][0]['Units_in_delivered_MTS'] ?? "-" ?> <small><?php echo "Mts" ?></small></span>
                              <?php
                              }
                              ?>
                            </div>

                            <!-- <div class="mt-2 mb-0 text-secondary text-xs">                          
                                      <span class="text-dark mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> <span>Since last month</span>                        
                                    </div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                  } else {
                    // 
                  } ?>

                  <?php if ($summaryDetails['data'][0]['Units_in_production_EA'] != 0 || $summaryDetails['data'][0]['Units_in_production_KG'] != 0 || $summaryDetails['data'][0]['Units_in_production_MTS'] != 0) { ?>
                    <div class="col-xl-6 col-md-6 mb-2">
                      <div class="card shadow h-100 border-top border-4 border-primary">
                        <div class="card-body bg-light">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs fw-bold text-uppercase mb-1 text-secondary">Units in production</div>
                              <div class="h5 mb-0 mr-3 fw-bold text-dark">
                                <?php
                                if (isset($summaryDetails['data'][0]['Units_in_production_EA'])) {
                                ?>
                                  <span class="pd_br1"><?php echo $summaryDetails['data'][0]['Units_in_production_EA'] ?? "-" ?> <small><?php echo "EA" ?></small></span>
                                <?php
                                }
                                if (isset($summaryDetails['data'][0]['Units_in_production_KG']) && $summaryDetails['data'][0]['Units_in_production_KG'] != 0) {
                                ?>
                                  <span class="pd_br1 pd_lft1"><?php echo $summaryDetails['data'][0]['Units_in_production_KG'] ?? "-" ?> <small><?php echo "kg" ?></small></span>
                                <?php
                                }
                                if (isset($summaryDetails['data'][0]['Units_in_production_MTS']) && $summaryDetails['data'][0]['Units_in_production_MTS'] != 0) {
                                ?>
                                  <span class="pd_lft1"><?php echo $summaryDetails['data'][0]['Units_in_production_MTS'] ?? "-" ?> <small><?php echo "Mts" ?></small></span>
                                <?php
                                }
                                ?>
                              </div>

                              <!-- <div class="mt-2 mb-0 text-secondary text-xs">                          
                                      <span class="text-dark mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> <span>Since last month</span>                        
                                    </div> -->
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  } else {
                    // 
                  } ?>

                </div>

              </div>
            </div>

          </div>

          <div class="col-md-5">
            <div class="row">

              <div class="col-xl-12 col-md-6 mb-2">
                <div class="card shadow h-100 border-primary mt-0">

                  <div class="card-body bg-light pt-0 widgets_bg">
                    <div class="card-header border-0 mt-3 p-0 pb-1 bg-transparent">
                      <h5 class="text-dark mb-2"> <?php echo "Partner Location" ?> </h5>
                    </div>
                    <div id="mapCanvas"></div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
    <!--------------------------------------->
  </div>

</div>

<?php
// $partnerCollection = []; // Initialize an empty array to store partner data

// $colors = ['red', 'green', 'blue']; // Array of colors

//   // $your_partner_data = getYourPartnerData();
//   // $mfCount = $fabCount = $emsCount = 0;
//   // if(isset($your_partner_data['data']['Manufacturing_Partner'])){
//   //   $mfCount = count($your_partner_data['data']['Manufacturing_Partner']);
//   // } if(isset($your_partner_data['data']['Fabrication_Partner'])){
//   //   $fabCount = count($your_partner_data['data']['Fabrication_Partner']);
//   // } if(isset($your_partner_data['data']['EMS_Partner'])){
//   //   $emsCount = count($your_partner_data['data']['EMS_Partner']);
//   // }

// if (isset($your_partner_data)) {
//   foreach ($your_partner_data as $eachRecordCheck) {
//     if (isset($eachRecordCheck) && isset($eachRecordCheck['data'][0]['data'][0]) && count($eachRecordCheck['data'][0]['data'][0]) > 0) {
//       foreach ($eachRecordCheck['data'] as $record) {
//         $location = $record['data'][0]['Address_Registered_Office_of_the_Organisation']['district_city'];
//         $locationContent = $record['data'][0]['Address_Registered_Office_of_the_Organisation']['zc_display_value'];
//         $latitude = $record['data'][0]['Address_Registered_Office_of_the_Organisation']['latitude'] ?? null;
//         $longitude = $record['data'][0]['Address_Registered_Office_of_the_Organisation']['longitude'] ?? null;

//         /** Check for specific keys in the data and set partner category - start */
//         if (array_key_exists('GST_Registration_No', $record['data'][0])) {
//           $color = $colors[1];
//           $partnerCategory = 'Fabrication Partner';
//           $partnerName = $record['data'][0]['Name_Of_Organisation'] ?? "-";
//         } elseif (array_key_exists('Area_of_Specialisation_in_Manufacturing', $record['data'][0])) {
//           $color = $colors[0];
//           $partnerCategory = 'Manufacturing Partner';
//           $partnerName = $record['data'][0]['Name_of_the_Organisation'] ?? "-";
//         } elseif (array_key_exists('Are_the_statutory_norms_for_labour_engagement_followed', $record['data'][0])) {
//           $color = $colors[2];
//           $partnerCategory = 'EMS Partner';
//           $partnerName = $record['data'][0]['Name_of_the_Organisation'] ?? "-";
//         }
//         /** Check for specific keys in the data and set partner category - end */

//         if ($latitude !== null && $longitude !== null) {
//           // Determine color based on index (use modulo to cycle through colors)
//           // $color = $colors[count($partnerCollection) % count($colors)];

//           /** Add partner data to collection */
//           $partnerCollection[] = [
//             'location' => $location,
//             'latitude' => $latitude,
//             'longitude' => $longitude,
//             'partner_name' => $partnerName,
//             'partner_category' => $partnerCategory,
//             'color' => $color,
//             'location_content' => $locationContent
//           ];
//         }
//       }
//     }
//   }
// }
?>

<script>
  new DataTable('#map_table');
</script>

<!-- <script>
  // Initialize and add the map
  function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
      mapTypeId: 'terrain',
      center: {
        lat: 20,
        lng: 77
      }, // Centered on India
      zoom: 3, // Initial zoom level (adjust as needed)
      maxZoom: 5, // Maximum zoom level allowed (adjust as needed)
      mapTypeId: 'terrain', // Map type (e.g., 'roadmap', 'satellite', 'terrain', 'hybrid')
      disableDefaultUI: true, // Disable default UI controls
      zoomControl: true, // Enable zoom control
      zoomControlOptions: {
        position: google.maps.ControlPosition.RIGHT_BOTTOM // Position of zoom control
      }
    };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);

    // PHP-generated markers
    var collectionPartner = <?php echo json_encode($partnerCollection); ?>;
    console.log("Partner locations:", collectionPartner);

    // Info window content for dynamic markers
    var infoWindowContent = [];

    // Custom marker icons configuration based on color
    var url = 'https://maps.google.com/mapfiles/ms/micons/';
    var iconBase = {
      'red': url + 'red-dot.png',
      'green': url + 'green-dot.png',
      'blue': url + 'blue-dot.png'
    };

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow();

    // Place each marker on the map
    for (var i = 0; i < collectionPartner.length; i++) {
      var position = new google.maps.LatLng(collectionPartner[i].latitude, collectionPartner[i].longitude);
      bounds.extend(position);
      var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: collectionPartner[i].location,
        icon: {
          url: iconBase[collectionPartner[i].color],
          scaledSize: new google.maps.Size(40, 40) // Size of the scaled icon
        }
      });

      // Prepare info window content for each partner at the same location
      if (!infoWindowContent[position.toString()]) {
        infoWindowContent[position.toString()] = '';
      }

      infoWindowContent[position.toString()] += '<div class="info_content" id="map_table">' +
        '<h6 style="color: #0070ba;">' + collectionPartner[i].partner_name + '</h6>' +
        '<b>' + collectionPartner[i].partner_category + '</b>' +
        '<p>Location: ' + collectionPartner[i].location_content + '</p>' +
        '</div>';

      // Add click event listener to marker
      google.maps.event.addListener(marker, 'click', (function(marker, content) {
        return function() {
          infoWindow.setContent(content);
          infoWindow.open(map, marker);
        };
      })(marker, infoWindowContent[position.toString()]));

      // Extend the bounds to include each marker's position
      bounds.extend(marker.getPosition());
    }

    // Center the map to fit all markers when they are added
    map.fitBounds(bounds);

    // Set zoom level when all markers are placed
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function() {
      this.setZoom(4); // Zoom level adjustment (1 = World view, 15 = Streets close up)
      google.maps.event.removeListener(boundsListener);
    });
  }

  // infoWindowContent[position.toString()] += '<div class="table-responsive">';
  //     infoWindowContent[position.toString()] += '<table class="table table-striped">';
  //     // Add table headers only if they haven't been added before
  //     if (infoWindowContent[position.toString()].indexOf('<thead') === -1) {
  //       infoWindowContent[position.toString()] += '<thead class="table-primary"><tr><th>Partner</th><th>Category</th><th>Location</th></tr></thead>';
  //     }
  //     infoWindowContent[position.toString()] += '<tbody>';
  //     infoWindowContent[position.toString()] += '<tr>';
  //     infoWindowContent[position.toString()] += '<td style="color: #0070ba;">' + collectionPartner[i].partner_name + '</td>';
  //     infoWindowContent[position.toString()] += '<td>' + collectionPartner[i].partner_category + '</td>';
  //     infoWindowContent[position.toString()] += '<td>' + collectionPartner[i].location_content + '</td>';
  //     infoWindowContent[position.toString()] += '</tr>';
  //     infoWindowContent[position.toString()] += '</tbody>';
  //     infoWindowContent[position.toString()] += '</table>';
  //     infoWindowContent[position.toString()] += '</div>';
</script> -->