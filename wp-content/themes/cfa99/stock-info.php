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
            left: 8.1%;
            width: 10.5%;
        }
    }

    .content_stock {
        height: 95%;
        overflow-y: scroll;
    }


    @media screen and (min-width: 1401px) {


        .custom-listStock {
        position: absolute;
        top: 0%;
        left: 8.0%;
    }
    }


    @media screen and (max-width: 1400px) {

        .custom-listStock {
            position: absolute;
            top: 0%;
            left: 10%;
            width: 9%;
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
                <div class="row">


                    <div class="col-md-12 col-lg-8 col-sm-12 col-xs-12 trading-chart">
                        <div class="custom-listStock" style=" width: 10%;">
                            <select id="normalize"></select>
                        </div>
                        <iframe src="https://info.sbsi.vn/chart/?symbol=FPT&language=vi&theme=light" frameborder="0" width="100%" style="margin:0; height:100vh"></iframe>

                    </div>
                    <div class="col-md-12 col-lg-4 col-sm-12 col-xs-12 pl-1 pt-3 notIndexStock">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active py-1" id="nav-home-tab" data-toggle="pill" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tổng quan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link py-1" id="nav-profile-tab" onclick="getHistories()" data-toggle="pill" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Sổ lệnh</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link py-1" id="nav-contact-tab" data-toggle="pill" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="chartPrice()">Mức giá</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link py-1" id="nav-contact-tab" data-toggle="pill" data-target="#nav-contact-2" type="button" role="tab" aria-controls="nav-contact-2" aria-selected="false" onclick="statistical()">Thống kê</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="nav-home-content"></div>
                            </div>
                            <div class="tab-pane fade pt-1" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="row">
                                    <div class="col-6 pr-1">
                                        <div class="text-right"><b>Đặt mua</b></div>
                                        <div id="widgetBuyStock"></div>
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
                                                    <div class="totalQty" style="font-weight:bold"></div>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div id="chartContainer"></div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact-2" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="text-center bg-gray">
                                    <h4><b> GIAO DỊCH NĐTNN</b></h4>
                                </div>
                                <div class="py-2">
                                    <table class="table table-hover table-striped table-borderless" style="border-top: 1px solid #bbb">
                                        <tr>
                                            <th class='pl-2'>KL Mua</th>
                                            <th class='pl-2'>KL Bán</th>
                                            <th class='pl-2'>KL Mua - Bán</th>
                                        </tr>
                                        <tbody class="htmlVolume" style="background-color: #fff;"></tbody>
                                    </table>
                                    <table class="pt-4  table-striped table table-borderless table-hover">
                                        <tr>
                                            <th class='pl-2'>Giá Mua</th>
                                            <th class='pl-2'>Giá Bán</th>
                                            <th class='pl-2'>Giá Mua - Bán</th>
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
                    <div class="col-md-12 col-lg-4 col-sm-12 col-xs-12 pl-1 pt-3 index__stock" style="display:none;">
                        <div class="content_stock">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active py-1" id="nav-home-tab" data-toggle="pill" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tổng hợp</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="nav-home-content"></div>
                                    <div class="text-center bg-gray">
                                        <h4><b> GIAO DỊCH NĐTNN</b></h4>
                                    </div>
                                    <div class="py-2">
                                        <table class="table table-hover table-striped table-borderless" style="border-top: 1px solid #bbb">
                                            <tr>
                                                <th class='pl-2'>KL Mua</th>
                                                <th class='pl-2'>KL Bán</th>
                                                <th class='pl-2'>KL Mua - Bán</th>
                                            </tr>
                                            <tbody class="htmlVolume-2" style="background-color: #fff;"></tbody>
                                        </table>
                                        <table class="pt-4  table-striped table table-borderless table-hover">
                                            <tr>
                                                <th class='pl-2'>Giá Mua</th>
                                                <th class='pl-2'>Giá Bán</th>
                                                <th class='pl-2'>Giá Mua - Bán</th>
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

</section>
<script>
    const IS_SINGLE = "1"
</script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/trading.js"></script>
<?php get_footer(); ?>
