<style>
  #prtnr_datatable li {
    list-style: circle;
  }

  .partner_rating {
    width: 70px;
    mix-blend-mode: darken;
  }

  .hidden {
    display: none;
  }

  .hidecolumn .dropdown-toggle::after {
    content: "\f078";
    font-family: FontAwesome;
    position: relative;
    top: 4px;
    border: 0;
    right: 0;
    color: #ffffff;
  }
</style>
<div id="mpSec" style="display: none;">
  <!------------Manufacturing Partner Sec------------->
  <div style="width:100%;" class="container-fluid">
    <div class="col-md-12 col-sm-8">
      <div class="card mb-4 mt-2 tablecard">

        <div class="card-header pt-3">
          <div class="row">
            <div class="col-md-6">
              <h5 class="my-1 fw-bold text-primary">Your Partners</h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <b>Total Records : <span><?php echo $your_partner_data_count ?></span></b>
            </div>
          </div>
        </div>

        <div class="card-body pt-1">

          <div class="table table-responsive">

            <?php
            if (isset($your_partner_data)) {
                if (isset($eachRecordCheck['data'][0]['data'][0]) && count($eachRecordCheck['data'][0]['data'][0]) > 0) {
            ?>
                  <table style="width:100%" class="table table-striped" id="prtnr_datatable">
                    <thead class="table-primary">
                      <tr>
                      <th>
                        <div class="dropdown hidecolumn">
                          <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-eye"></i> 
                          </a>

                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li class="d-none">
                              <a class="dropdown-item " href="#">
                                <label><input type="checkbox" class="toggleColumn_yp" data-column="0" checked></label>
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#">
                                <label><input type="checkbox" class="toggleColumn_yp" data-column="1" checked>Partner Category</label>
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#">
                                <label><input type="checkbox" class="toggleColumn_yp" data-column="2" checked> Partner Organization</label>
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#">
                                <label><input type="checkbox" class="toggleColumn_yp" data-column="3" checked> GST Number</label>
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#">
                                <label><input type="checkbox" class="toggleColumn_yp" data-column="4" checked> Area of specialization in Manufacturing</label>
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#">
                                <label><input type="checkbox" class="toggleColumn_yp" data-column="5" checked> Location </label>
                              </a>
                            </li>
                            
                          </ul>
                        </div>
                      </th>
                        <th>Partner Category</th>
                        <th>Partner Organization</th>
                        <th>GST Number</th>
                        <th>Area of specialization in Manufacturing</th>
                        <th>Partner Location</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                  foreach ($your_partner_data as $eachRecordCheck) {

                      foreach ($eachRecordCheck['data'] as $record) { 
                        ?>
                        <tr>
                          <td></td>
                          <?php
                          $partnerCategory = '';

                          // Determine partner category based on available keys
                          if (array_key_exists('Area_of_Specialisation_in_Manufacturing', $record['data'][0])) {
                            $partnerCategory = 'Manufacturing Partner';
                          } elseif (array_key_exists('GST_Registration_No', $record['data'][0])) {
                            $partnerCategory = 'Fabrication Partner';
                          } elseif (array_key_exists('Are_the_statutory_norms_for_labour_engagement_followed', $record['data'][0])) {
                            $partnerCategory = 'EMS Partner';
                          }
                          ?>
                          <td><?php echo htmlspecialchars($partnerCategory ?? "-"); ?></td>

                          <?php
                          // Construct URL
                          $url = "http://localhost/customerportal/datapages/assessment_partner.php?ID=" . htmlspecialchars($record['data'][0]['ID']);
                          ?>

                          <?php if (array_key_exists('GST_Registration_No', $record['data'][0])) { ?>
                            <td><a href='<?php echo $url; ?>' target="_blank"><?php echo htmlspecialchars($record['data'][0]['Name_Of_Organisation'] ?? "-"); ?></a></td>
                          <?php } else { ?>
                            <td><a href='<?php echo $url; ?>' target="_blank"><?php echo htmlspecialchars($record['data'][0]['Name_of_the_Organisation'] ?? "-"); ?></a></td>
                          <?php } ?>

                          <?php if (array_key_exists('GST_Registration_No', $record['data'][0])) { ?>
                            <td><?php echo htmlspecialchars($record['data'][0]['GST_Registration_No'] ?? "-"); ?></td>
                          <?php } else { ?>
                            <td><?php echo htmlspecialchars($record['data'][0]['GST_Number'] ?? "-"); ?></td>
                          <?php } ?>

                          <td>
                            <?php if (!empty($record['data'][0]['Area_of_Specialisation_in_Manufacturing']) && is_array($record['data'][0]['Area_of_Specialisation_in_Manufacturing'])) : ?>
                              <ul>
                                <?php foreach ($record['data'][0]['Area_of_Specialisation_in_Manufacturing'] as $specialisation) : ?>
                                  <li><?php echo htmlspecialchars($specialisation); ?></li>
                                <?php endforeach; ?>
                              </ul>
                            <?php else : ?>
                              <?php echo "-"; ?>
                            <?php endif; ?>
                          </td>

                          <td><?php echo htmlspecialchars($record['data'][0]['Address_Registered_Office_of_the_Organisation']['zc_display_value'] ?? "-"); ?></td>
                        </tr>
                      <?php } 
                    } ?>
                    </tbody>
                  </table>
              <?php } else {
                  // Handle case where data is empty
                  // echo "empty";
                }
              
            } else { ?>
              <img src="https://achieversacademyalwar.in/assets/images/no-record-found.png" class="mx-auto d-flex" style="mix-blend-mode: luminosity;">
            <?php } ?>


          </div>

        </div>

      </div>
    </div>
  </div>
  <!------------------------------------->
</div>
<script>
  $(document).ready(function() {
    var table = $('#prtnr_datatable').DataTable();

    $('.toggleColumn_yp').change(function() {
      var column = table.column($(this).data('column'));
      column.visible(!column.visible());
    });
  });
</script>