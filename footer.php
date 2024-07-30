<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://unpkg.com/lightpick@latest/lightpick.js"></script>
    
<script>

var picker = new Lightpick({
    field: document.getElementById('demo-3_1'),
    secondField: document.getElementById('demo-3_2'),
    singleDate: false,
    selectForward: true,
    onSelect: function(start, end){
        var str = '';
        str += start ? start.format('Do MMMM YYYY') + ' to ' : '';
        str += end ? end.format('Do MMMM YYYY') : '...';
        document.getElementById('result-3').innerHTML = str;
    }
});

function showSection(sectionId, spanSelector) {
  const sections = [
    "#mdsec", "#rfqlistsec", "#pro_dash", "#mpSec", "#mpSecDetailed",
    "#dsSec", "#paSec", "#invoiceSec", "#poSec", "#pfSec", "#costSec",
    "#qcSec", "#rfqSec", "#profileSec", "#dtrendsSec", "#qcSec"
  ];

  const spans = [
    '#showdashboard span', '#yourrfq span', '#yourpro span', '#showpartner span',
    '#mpSecDetailed span', '#showds span', '#order_mng span', '#order_mng span',
    '#order_mng span', '#order_mng span', '#order_mng span', '#showqc span','#dt span', '#showqc span'
  ];

  // Hide all sections and spans
  sections.forEach(sec => $(sec).hide());
  spans.forEach(span => $(span).css('display', 'none'));

  // Show the specified section and span
  $(sectionId).show();
  $(spanSelector).css('display', 'inline-block');
}

    $("#showdashboard").click(function(){
      showSection("#mdsec", '#showdashboard span');
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #rfqlistsec, #pro_dash, #pfSec, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    });
    
    $("#showrfqlist").click(function(){
      showSection("#rfqlistsec", '#yourrfq span');
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdSec, #pro_dash, #pfSec, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    });

    $("#showProDash").click(function(){
      showSection('#pro_dash', '#yourpro span');
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pfSec, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    })

    $("#showpartner").click(function(){
      showSection('#mpSec', '#showpartner span');
      $("#poSec, #invoiceSec, #pfSec, #paSec, #dsSec, #mdsec, #rfqlistsec, #pro_dash, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    })

    $("#showpartnerDetailed").click(function(){
      showSection('#mpSecDetailed', '#mpSecDetailed span');
      $("#poSec, #invoiceSec, #pfSec, #paSec, #mpSec, #dsSec, #mdsec, #rfqlistsec, #pro_dash, #costSec, #qcSec, #rfqSec, #profileSec, #dtrendsSec").hide();
    })

    $("#showds").click(function(){
      showSection('#dsSec', '#showds span');
      $("#poSec, #invoiceSec, #pfSec, #paSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    })

    $("#showpa").click(function(){
      showSection('#paSec', '#order_mng span');
      $("#poSec, #invoiceSec, #pfSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    })

    $("#showInvoice").click(function(){
      showSection('#invoiceSec', '#order_mng span');
      $("#poSec, #pfSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    })

    $("#showpo").click(function(){
      showSection('#poSec', '#order_mng span');
      $("#pfSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    })

    $("#showpf").click(function(){
      showSection('#pfSec', '#order_mng span');
      $("#pfSec").show();
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #costSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    })

    $("#showcost").click(function(){
      showSection('#costSec', '#order_mng span');
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #pfSec, #qcSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    })

    $("#showqc").click(function(){
      showSection('#qcSec', '#showqc span');
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #pfSec, #costSec, #rfqSec, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    });

    $("#uploadRfq").click(function(){
      showSection('#rfqSec', '#yourrfq span');
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #pfSec, #costSec, #showqc, #mpSecDetailed, #profileSec, #dtrendsSec").hide();
    });

    $("#showProfile").click(function(){
      $("#profileSec").show();
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #pfSec, #costSec, #showqc, #mpSecDetailed, #rfqSec, #dtrendsSec").hide();
    });

    $("#showdt").click(function(){
      showSection('#dtrendsSec', '#dt span');
      $("#poSec, #invoiceSec, #paSec, #dsSec, #mpSec, #mdsec, #rfqlistsec, #pro_dash, #pfSec, #costSec, #showqc, #mpSecDetailed, #rfqSec, #profileSec").hide();
    });
    

</script>

<script>

    //script for signature
    var canvas = document.getElementById('signature-canvas');
    var signaturePad = new SignaturePad(canvas);

    var clearButton = document.getElementById('clear-button');
    clearButton.addEventListener('click', function() {
      signaturePad.clear();
    });

    $.fn.dataTable.ext.errMode = 'none';

</script>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()

</script>