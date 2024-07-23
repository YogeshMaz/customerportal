<style>
    .form-control {
        box-shadow: 0 .125rem .25rem 0 rgba(58, 59, 69, .2) !important;
        border-color: #c5e0f2;
    }
    input.form-control, select.form-control {
        height:40px;
    }
    .accordion-button:focus{
        box-shadow:none;
    }
    canvas {
      border: 1px solid black;
    }
    canvas#signature-canvas {
        width: 100%;
        border-radius: .375rem;
        border-color: #cfe2ff;
    }

    /* .form-control:valid:not([required]) {
      border-color: #ced4da;
      background-image:none;
    } */

    .form-control:not(.is-required):not(:disabled):valid {
      border-color: #ced4da !important;
      padding-right: calc(1.5em + .75rem) !important;
      background-image: none !important;
    }

    .errortxt{ display:none; }

    .form-select.is-invalid, .was-validated .form-select:invalid ~ .errortxt{
        display:block;
    }

</style>
<div id="rfqSec" style="display: none;">
    <!------------Upload RFQ Sec------------->
    <div style="width:100%;" class="container-fluid">
        <div class="col-md-12 col-sm-8">
            <div class="card mb-4 mt-2 tablecard">
                <div class="card-header pt-3 d-flex justify-content-between">
                      <h5 class="my-1 fw-bold text-primary">Upload RFQ</h5>
                </div>
                <div class="card-body mt-2">
                <!-- <iframe height='820px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creatorapp.zohopublic.in/arun.ramu_machinemaze/rfq-management/form-embed/Manufacturing_RFQ_Form/z4mnRx79COuEUb73Mkj0bZ38W3MyZXd8O7r8rABYJOR1bVfWnrATEqvHgF4KFZwmwyJzqnbAPpJBjePGDbjTfX5DsZkZ6QR50k5Z'></iframe> -->
                    <form action="" class="g-3 needs-validation" novalidate id="rfqForm">

                        <div class="accordion mb-3" id="">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                                        <strong>RFQ Details <span class="text-danger">*</span></strong>
                                    </button>
                                </h2>
                                <div id="collapseOne1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="rfqno" class="form-label">RFQ Reference Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="rfqno" placeholder="Enter RfQ Number" name="rfqno" required>
                                                </div>
                                            </div>
  
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="rfqsdate" class="form-label">RFQ Start Date <span class="text-danger">*</span></label>
                                                    <input type="text" id="demo-3_1" class="form-control form-control-sm"/>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="rfqedate" class="form-label">RFQ End Date <span class="text-danger">*</span></label>
                                                    <input type="text" id="demo-3_2" class="form-control form-control-sm"/>
                                                </div>
                                            </div>

                                            <span id="result-3" class="text-end text-primary">&nbsp;</span>

                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="protype" class="form-label">Type of Project <span class="text-danger">*</span></label>
                                                    <select class="form-select form-control" id="protype" name="protype" required>
                                                        <option></option>
                                                        <option>Assembly</option>
                                                        <option>PCB Assembly</option>
                                                    </select>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="targetp" class="form-label">Target Price/ Unit Quantity</label>
                                                    <input type="text" class="form-control" id="" placeholder="" name="targetp">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="tov" class="form-label">Total Order Value</label>
                                                    <input type="text" class="form-control" id="" placeholder="" name="tov">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="protype" class="form-label">Preferred Quotation Currency <span class="text-danger">*</span> </label>
                                                    <select class="form-select form-control" id="protype" name="protype" required>
                                                        <option></option>
                                                        <option>US Doller</option>
                                                        <option>Indian Rupees</option>
                                                    </select>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="mcc" class="form-label">Mandatory Compliance & Certification <span class="text-danger">*</span></label>
                                                    <select class="form-select form-control" id="protype" name="mcc" required>
                                                        <option></option>
                                                        <option>ISO 9001-2008</option>
                                                        <option>AS9001D</option>
                                                    </select>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="daoc" class="form-label">Describe- Any Other Compliance</label>
                                                    <input type="text" class="form-control" id="" placeholder="" name="daoc">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="uploadql" class="form-label">Upload Itemwise Quantity List</label>
                                                    <input type="file" class="form-control" id="" placeholder="" name="uploadql">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="rawmd" class="form-label">Raw Material Detail</label>
                                                    <input type="text" class="form-control" id="" placeholder="" name="rawmd">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="pnd" class="form-label">Part Number : Description</label>
                                                    <textarea class="form-control" rows="5" id="pnd" name="pnd"></textarea>
                                                    </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="bdotp" class="form-label">Brief Description of the Project</label>
                                                    <textarea class="form-control" rows="5" id="bdotp" name="bdotp"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="mir" class="form-label">Mandatory Inspection required <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="5" id="bdotp" name="mir" required></textarea>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="accordion mb-3" id="">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <strong> Job Details <span class="text-danger">*</span></strong>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="jobtype" class="form-label">Job Type <span class="text-danger">*</span></label>
                                                    <select class="form-select form-control" aria-label="Default select example" required>
                                                        <option></option>
                                                        <option value="">Job Type 1</option>
                                                        <option value="">Job Type 2</option>
                                                        <option value="">Job Type 3</option>
                                                    </select>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="uom" class="form-label">UOM</label>
                                                    <input type="text" class="form-control" id="uom" placeholder="UOM">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="qyear" class="form-label">Quantity / Year <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="qyear" placeholder="Quantity / Year" required>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="qbatch" class="form-label">Quantity/ Batch <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="qbatch" placeholder="Quantity/ Batch" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="typefreq" class="form-label">Type of Frequency <span class="text-danger">*</span></label>
                                                    <select class="form-select form-control" aria-label="Default select example" required>
                                                        <option></option>
                                                        <option value="">One Time </option>
                                                        <option value="">Recurring Order</option>
                                                        <option value="">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="bfreq" class="form-label">Batch Frequency <span class="text-danger">*</span></label>
                                                    <select class="form-select form-control" aria-label="Default select example" required>
                                                        <option></option>
                                                        <option value="">Monthly</option>
                                                        <option value="">Weekly</option>
                                                        <option value="">Quarterly</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion mb-3" id="">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <strong> Drawings/ Pictures/ Engineering Document <span class="text-danger">*</span></strong>
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="uploadfile" class="form-label">Upload File Of Drawings/ Pictures/ Engineering Document <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" class="form-control" id="uploadfile" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion mb-3" id="">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <strong> Shipment <span class="text-danger">*</span></strong>
                                    </button>
                                </h2>
                                <span class="errortxt">Fields are Required</span>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        
                                        <div class="row">
                                            <h5>Ship To Address <span class="text-danger">*</span></h5>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Address Line1</label>
                                                    <input type="text" class="form-control" id="addline1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Address Line2</label>
                                                    <input type="text" class="form-control" id="addline1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">City / District </label>
                                                    <input type="text" class="form-control" id="addline1" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">State</label>
                                                    <input type="text" class="form-control" id="addline1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Postal Code</label>
                                                    <input type="text" class="form-control" id="addline1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Country</label>
                                                    <select class="form-select form-control" aria-label="Default select example" required>
                                                        <option></option>
                                                        <option value="">India</option>
                                                        <option value="">UK</option>
                                                        <option value="">US</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h5>Ship to country</h5>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Country</label>
                                                    <input type="text" class="form-control" id="addline1" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion mb-3" id="">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                                    <strong> Authorization </strong>
                                </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="cemail" class="form-label">Signature</label>
                                                    <canvas id="signature-canvas"></canvas>
                                                    <button id="clear-button" class="btn btn-danger mt-2">Clear Signature</button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="mailsend" class="form-label">Mail Send To</label>
                                                    <textarea class="form-control" id="mailsend" rows="3"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="cemail" class="form-label">Customer Email</label>
                                                    <input type="email" class="form-control" id="cemail" placeholder="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" Value="Submit">submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


