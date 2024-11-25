
<body class="login-page sidebar-collapse">

<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 1200px" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3 id="alert_title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="alert_body">

            </div>
        </div>
    </div>
</div>
<button data-toggle="modal" data-target="#alertModal"  id="alert_btn" >alert</button>
<nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
   
    <div class="container-fluid">
      <div class="navbar-translate">
         <a  href="#" style="color:black;">
            <img src="<?=base_url()?>assets/icon/usindh_icon.ico" alt="">
           <a href="#" style="font-size: 14pt; color: black; font-weight: bold; font-family: 'Times New Roman'">SINDH UNIVERSITY TESTING CENTER</a>
            </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      
       <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>login" onclick="">
              <span class="fa fa-home"></span> Home
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>register" onclick="">
              <span class="fa fa-arrow-right"></span> New Registration
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href='<?=base_url().'assets/Advertisment%20of%20ALM.pdf'?>' target='new'>
              <span class="fa fa-arrow-right"></span> Advertisement
            </a>
          </li>
        
			
			
          <li class="nav-item">
            <a class="nav-link" href="https://sutc.usindh.edu.pk/sutc/news" onclick="">
              <span class="glyphicon glyphicon-bullhorn"></span> Updates / Announcements
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://itsc.usindh.edu.pk/eportal/public/verify_challan.php" onclick="">
              <span class="fa fa-money"></span>Verify Online Payments
            </a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>
