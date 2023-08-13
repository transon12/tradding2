<?php

/**
 *
 * Template name: Page - stock-information
 *
 */

get_header();
?>

<style>
		.stock-value {
			margin-bottom: 0.3rem;
			padding-top: 0.5rem;
			padding-bottom: 0.5rem;
			position: relative;
			width: 100%;
			height: 22%;
			z-index: 1;
		}

		.select2-container {
			display: inline !important;
		}

		.bgColor {
			position: absolute;
			top: 0px;
			left: 0px;
			height: 100%;
			z-index: 2;
			opacity: 0.5;
		}


		.scrollTable {
			max-height: 35vh;
			overflow-y: scroll;
			display: block;
		}

		.price__histories,
		.scrollTable tr {
			display: table;
			width: 100%;
			table-layout: fixed;
		}
		.custom-width{
			left: 1%;
			width: 10%;
		}
		table td {
			color: #333
		}

		.nav-pills {
			border: 1px solid #bbb;
			border-radius: 0.25rem;
			display: flex;
		}

		.nav-pills li {
			border-right: 1px solid #bbb;
			flex: 1 1 auto;

		}

		.custom-listStock {
			position: absolute;
			top: 0%;
		}

		.nav-pills li button {
			text-transform: none;
		}

		@media screen and (max-width: 1360px) {
			.nav-pills li button {
				text-transform: none;
				padding: 0 0.4rem;

			}

			.content_stock {
				height: 80%;
				overflow-y: scroll;
			}

			.custom-listStock {
				position: absolute;
				top: 0%;
			}

			.custom-listStock-2 {
				position: absolute;
				top: 0%;
				left: 1.0%;
				width: 14%;
			}
			.custom-width{
				width: 12%;
				left: 10%;
			}
		}

		@media screen and (max-width: 2000px) and (min-width: 1800px) {
			.nav-pills li button {
				text-transform: none;
				padding: 0 0.4rem;

			}

			.content_stock {
				height: 80%;
				overflow-y: scroll;
			}

			.custom-listStock {
				position: absolute;
				top: 0%;
			}

			.custom-listStock-2 {
				position: absolute;
				top: 0%;
				left: 2.0%;
				width: 25%;
			}
			.custom-width{
				width: 8%;
				left: 7%;
			}
		}

		@media screen and (max-width: 999px) and (min-width: 300px) {
			.nav-pills li button {
				text-transform: none;
				padding: 0 0.4rem;

			}

			.content_stock {
				height: 80%;
				overflow-y: scroll;
			}

			.custom-listStock {
				position: absolute;
				top: 0%;
				left: 8.1%;
				width: 10.5%;
			}

			.custom-listStock-2 {
				position: absolute;
				top: 0%;
				left: 2.0%;
				width: 25%;
			}
		}

		.content_stock {
			height: 95%;
			overflow-y: scroll;
		}

		.nav-chart {
			display: none;
		}

		@media screen and (max-width: 1500px) and (min-width: 1361px) {

			.custom-listStock {
				position: absolute;
				top: 0%;
			}
			.custom-width{
				width: 10%;
				left: 9%;
			}

			.custom-listStock-2 {
				position: absolute;
				top: 0%;
				left: 1%;
				width: 11%;

			}
			.content_stock {
				height: 80%;
				overflow-y: scroll;
			}
		}

		.nav-pills li:last-child {
			border-right: none;
		}

		.nav-link {
			padding-top: 0rem !important;
			padding-bottom: 0rem !important;
			margin-right: 0px !important;
			width: 100%;
			border-radius: 0px !important;
			background-color: #fff;
		}

		.table th {
			text-transform: none !important;
		}

		.select2-drop-active {
			margin-top: -25px;
		}

		.dacVUY {
			display: flex;
			flex-direction: row;
			flex: 1 1 0%;
			position: relative;
			z-index: 10;
		}

		.bthUPl {
			display: flex;
			flex-direction: row;
			flex: 1 1 0%;
			position: relative;
			margin-top: 0.3rem;
		}

		.bCzOtC {
			display: flex;
			flex-direction: row;
			position: relative;
			z-index: 10;
		}

		.trading-chart {
			position: relative;
		}

		.nav-chart-li {
			display: none !important;
		}

		.nav-chart-tab {
			display: none;
		}

		@media screen and (max-width: 1200px) {
			.iframe-chart {
				display: none;
			}

			.nav-chart-li {
				display: block !important;
			}

			.nav-chart-tab,
			.nav-chart {
				display: block;
			}
		}
		.fullWidth{
			width: 85% !important;
		}
		
	</style>
<section class="section pt-1 page-left-sidebar" style="background-color:#f4f6f9">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                    <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]'); ?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content ">
                <div class="isPC " id="sidebar-chart">
                <div class="row">
				<div class="col-md-12 col-lg-12 col-xl-9 col-sm-12 col-xs-12 trading-chart iframe-chart">
					<div class="custom-listStock custom-width">
						<select class="normalize"></select>
					</div>
					<iframe src="https://info.sbsi.vn/chart/?symbol=FPT&language=vi&theme=light" frameborder="0" width="100%" style="margin:0; height:90vh"></iframe>
				</div>
				<div class="col-lg-12 col-xl-3 col-sm-12 col-xs-12 pl-1 pt-3 notIndexStock">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item nav-chart-li" role="presentation">
							<button class="nav-link  py-1 nav-chart-tab" data-toggle="pill" data-target=".nav-chart" type="button" role="tab" aria-controls="nav-chart" aria-selected="true">Biểu đồ</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link active py-1 nav-home-tab" data-toggle="pill" data-target=".nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tổng quan</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link py-1 nav-profile-tab" onclick="getHistories()" data-toggle="pill" data-target=".nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Sổ lệnh</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link py-1 nav-contact-tab" data-toggle="pill" data-target=".nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="chartPrice()">Mức giá</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link py-1 nav-contact-tab" data-toggle="pill" data-target=".nav-contact-2" type="button" role="tab" aria-controls="nav-contact-2" aria-selected="false" onclick="statistical()">Thống kê</button>
						</li>
					</ul>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade nav-chart" role="tabpanel" aria-labelledby="nav-chart-tab">
							<div class="trading-chart">
								<div class="custom-listStock-2">
									<select class="normalize-2"></select>
								</div>
								<iframe src="https://info.sbsi.vn/chart/?symbol=FPT&language=vi&theme=light" frameborder="0" width="100%" style="margin:0; height:93vh"></iframe>
							</div>
						</div>
						<div class="tab-pane fade show active nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<div class="nav-home-content"></div>
						</div>
						<div class="tab-pane fade pt-1 nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							<div class="row">
								<div class="col-6 pr-1">
									<div class="text-right"><b>Đặt mua</b></div>
									<div class="widgetBuyStock"></div>
								</div>
								<div class="col-6 pl-1">
									<div class="text-left"><b>Đặt bán</b></div>
									<div class="widgetSellStock"></div>
								</div>
							</div>
							<div class="historiesStock py-2 mt-2" style="border-top: 1px dashed #bbb; height: 500px">

								<table class='table table-striped table-borderless table-hover'>
									<thead class="price__histories">
										<tr>
											<th>Khớp</th>
											<th>Giá</th>
											<th>KL</th>
										</tr>
									</thead>
									<tbody class='scrollTable' id="historiesPrice"></tbody>
								</table>

								<div style="border-top: 1px solid #bbb">
									<table class="table-striped table table-borderless">
										<tr>
											<td>Tổng KL khớp</td>
											<td>
												<div id="totalQty" style="font-weight:bold"></div>
											</td>
										</tr>

									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane fade nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
							<div id="chartContainer"></div>
						</div>
						<div class="tab-pane fade nav-contact-2" role="tabpanel" aria-labelledby="nav-contact-tab">
							<div class="text-center bg-gray">
								<h4><b> GIAO DỊCH NĐTNN</b></h4>
							</div>
							<div class="py-2">
								<table class="table table-hover table-striped table-borderless" style="border-top: 1px solid #bbb">
									<tr>
										<th class='text-center'>KL Mua</th>
										<th class=' text-center'>KL Bán</th>
										<th class='text-center'>KL Mua - Bán</th>
									</tr>
									<tbody class="htmlVolume" style="background-color: #fff;"></tbody>
								</table>
								<table class="pt-4  table-striped table table-borderless table-hover">
									<tr>
										<th class='text-center'>Giá Mua</th>
										<th class='text-center'>Giá Bán</th>
										<th class='text-center'>Giá Mua - Bán</th>
									</tr>
									<tbody class="htmlPrice" style="background-color: #fff;"></tbody>
								</table>
								<div class="pt-3">
									<div class="text-center">
										<h4>GT NN mua ròng 10 phiên (tỷ)</h4>
									</div>
									<div class="chart-statistical"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-12 col-sm-12 col-xs-12 pl-1 pt-3 index__stock" style="display:none;">
					<div class="content_stock">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item nav-chart-li" role="presentation">
								<button class="nav-link  py-1 nav-chart-tab-2" data-toggle="pill" data-target=".nav-chart-2" type="button" role="tab" aria-controls="nav-chart-2" aria-selected="true">Biểu đồ</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link active py-1" id="nav-home-tab" data-toggle="pill" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tổng hợp</button>
							</li>
						</ul>
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade nav-chart-2" role="tabpanel" aria-labelledby="nav-chart-tab-2">
								<div class="trading-chart">
									<div class="custom-listStock-2">
										<select class="normalize-2"></select>
									</div>
									<iframe src="https://info.sbsi.vn/chart/?symbol=FPT&language=vi&theme=light" frameborder="0" width="100%" style="margin:0; height:100vh"></iframe>
								</div>
							</div>
							<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
								<div class="nav-home-content-2"></div>
								<div class="text-center bg-gray">
									<h4><b> GIAO DỊCH NĐTNN</b></h4>
								</div>
								<div class="py-2">
									<table class="table table-hover table-striped table-borderless" style="border-top: 1px solid #bbb">
										<tr>
											<th class='pl-2 text-center'>KL Mua</th>
											<th class='pl-2 text-center'>KL Bán</th>
											<th class='pl-2 text-center'>KL Mua - Bán</th>
										</tr>
										<tbody class="htmlVolume-2" style="background-color: #fff;"></tbody>
									</table>
									<table class="pt-4  table-striped table table-borderless table-hover">
										<tr>
											<th class='pl-2 text-center'>Giá Mua</th>
											<th class='pl-2 text-center'>Giá Bán</th>
											<th class='pl-2 text-center'>Giá Mua - Bán</th>
										</tr>
										<tbody class="htmlPrice-2" style="background-color: #fff;"></tbody>
									</table>
									<div class="pt-3">
										<div class="text-center">
											<h4>GT NN mua ròng 10 phiên (tỷ)</h4>
										</div>
										<div class="chart-statistical-2"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
                </div>
            </div>
        </div>
    </div>
    </div>

</section>
<script>
    const IS_SINGLE = "1"
</script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/trading.js"></script>
<?php get_footer(); ?>