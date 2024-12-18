	<style>
		.merit-list-option-card, .merit-list-card {
			font-family: Open Sans, sans-serif !important;
		}

		.bg-primary {
			background-color: #0967a9 !important
		}

		.bg-secondary {
			background-color: #f5f5f5 !important;
		}

		.merit-list-card {
			min-height: 0px !important;
			padding: 0px !important;
		}

		.merit-list-option-card {
			min-height: 0px !important;
			font-weight: 600 !important;
		}

		.program {
			background-color: #f5f5f5;
			cursor: pointer;
			transition: background-color .5s ease;
		}

		.program:hover {
			color: #fff !important;
			background-color: #0967a9 !important;
		}

		.option {
			color: #0967a9;
			text-decoration: none;
			position: relative;
			font-size: .8em;
			box-shadow: #eee8e8 8px 8px 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
		}

		.option:hover {
			background-color: #0967a9 !important;
			color: #fff !important;
		}

		.option span::after {
			content: '';
			width: 20px;
		}

		.program.active {
			background-color: #0967a9 !important;
			color: #fff;
		}

		@media only screen and (max-width: 768px) {
			.option {
				font-size: .5em !important;
			}
		}

	</style>
<body>
<div class="container">
	<div class="row">
		<div class="col-12 col-md-3 p-2">
			<div class="d-flex flex-wrap">
				<div class="card merit-list-card program text-center border-0 rounded-3 p-3 w-100 m-1 active" style="height: 4rem">
					<h6 class="fw-bolder my-auto">Undergraduate</h6>
				</div>
				<div class="card merit-list-card program text-center border-0 rounded-3 p-3 w-100 m-1" style="height: 4rem">
					<h6 class="fw-bolder my-auto">Masters</h6>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-9 rounded-3 my-2 p-2 bg-secondary" style="min-height: 10rem;">
			<div class="d-block w-100 option-container">
				<div class="list-options d-flex flex-wrap bg-secondary">
					<div style="height: fit-content" class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
                            <span>
                                1st Merit List
                            </span>
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						2nd Merit List
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						3rd Merit List
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						4th Merit List
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						5th Merit List
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						6th Merit List
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
				</div>
			</div>
			<div class="d-block w-100 d-none">
				<div class="shift-options d-flex flex-wrap bg-secondary">
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						Morning
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						Evening
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
				</div>
			</div>
			<div class="d-block w-100 d-none">
				<div class="program-options d-flex flex-wrap bg-secondary">
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						ABC Program
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
					<div class="card merit-list-option-card option bg-white col-3 m-2 rounded-3 border-0 p-2">
						XYZ Program
						<div style="top: 10%; right: 5%;" class="bi bi-arrow-right position-absolute fw-bolder fs-6"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script>


	$(".program").click(function(){
		$(".program").removeClass('active');

		$(this).addClass('active')
	})

	$(".list-options .option").click(function(){
		$(this).parent().addClass('d-none')
		$(".shift-options").parent().removeClass('d-none')
	})

	$(".shift-options .option").click(function(){
		$(this).parent().addClass('d-none')
		$(".program-options").parent().removeClass('d-none')
	})

	$(".program-options .option").click(function(){
		// $(this).parent().addClass('d-none')
	})



</script>
</html>
