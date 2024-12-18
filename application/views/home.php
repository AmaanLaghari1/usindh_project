<!-- Start main-content -->
<div class="main-content">
    <!-- Section: home -->
    <style>
        #home{
            height: 350px;
        }

		/*Admission Card Styles*/
		.admission-cards-container {
			margin-top: 10px;
			margin-bottom: 10px;
		}

		.admission-card {
			height: 8rem;
			background: #0a6aa1;
			color: #fff;
			display: flex;
			align-items: center;
			border-radius: 10px;
		}

		.admission-card h4 {
			color: #fff;
		}

		.admission-card-img-container {
			width: 20%;
			display: flex;
			align-items: center;
			justify-content: center;
		}

	/*	Merit List Styles*/
		.merit-list-category, .merit-list-option-container {
			font-family: "Open Sans" sans-serif !important;
		}

		.merit-list-category {
			/*background-color: #0967a9;*/
			background-color: #f5f5f5;
			padding: .5rem 1rem;
			text-align: center;
			border-radius: 10px;
			margin: 10px 0;
			transition: background-color 0.3s ease;
		}

		.merit-list-category:hover, .merit-list-category.active {
			cursor: pointer;
			background-color: #0967a9;
		}

		.merit-list-category:hover h4, .merit-list-category.active h4 {
			color: #fff;
		}

		.merit-list-category h4 {
			font-weight: 900;
		}

		.merit-list-option-container > div {
			width: 100%;
			display: flex;
			flex-wrap: wrap;
		}

		.merit-list-option-card {
			position: relative;
			padding: .5rem;
			width: 100%;
			max-width: 15rem;
			text-align: center;
			background-color: #fff;
			color: #0967a9;
			border-radius: 10px;
			font-weight: 600;
			margin: 10px;
			box-shadow: #eee8e8 8px 8px 10px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		.merit-list-option-card:hover {
			background-color: #0967a9;
			color: #fff;
		}

		.d-none {
			display: none !important;
		}

    </style>

	<?php
    if(count($sliders)>0) {
        require('./application/views/includes/sliders.php');
    }

    ?>
    

            <!-- popup modal click trigger -->
            <a style='display:none;'href="#promoModal1" id='mclick' data-lightbox="inline" class="btn btn-default">Trigger Modal</a>

            <!-- popup modal -->
            <div id="promoModal1" class="modal-promo-box bg-img-cover mfp-hide" >
              
            <a href='http://convocation.usindh.edu.pk/'> <img src='images/bg/convocation.jpg'></a>

              <!-- Mailchimp Subscription Form Validation-->
              <script type="text/javascript">
                $('#mailchimp-subscription-form').ajaxChimp({
                    callback: mailChimpCallBack,
                    url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
                });

                function mailChimpCallBack(resp) {
                    // Hide any previous response text
                    var $mailchimpform = $('#mailchimp-subscription-form'),
                        $response = '';
                    $mailchimpform.children(".alert").remove();
                    if (resp.result === 'success') {
                        $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                    } else if (resp.result === 'error') {
                        $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                    }
                    $mailchimpform.prepend($response);
                }
              </script>

              
            </div>

            <!-- popup modal onLoad trigger -->
            <div class="modal-on-load" data-target="#promoModal1"></div>

   
    <?php
    $content = file_get_contents('./application/views/page_data.txt');
    $content = str_replace("<?=base_url()?>",base_url(),$content);
    $news_section = file_get_contents("./application/views/news_section.php");
    $content = str_replace("#NEWS_SECTION",$news_section,$content);
    echo $content;
    ?>
   <?php
//   include('./application/views/merit_list.php');
   ?>

</div>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-3">
			<div class="merit-list-category active">
				<h4>Undergraduate</h4>
			</div>
			<div class="merit-list-category">
				<h4>Masters</h4>
			</div>
		</div>
		<div class="col-12 col-md-9" style="background-color: #F5F5F5; min-height: 10rem; border-radius: 10px;">
			<div class="merit-list-option-container">
				<div class="list-option">
					<div class="merit-list-option-card">
						<span>1st Merit List</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>

					</div>
					<div class="merit-list-option-card">
						<span>2nd Merit List</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="merit-list-option-card">
						<span>3rd Merit List</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="merit-list-option-card">
						<span>4th Merit List</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="merit-list-option-card">
						<span>5th Merit List</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="merit-list-option-card">
						<span>6th Merit List</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
				</div>
				<div class="shift-option d-none">
					<div class="merit-list-option-card">
						<span>Morning</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="merit-list-option-card">
						<span>Evening</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
				</div>
				<div class="program-option d-none">
					<div class="merit-list-option-card">
						<span>ABC Program</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="merit-list-option-card">
						<span>XYZ Program</span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<script>


		$(".merit-list-category").click(function(){
			$(".merit-list-category").removeClass('active');

			$(this).addClass('active')
		})

		$(".list-option .merit-list-option-card").click(function(){
			$(this).parent().addClass('d-none')
			$(".shift-option").removeClass('d-none')
		})

		$(".shift-option .merit-list-option-card").click(function(){
			$(this).parent().addClass('d-none')
			$(".program-option").removeClass('d-none')
		})

		$(".program-option .merit-list-option-card").click(function(){
			// $(this).parent().addClass('d-none')
		})



	</script>
</div>

