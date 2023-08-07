<?php
/*
	Template Name: Chi tiết cổ phiếu

*/
get_header(); 
?>

<section class="section p-0 exp_stock">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content body-stock">
                <div class="snt-auto">
                    <div class="col-inner">
                        <div class="category-details">
                            <div class="row">
                                <div class="col large-12 medium-12 small-12 stock-heading">
                                    <div class="col-inner">
                                        <div class="stocker-heading-text">
                                            <div class="stock-icon-arrow">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 12H4M4 12L10 18M4 12L10 6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h2 class="stock-title">Tất cả báo cáo</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-stock-title">
                            <div class="row stock-details">
                                <div class="col large-12 details-info">
                                    <div class="col-inner">
                                        <div class="details-name-comp">
                                            <div class="name-comp-info">
                                                <div class="comp-info-svg">
                                                <svg
                                                    width="56"
                                                    height="56"
                                                    viewBox="0 0 56 56"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 0H56V56H0V0Z" fill="#F0F3FA"></path>
                                                    <path
                                                    d="M11.79 28H10.27C10.18 28 10.02 28 10.02 28.14C10.02 28.19 10.04 28.26 10.18 28.26C10.27 28.26 10.39 28.26 10.48 28.29C10.54 28.32 10.55 28.39 10.55 28.43C10.55 28.51 10.51 28.65 10.48 28.75C10.3 29.35 9.24 32.23 8.7 33.53L7.1 29.13C6.9996 28.9017 6.92254 28.6638 6.87 28.42C6.87 28.37 6.89 28.32 6.95 28.3C7.01 28.27 7.15 28.26 7.25 28.26C7.38 28.26 7.4 28.17 7.4 28.13C7.4 28 7.21 28 7.1 28H5.29C5.17 28 5 28 5 28.13C5 28.21 5.05 28.26 5.14 28.26C5.18 28.26 5.32 28.26 5.44 28.3C5.72 28.38 5.84 28.45 6.02 28.94L8.13 34.4L8.16 34.46C8.31 34.87 8.36 35 8.5 35C8.61 35 8.65 34.9 8.78 34.6L8.93 34.28C9.12 33.86 9.48 32.95 9.99 31.7L10.39 30.72L11 29.16C11.23 28.58 11.35 28.43 11.45 28.36C11.6 28.26 11.77 28.26 11.83 28.26C11.98 28.26 12 28.18 12 28.13C12 28.04 11.93 28 11.79 28ZM13.24 34.7L13.56 34.73C13.63 34.73 13.68 34.8 13.68 34.86C13.68 34.9 13.66 35 13.5 35C12.9567 35.0004 12.4133 35.0004 11.87 35C11.72 35 11.69 34.91 11.69 34.86C11.69 34.8 11.74 34.73 11.81 34.73C11.88 34.73 11.96 34.71 12.02 34.69C12.12 34.67 12.14 34.59 12.16 34.34C12.2 34 12.2 33.31 12.2 32.68V31.3L12.19 29.64C12.17 29.37 12.11 29.31 12.01 29.28C11.9408 29.2666 11.8705 29.2599 11.8 29.26C11.73 29.26 11.68 29.19 11.68 29.12C11.68 29.03 11.74 28.99 11.86 28.99H13.32C13.44 28.99 13.5 29.03 13.5 29.12C13.5 29.19 13.44 29.26 13.37 29.26C13.33 29.26 13.28 29.26 13.21 29.28C13.05 29.31 13.01 29.38 13.01 29.64L13 30.26V33.43C12.98 33.83 12.98 34.13 13 34.33C13.03 34.57 13.07 34.65 13.24 34.68V34.7ZM19.45 29H21C21.06 29 21.18 29.01 21.18 29.13C21.18 29.2 21.11 29.27 21.02 29.27C20.99 29.27 20.92 29.27 20.84 29.29C20.65 29.33 20.62 29.5 20.62 29.97L20.6 34.39C20.6 34.89 20.6 35 20.47 35C20.37 35 20.29 34.95 19.82 34.52C18.3533 33.241 16.9515 31.8893 15.62 30.47L15.71 33.85C15.73 34.48 15.81 34.6 15.96 34.65L16.34 34.69C16.42 34.69 16.48 34.74 16.48 34.82C16.48 34.88 16.44 35 16.26 35H14.66C14.6 35 14.46 34.95 14.46 34.82C14.46 34.74 14.51 34.69 14.59 34.69C14.65 34.69 14.79 34.68 14.89 34.64C15.01 34.61 15.01 34.5 15 34.11V29.45C15 29.23 15.08 29 15.25 29C15.35 29 15.45 29.1 15.57 29.21L15.61 29.25L15.97 29.63L16.01 29.67C16.59 30.27 17.21 30.85 17.83 31.44C18.49 32.07 19.15 32.69 19.75 33.32C19.82 33.39 19.86 33.45 19.9 33.51C19.9293 33.5563 19.9628 33.5998 20 33.64V30.04C19.99 29.53 19.92 29.34 19.74 29.31C19.6145 29.2871 19.4875 29.2738 19.36 29.27C19.28 29.27 19.23 29.22 19.23 29.13C19.23 29.01 19.39 29 19.45 29Z"
                                                    fill="#C4842A"
                                                    ></path>
                                                    <path
                                                    d="M27.6091 34.7301L27.2891 34.6901C27.1091 34.6701 27.0291 34.5901 26.9991 34.3501C26.9791 34.1201 26.9791 33.7501 26.9991 33.3401V31.3101V30.2101C26.9991 29.9101 26.9891 29.7901 26.9991 29.6501C27.0191 29.3901 27.0991 29.3201 27.2491 29.2901L27.4191 29.2701C27.4891 29.2701 27.5591 29.2001 27.5591 29.1301C27.5591 29.0701 27.5291 29.0001 27.3591 29.0001C26.8258 28.9997 26.2925 28.9997 25.7591 29.0001C25.6291 29.0001 25.5591 29.0501 25.5591 29.1401C25.5591 29.2001 25.6191 29.2701 25.6991 29.2701C25.7591 29.2701 25.8791 29.2701 25.9391 29.2901C26.1391 29.3201 26.1691 29.3901 26.1891 29.6601L26.1991 31.3301V31.4701H22.9991V31.3301V30.2401V29.6501C23.0191 29.3901 23.1591 29.3201 23.3191 29.2901C23.3891 29.2701 23.4391 29.2701 23.4891 29.2701C23.5591 29.2701 23.6191 29.2001 23.6191 29.1401C23.6191 29.0401 23.5591 29.0001 23.4291 29.0001H21.8191C21.6891 29.0001 21.6191 29.0401 21.6191 29.1301C21.6191 29.2001 21.6891 29.2701 21.7591 29.2701C21.8191 29.2701 21.9391 29.2701 21.9991 29.2901C22.1991 29.3201 22.2391 29.3901 22.2591 29.6501L22.2691 31.3101V32.6801C22.2691 33.4301 22.2691 34.0301 22.2291 34.3401V34.3701C22.1891 34.6001 22.1691 34.6701 22.0791 34.7001C22.0105 34.718 21.9401 34.7281 21.8691 34.7301C21.7891 34.7301 21.7391 34.8001 21.7391 34.8601C21.7391 34.9101 21.7591 35.0001 21.9291 35.0001H23.6191C23.7991 35.0001 23.8091 34.9001 23.8091 34.8701C23.8091 34.8001 23.7591 34.7301 23.6791 34.7301C23.5686 34.7266 23.4585 34.7166 23.3491 34.7001C23.1791 34.6701 23.0291 34.5801 22.9991 34.3501C22.9791 34.1501 22.9791 33.8401 22.9991 33.4501V32.0001H26.1991V32.7001C26.1991 33.4401 26.1991 34.0201 26.1691 34.3401C26.1391 34.5801 26.1191 34.6701 26.0091 34.7001C25.9439 34.718 25.8768 34.728 25.8091 34.7301C25.7291 34.7301 25.6791 34.8001 25.6791 34.8701C25.6791 34.9501 25.7391 35.0001 25.8691 35.0001H27.5491C27.7391 35.0001 27.7491 34.8901 27.7491 34.8701C27.7506 34.8513 27.7481 34.8324 27.7416 34.8147C27.7351 34.7971 27.7248 34.781 27.7115 34.7677C27.6982 34.7544 27.6821 34.7441 27.6645 34.7376C27.6468 34.7311 27.6279 34.7285 27.6091 34.7301ZM48.7391 31.5301L48.5191 31.3901C47.7791 30.8701 47.5791 30.6101 47.5791 30.1701C47.5791 29.6301 48.0791 29.4301 48.5091 29.4301C49.2091 29.4301 49.4191 29.7501 49.4291 29.7701C49.4691 29.8401 49.5291 30.0301 49.5291 30.1101C49.5391 30.1701 49.5591 30.2701 49.6691 30.2701C49.7891 30.2701 49.7891 30.1301 49.7891 30.0301C49.7891 29.6301 49.8091 29.4001 49.8191 29.3001V29.2901V29.2401C49.8191 29.1201 49.7191 29.1201 49.6891 29.1201C49.6291 29.1201 49.5691 29.1201 49.4391 29.0901C49.1767 29.0302 48.9083 29 48.6391 29.0001C47.5891 29.0001 46.9091 29.5801 46.9091 30.4701C46.9091 31.0501 47.2291 31.5201 48.0091 32.1301L48.3591 32.3901C49.0291 32.9001 49.2791 33.1401 49.2791 33.6401C49.2791 34.2101 48.8791 34.5701 48.2091 34.5701C47.7391 34.5701 47.1991 34.3901 47.0891 33.8701C47.0591 33.7801 47.0591 33.6801 47.0591 33.6201C47.0591 33.5101 46.9891 33.4701 46.9291 33.4701C46.8791 33.4701 46.8091 33.4901 46.8091 33.6501L46.7991 33.7501V33.7601C46.7791 33.9101 46.7591 34.1601 46.7591 34.4501C46.7591 34.6501 46.7691 34.7201 46.9091 34.7901C47.2991 34.9801 47.8291 35.0001 48.0291 35.0001C48.5791 35.0001 48.9891 34.9001 49.2691 34.7201C49.7491 34.4001 49.9991 33.9501 49.9991 33.3901C49.9991 32.7001 49.6291 32.1601 48.7391 31.5401V31.5301ZM27.9991 32.0001C27.9991 30.7601 28.9291 29.0101 30.9991 29.0101C32.7991 29.0101 33.9991 30.1701 33.9991 31.8901C33.9991 33.6701 32.6991 35.0101 30.9591 35.0101C28.9291 35.0101 27.9991 33.4501 27.9991 32.0101V32.0001ZM28.8991 31.8001C28.8991 33.4501 29.8091 34.5601 31.1691 34.5601C31.4991 34.5601 33.1091 34.4501 33.1091 32.1001C33.1091 30.2501 32.0291 29.4301 30.9591 29.4301C29.6591 29.4301 28.8991 30.3101 28.8991 31.8001ZM41.5691 34.7501C41.4991 34.7501 41.2991 34.7501 41.0991 34.6801C40.8491 34.5901 40.7891 34.2801 40.7591 33.9501L40.2391 29.2801C40.2091 29.0601 40.1291 29.0101 40.0591 29.0101C39.9591 29.0101 39.9091 29.1101 39.8791 29.1701L37.7391 33.7701L35.5091 29.1701C35.4491 29.0301 35.3491 29.0101 35.2991 29.0101C35.2191 29.0101 35.1591 29.0901 35.1391 29.2101L34.5891 34.1701V34.2501C34.5491 34.5201 34.5291 34.6901 34.3591 34.7201H34.3391L34.1391 34.7501C34.0591 34.7501 33.9991 34.8001 33.9991 34.8701C33.9991 34.9201 34.0291 35.0101 34.1991 35.0101H35.5391C35.7091 35.0101 35.7391 34.9301 35.7391 34.8701C35.7391 34.8001 35.6691 34.7501 35.6191 34.7501C35.5591 34.7501 35.4491 34.7301 35.3391 34.7001C35.2091 34.6701 35.2091 34.5801 35.2091 34.5601V34.1801L35.4891 30.9401L36.0991 32.2501L36.2891 32.6501L36.3891 32.8401C36.5791 33.2701 37.0891 34.2601 37.2691 34.6101C37.4191 34.8901 37.4691 34.9901 37.5891 34.9901C37.6891 34.9901 37.7491 34.8901 37.9091 34.5501L39.6491 30.8501L39.9891 34.4901V34.6901C39.9636 34.6983 39.9412 34.7143 39.9251 34.7358C39.909 34.7573 39.8999 34.7832 39.8991 34.8101C39.8991 34.9301 40.0291 35.0001 40.1791 35.0101H41.4791C41.6091 35.0101 41.6891 34.9501 41.6891 34.8701C41.6891 34.8001 41.6391 34.7501 41.5691 34.7501ZM45.6891 33.9901C45.7091 33.9301 45.7291 33.8201 45.8391 33.8201C45.8691 33.8201 45.9591 33.8401 45.9591 34.0101C45.9591 34.0601 45.8891 34.5901 45.8491 34.7601C45.7791 35.0101 45.6591 35.0101 45.3591 35.0101H42.6591C42.4891 35.0101 42.4591 34.9101 42.4591 34.8601C42.4591 34.7901 42.5091 34.7301 42.5891 34.7301L42.7291 34.7101L42.8191 34.6901C42.8991 34.6801 42.9191 34.5901 42.9491 34.3701V34.3501C42.9991 34.0401 42.9991 33.4501 42.9991 32.7001V31.3501C42.9991 30.1701 42.9991 29.9501 42.9791 29.7101C42.9691 29.4601 42.9291 29.3801 42.7291 29.3501L42.4791 29.3401C42.4191 29.3401 42.3491 29.2701 42.3491 29.2101C42.3491 29.1101 42.4191 29.0101 42.5491 29.0101H45.6691C45.6891 29.0101 45.7691 29.0101 45.7691 29.1501L45.7591 29.2501C45.7206 29.3868 45.7004 29.528 45.6991 29.6701L45.6691 30.0301C45.6491 30.1001 45.5991 30.1601 45.5291 30.1601C45.4991 30.1601 45.4091 30.1601 45.4091 30.0001C45.4091 29.9501 45.3991 29.8301 45.3691 29.7501C45.3291 29.6701 45.2891 29.6201 44.8791 29.5601L43.8191 29.5401V31.6301L45.0491 31.6201H45.0691C45.2291 31.6001 45.3291 31.5901 45.3791 31.5201L45.4091 31.5001C45.4591 31.4501 45.4891 31.4001 45.5391 31.4001C45.5891 31.4001 45.6491 31.4401 45.6491 31.5401L45.6391 31.6401C45.5999 31.912 45.5732 32.1856 45.5591 32.4601C45.5591 32.5901 45.5091 32.6701 45.4191 32.6701C45.3691 32.6701 45.3091 32.6301 45.3091 32.5301C45.3091 32.4601 45.3091 32.3901 45.2691 32.3001C45.2591 32.2401 45.2391 32.1501 44.9391 32.1101C44.7391 32.0901 43.9991 32.0801 43.8191 32.0801V34.0001C43.8391 34.4501 43.9091 34.5501 44.6591 34.5501C44.8491 34.5501 45.1991 34.5501 45.3891 34.4701C45.5491 34.4001 45.6491 34.3001 45.6891 33.9901Z"
                                                    fill="#0C1C56"
                                                    ></path>
                                                    <path
                                                    d="M34.93 12C31.37 12.46 27.73 13.7 27.49 17.5C27.38 19.27 27.89 20.6 28.46 21.88C27.6559 20.9875 26.65 20.3003 25.5262 19.8758C24.4024 19.4514 23.1933 19.3019 22 19.44C23.78 19.98 25.89 21.01 27.02 22.37C27.26 22.67 27.61 23.17 27.52 23.59C27.39 24.31 26.15 24.17 25.4 24.21C26.95 24.87 28.7 26.07 30.92 26C32.03 25.96 32.85 25.24 32.76 23.9C32.61 21.5 30.95 19.44 30.78 16.73C30.58 13.67 32.6 12.54 34.86 12.04C34.9 12.06 34.98 12.04 34.99 12.03C35.01 12.01 34.99 12 34.93 12Z"
                                                    fill="url(#paint0_linear_43_13290)"
                                                    ></path>
                                                    <defs>
                                                    <linearGradient
                                                        id="paint0_linear_43_13290"
                                                        x1="33.5"
                                                        y1="21.74"
                                                        x2="27.53"
                                                        y2="15.87"
                                                        gradientUnits="userSpaceOnUse"
                                                    >
                                                        <stop stop-color="#FDB913"></stop>
                                                    </linearGradient>
                                                    </defs>
                                                </svg>
                                                    <br />
                                                <stop offset="0.22" stop-color="#E5A521"><br/>
                                                    <stop offset="0.51" stop-color="#CE9130"><br/>
                                                        <stop offset="0.77" stop-color="#C08538"><br/>
                                                            <stop offset="1" stop-color="#BB813B"><br/> 
                                                            </stop>
                                                        </stop>
                                                    </stop>
                                                </stop>
                                                </div>
                                                <div class="comp-info-details">
                                                    <div class="info-detail-name">
                                                        <h1>CÔNG TY CỔ PHẦN VINHOMES</h1>
                                                        <div class="info-details-des">
                                                            <span class="name-acr">VHM</span><br />
                                                            <svg
                                                                width="18"
                                                                height="18"
                                                                viewBox="0 0 18 18"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                d="M9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18Z"
                                                                fill="#D80027"
                                                                ></path>
                                                                <path
                                                                d="M8.99917 4.69592L9.97046 7.68523H13.1136L10.5707 9.53269L11.542 12.522L8.99917 10.6745L6.45632 12.522L7.42762 9.53269L4.88477 7.68523H8.02787L8.99917 4.69592Z"
                                                                fill="#FFDA44"
                                                                ></path>
                                                            </svg>
                                                            <br/>
                                                            <span>HOME</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row details-info-comp" id="row">
                                            <div id="col" class="col medium-4 small-12 large-5">
                                                <div class="col-inner">
                                                    <div class="details-content-comp">
                                                        <div class="content-price">
                                                            <div class="content-price-title">
                                                                <h1>67452</h1>
                                                                <p></p>
                                                            </div>
                                                            <div class="content-price-unit">
                                                                <h6 class="price-unit">VND</h6>
                                                                <p></p>
                                                            </div>
                                                            <div class="content-price-percent">
                                                                <h3 class="percent">-700 (-13,3%) </h3>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                        <div class="content-des">
                                                            <div class="dot"></div>
                                                            <p>THỊ TRƯỜNG ĐÓNG CỬA (KỂ TỪ 14:50 GMT +7, 1 THG 7)</p>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_43_13315)">
                                                                <path d="M10.625 9.375C10.625 9.02982 10.3452 8.75 10 8.75C9.65482 8.75 9.375 9.02982 9.375 9.375V13.125C9.375 13.4702 9.65482 13.75 10 13.75C10.3452 13.75 10.625 13.4702 10.625 13.125V9.375Z" fill="#98A2B3"/>
                                                                <path d="M10.625 6.875C10.625 7.22018 10.3452 7.5 10 7.5C9.65482 7.5 9.375 7.22018 9.375 6.875C9.375 6.52982 9.65482 6.25 10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875Z" fill="#98A2B3"/>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5ZM3.75 10C3.75 6.54822 6.54822 3.75 10 3.75C13.4518 3.75 16.25 6.54822 16.25 10C16.25 13.4518 13.4518 16.25 10 16.25C6.54822 16.25 3.75 13.4518 3.75 10Z" fill="#98A2B3"/>
                                                                </g>
                                                                <defs>
                                                                <clipPath id="clip0_43_13315">
                                                                <rect width="15" height="15" fill="white" transform="translate(2.5 2.5)"/>
                                                                </clipPath>
                                                                </defs>
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="col" class="col medium-8 small-12 large-7">
                                                <div class="col-inner">
                                                    <div class="row details-info-comp" id="row">
                                                        <div id="col" class="col medium-3 small-12 large-3">
                                                            <div class="col-inner">
                                                                <h4>31 THG 8</h4>
                                                                <p class="content-price-text">THU NHẬP SẮP TỚI</p>
                                                            </div>
                                                        </div>

                                                        <div id="col" class="col medium-4 small-12 large-4">
                                                            <div class="col-inner">
                                                                <h4>8800</h4>
                                                                <p class="content-price-text">LỢI NHUẬN TRÊN MỖI CỔ PHIẾU</p>
                                                            </div>
                                                        </div>

                                                        <div id="col" class="col medium-2 small-12 large-2">
                                                            <div class="col-inner">
                                                                <h4>267.3558T</h4>
                                                                <p class="content-price-text">VỐN HÓA</p>
                                                            </div>
                                                        </div>

                                                        <div id="col" class="col medium-2 small-12 large-2">
                                                            <div class="col-inner">
                                                                <h4>3.26%</h4>
                                                                <p class="content-price-text">TỶ SUẤT CỔ TỨC</p>
                                                            </div>
                                                        </div>

                                                        <div id="col" class="col medium-1 small-12 large-1">
                                                            <div class="col-inner">
                                                                <div id="text" class="text">
                                                                    <h4>0</h4>
                                                                    <p class="content-price-text">P/E</p>

                                                                    <style>
                                                                    #text {
                                                                        text-align: left;
                                                                    }
                                                                    </style>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col large-12 details-text">
                                    <div class="col-inner">
                                        <div class="tabbed-content">
                                            <ul class="nav nav-line-bottom nav-normal nav-size-xlarge nav-left">
                                                <li class="tab active has-icon tongquan">
                                                <a href="#tab_tổng-quan"><span>Tổng quan</span></a>
                                                </li>
                                                <li class="tab has-icon">
                                                <a href="#tab_tin-tức"><span>Tin tức</span></a>
                                                </li>
                                            </ul>
                                            <div class="tab-panels">
                                                <div class="panel active entry-content" id="tab_tổng-quan">
                                                    <p>
                                                        Sở Giao dịch Chứng khoán Thành phố Hồ Chí Minh, còn được gọi là sàn
                                                        HOSE, là sàn chứng khoán lớn nhất và nổi bật nhất tại Việt Nam. Sàn này
                                                        được thành lập vào năm 2000 với chỉ 2 công ty niêm yết và hiện đang niêm
                                                        yết 396 công ty với tổng giá trị vốn hóa thị trường là 148 tỷ đô la. Sàn
                                                        giao dịch có trụ sở tại thành phố Hồ Chí Minh, trước đây gọi là Sài Gòn,
                                                        thành phố đông dân nhất cũng như trung tâm kinh tế và tài chính của đất
                                                        nước. HOSE thuộc sở hữu của Bộ Tài chính và do Ủy ban Chứng khoán Nhà
                                                        nước quản lý. Sàn là thành viên của Hiệp hội Sở giao dịch Chứng khoán
                                                        Bền vững, một dự án của Liên Hiệp Quốc. Ngoài cổ phiếu, sàn giao dịch
                                                        còn có trái phiếu.
                                                    </p>
                                                    <p>
                                                        Trong số những công ty được niêm yết phải kể đến những mã nổi tiếng và
                                                        được giao dịch nhiều như Vingroup, Vinamilk, Petrovietnam Gas,
                                                        Vietcombank và Sabeco. HOSE quản lý chỉ số VN 30, một chỉ số đo lường
                                                        vốn hóa thị trường được điều chỉnh tự do theo dõi hiệu suất của 30 cổ
                                                        phiếu vốn hóa lớn và có tính thanh khoản cao. Nó cũng quản lý chỉ số
                                                        Allshare mà theo dõi hiệu suất của tất cả các công ty được niêm yết trên
                                                        sàn HOSE thông qua việc kiểm tra đảm bảo đủ điều kiện. Các chỉ số này
                                                        được thiết kế như các chỉ số chuẩn chính thức và được sử dụng bởi một số
                                                        quỹ theo dõi chỉ mục. Các chỉ số khác trong cùng chuỗi là chỉ số VN 100,
                                                        VN Midcap và VN Smallcap. HOSE cũng điều hành một loạt các chỉ số ngành
                                                        phản ánh hiệu suất của 10 ngành và lĩnh vực.
                                                    </p>
                                                </div>
                                                <div class="panel entry-content" id="tab_tin-tức">
                                                    <div class="row large-columns-4 medium-columns-1 small-columns-1">
                                                        <div class="col post-item">
                                                            <div class="col-inner">
                                                                <a
                                                                href="https://cfa99.a2ztech.vn/giao-dich-chung-khoan-phien-sang-26-7-thi-truong-tiep-tuc-phan-hoa-va-giao-dich-am-dam/"
                                                                class="plain"
                                                                >
                                                                <div
                                                                    class="box box-normal box-text-bottom box-blog-post has-hover"
                                                                >
                                                                    <div class="box-image" style="border-radius: 5%">
                                                                    <div class="image-cover" style="padding-top: 56.25%">
                                                                        <img
                                                                        width="300"
                                                                        height="175"
                                                                        src="https://cfa99.a2ztech.vn/medias/2022/07/screen-shot-2021-07-06-at-160825-16255625223251849990193-300x175.png"
                                                                        class="attachment-medium size-medium wp-post-image"
                                                                        alt=""
                                                                        srcset="
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/screen-shot-2021-07-06-at-160825-16255625223251849990193-300x175.png   300w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/screen-shot-2021-07-06-at-160825-16255625223251849990193-1024x599.png 1024w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/screen-shot-2021-07-06-at-160825-16255625223251849990193-768x449.png   768w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/screen-shot-2021-07-06-at-160825-16255625223251849990193-1536x898.png 1536w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/screen-shot-2021-07-06-at-160825-16255625223251849990193-600x351.png   600w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/screen-shot-2021-07-06-at-160825-16255625223251849990193.png          2000w
                                                                        "
                                                                        sizes="(max-width: 300px) 100vw, 300px"
                                                                        />
                                                                    </div>
                                                                    </div>
                                                                    <div class="box-text text-left">
                                                                    <div class="box-text-inner blog-post-inner">
                                                                        <h5 class="post-title is-large">
                                                                        Giao dịch chứng khoán phiên sáng 26/7: Thị trường tiếp tục
                                                                        phân hóa và giao dịch ảm đạm
                                                                        </h5>
                                                                        <div class="is-divider"></div>
                                                                        <p class="from_the_blog_excerpt">
                                                                        (ĐTCK) Thị trường đang thiếu đi điểm tựa và thực sự “khát”
                                                                        thông tin. Giao......
                                                                        </p>

                                                                        <div class="info-news-meta">
                                                                        <div class="info-author">a2ztech_admin</div>
                                                                        <div class="info-date">
                                                                            <svg
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                            <path
                                                                                d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z"
                                                                                fill="#475467"
                                                                            ></path>
                                                                            </svg>
                                                                            26-07-22
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col post-item">
                                                            <div class="col-inner">
                                                                <a
                                                                href="https://cfa99.a2ztech.vn/bat-dong-san-chiem-26-thi-truong-trai-phieu-nua-dau-nam/"
                                                                class="plain"
                                                                >
                                                                <div
                                                                    class="box box-normal box-text-bottom box-blog-post has-hover"
                                                                >
                                                                    <div class="box-image" style="border-radius: 5%">
                                                                    <div class="image-cover" style="padding-top: 56.25%">
                                                                        <img
                                                                        width="300"
                                                                        height="200"
                                                                        src="https://cfa99.a2ztech.vn/medias/2022/07/chinh-sach-moi-anh-huong-den-thi-truong-bat-dong-san_1602162451-300x200.png"
                                                                        class="attachment-medium size-medium wp-post-image"
                                                                        alt=""
                                                                        loading="lazy"
                                                                        srcset="
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/chinh-sach-moi-anh-huong-den-thi-truong-bat-dong-san_1602162451-300x200.png 300w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/chinh-sach-moi-anh-huong-den-thi-truong-bat-dong-san_1602162451.png         750w
                                                                        "
                                                                        sizes="(max-width: 300px) 100vw, 300px"
                                                                        />
                                                                    </div>
                                                                    </div>
                                                                    <div class="box-text text-left">
                                                                    <div class="box-text-inner blog-post-inner">
                                                                        <h5 class="post-title is-large">
                                                                        Bất động sản chiếm 26% thị trường trái phiếu nửa đầu năm
                                                                        </h5>
                                                                        <div class="is-divider"></div>
                                                                        <p class="from_the_blog_excerpt">
                                                                        Doanh nghiệp bất động sản phát hành trái phiếu nhiều thứ
                                                                        hai trên thị trường......
                                                                        </p>

                                                                        <div class="info-news-meta">
                                                                        <div class="info-author">a2ztech_admin</div>
                                                                        <div class="info-date">
                                                                            <svg
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                            <path
                                                                                d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z"
                                                                                fill="#475467"
                                                                            ></path>
                                                                            </svg>
                                                                            26-07-22
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col post-item">
                                                            <div class="col-inner">
                                                                <a
                                                                href="https://cfa99.a2ztech.vn/co-phieu-bat-dong-san-noi-song/"
                                                                class="plain"
                                                                >
                                                                <div
                                                                    class="box box-normal box-text-bottom box-blog-post has-hover"
                                                                >
                                                                    <div class="box-image" style="border-radius: 5%">
                                                                    <div class="image-cover" style="padding-top: 56.25%">
                                                                        <img
                                                                        width="300"
                                                                        height="87"
                                                                        src="https://cfa99.a2ztech.vn/medias/2022/07/A-nh-chu-p-Ma-n-hi-nh-2022-07-3844-3961-1657271594-300x87.png"
                                                                        class="attachment-medium size-medium wp-post-image"
                                                                        alt=""
                                                                        loading="lazy"
                                                                        srcset="
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/A-nh-chu-p-Ma-n-hi-nh-2022-07-3844-3961-1657271594-300x87.png    300w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/A-nh-chu-p-Ma-n-hi-nh-2022-07-3844-3961-1657271594-1024x298.png 1024w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/A-nh-chu-p-Ma-n-hi-nh-2022-07-3844-3961-1657271594-768x224.png   768w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/A-nh-chu-p-Ma-n-hi-nh-2022-07-3844-3961-1657271594-1536x447.png 1536w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/A-nh-chu-p-Ma-n-hi-nh-2022-07-3844-3961-1657271594.png          1972w
                                                                        "
                                                                        sizes="(max-width: 300px) 100vw, 300px"
                                                                        />
                                                                    </div>
                                                                    </div>
                                                                    <div class="box-text text-left">
                                                                    <div class="box-text-inner blog-post-inner">
                                                                        <h5 class="post-title is-large">
                                                                        Cổ phiếu bất động sản nổi sóng
                                                                        </h5>
                                                                        <div class="is-divider"></div>
                                                                        <p class="from_the_blog_excerpt">
                                                                        Cổ phiếu bất động sản trở thành điểm nhấn trong phiên cuối
                                                                        tuần khi đồng......
                                                                        </p>

                                                                        <div class="info-news-meta">
                                                                        <div class="info-author">a2ztech_admin</div>
                                                                        <div class="info-date">
                                                                            <svg
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                            <path
                                                                                d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z"
                                                                                fill="#475467"
                                                                            ></path>
                                                                            </svg>
                                                                            26-07-22
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col post-item">
                                                            <div class="col-inner">
                                                                <a
                                                                href="https://cfa99.a2ztech.vn/bitcoin-lai-giam-ve-21-000-usd/"
                                                                class="plain"
                                                                >
                                                                <div
                                                                    class="box box-normal box-text-bottom box-blog-post has-hover"
                                                                >
                                                                    <div class="box-image" style="border-radius: 5%">
                                                                    <div class="image-cover" style="padding-top: 56.25%">
                                                                        <img
                                                                        width="300"
                                                                        height="168"
                                                                        src="https://cfa99.a2ztech.vn/medias/2022/07/bitcoin.jpg"
                                                                        class="attachment-medium size-medium wp-post-image"
                                                                        alt=""
                                                                        loading="lazy"
                                                                        />
                                                                    </div>
                                                                    </div>
                                                                    <div class="box-text text-left">
                                                                    <div class="box-text-inner blog-post-inner">
                                                                        <h5 class="post-title is-large">
                                                                        Bitcoin lại giảm về 21.000 USD
                                                                        </h5>
                                                                        <div class="is-divider"></div>
                                                                        <p class="from_the_blog_excerpt">
                                                                        Chỉ trong gần một tuần, giá Bitcoin mất 12,5%, về quanh
                                                                        21.000 USD trước thềm......
                                                                        </p>

                                                                        <div class="info-news-meta">
                                                                        <div class="info-author">a2ztech_admin</div>
                                                                        <div class="info-date">
                                                                            <svg
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                            <path
                                                                                d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z"
                                                                                fill="#475467"
                                                                            ></path>
                                                                            </svg>
                                                                            26-07-22
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col post-item">
                                                            <div class="col-inner">
                                                                <a
                                                                href="https://cfa99.a2ztech.vn/thi-truong-chuyen-tru-trong-dot-tang-toi-ket-qua-kinh-doanh-tot-gia-vua-pha-dinh/"
                                                                class="plain"
                                                                >
                                                                <div
                                                                    class="box box-normal box-text-bottom box-blog-post has-hover"
                                                                >
                                                                    <div class="box-image" style="border-radius: 5%">
                                                                    <div class="image-cover" style="padding-top: 56.25%">
                                                                        <img
                                                                        width="300"
                                                                        height="200"
                                                                        src="https://cfa99.a2ztech.vn/medias/2022/07/ads-1-300x200.jpg"
                                                                        class="attachment-medium size-medium wp-post-image"
                                                                        alt=""
                                                                        loading="lazy"
                                                                        srcset="
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1-300x200.jpg  300w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1-768x512.jpg  768w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1.jpg         1000w
                                                                        "
                                                                        sizes="(max-width: 300px) 100vw, 300px"
                                                                        />
                                                                    </div>
                                                                    </div>
                                                                    <div class="box-text text-left">
                                                                    <div class="box-text-inner blog-post-inner">
                                                                        <h5 class="post-title is-large">
                                                                        Thị trường chuyển trụ trong đợt tăng tới – Kết quả kinh
                                                                        doanh tốt – Giá vừa phá đỉnh
                                                                        </h5>
                                                                        <div class="is-divider"></div>
                                                                        <p class="from_the_blog_excerpt">
                                                                        5 Ảnh hưởng từ cuộc xung đột Nga – Ukraine đến toàn thế
                                                                        giới như......
                                                                        </p>

                                                                        <div class="info-news-meta">
                                                                        <div class="info-author">a2ztech_admin</div>
                                                                        <div class="info-date">
                                                                            <svg
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                            <path
                                                                                d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z"
                                                                                fill="#475467"
                                                                            ></path>
                                                                            </svg>
                                                                            24-07-22
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col post-item">
                                                            <div class="col-inner">
                                                                <a
                                                                href="https://cfa99.a2ztech.vn/4-beautiful-soundtracks-relaxing-piano-10min/"
                                                                class="plain"
                                                                >
                                                                <div
                                                                    class="box box-normal box-text-bottom box-blog-post has-hover"
                                                                >
                                                                    <div class="box-image" style="border-radius: 5%">
                                                                    <div class="image-cover" style="padding-top: 56.25%">
                                                                        <img
                                                                        width="300"
                                                                        height="200"
                                                                        src="https://cfa99.a2ztech.vn/medias/2022/07/ads-1-300x200.jpg"
                                                                        class="attachment-medium size-medium wp-post-image"
                                                                        alt=""
                                                                        loading="lazy"
                                                                        srcset="
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1-300x200.jpg  300w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1-768x512.jpg  768w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1.jpg         1000w
                                                                        "
                                                                        sizes="(max-width: 300px) 100vw, 300px"
                                                                        />
                                                                    </div>
                                                                    </div>
                                                                    <div class="box-text text-left">
                                                                    <div class="box-text-inner blog-post-inner">
                                                                        <h5 class="post-title is-large">
                                                                        4 Beautiful Soundtracks | Relaxing Piano [10min]
                                                                        </h5>
                                                                        <div class="is-divider"></div>
                                                                        <p class="from_the_blog_excerpt">
                                                                        5 Ảnh hưởng từ cuộc xung đột Nga – Ukraine đến toàn thế
                                                                        giới như......
                                                                        </p>

                                                                        <div class="info-news-meta">
                                                                        <div class="info-author">a2ztech_admin</div>
                                                                        <div class="info-date">
                                                                            <svg
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                            <path
                                                                                d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z"
                                                                                fill="#475467"
                                                                            ></path>
                                                                            </svg>
                                                                            24-07-22
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col post-item">
                                                            <div class="col-inner">
                                                                <a
                                                                href="https://cfa99.a2ztech.vn/5-anh-huong-tu-cuoc-xung-dot-nga-ukraine-den-toan-the-gioi-nhu-the-nao/"
                                                                class="plain"
                                                                >
                                                                <div
                                                                    class="box box-normal box-text-bottom box-blog-post has-hover"
                                                                >
                                                                    <div class="box-image" style="border-radius: 5%">
                                                                    <div class="image-cover" style="padding-top: 56.25%">
                                                                        <img
                                                                        width="300"
                                                                        height="200"
                                                                        src="https://cfa99.a2ztech.vn/medias/2022/07/ads-1-300x200.jpg"
                                                                        class="attachment-medium size-medium wp-post-image"
                                                                        alt=""
                                                                        loading="lazy"
                                                                        srcset="
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1-300x200.jpg  300w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1-768x512.jpg  768w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1.jpg         1000w
                                                                        "
                                                                        sizes="(max-width: 300px) 100vw, 300px"
                                                                        />
                                                                    </div>
                                                                    </div>
                                                                    <div class="box-text text-left">
                                                                    <div class="box-text-inner blog-post-inner">
                                                                        <h5 class="post-title is-large">
                                                                        5 Ảnh hưởng từ cuộc xung đột Nga – Ukraine đến toàn thế
                                                                        giới như thế nào ?
                                                                        </h5>
                                                                        <div class="is-divider"></div>
                                                                        <p class="from_the_blog_excerpt">
                                                                        5 Ảnh hưởng từ cuộc xung đột Nga – Ukraine đến toàn thế
                                                                        giới như......
                                                                        </p>

                                                                        <div class="info-news-meta">
                                                                        <div class="info-author">a2ztech_admin</div>
                                                                        <div class="info-date">
                                                                            <svg
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                            <path
                                                                                d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z"
                                                                                fill="#475467"
                                                                            ></path>
                                                                            </svg>
                                                                            24-07-22
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col post-item">
                                                            <div class="col-inner">
                                                                <a
                                                                href="https://cfa99.a2ztech.vn/5-anh-huong-tu-cuoc-xung-dot-nga-ukraine-den-toan-the-gioi-nhu-the-nao/"
                                                                class="plain"
                                                                >
                                                                <div
                                                                    class="box box-normal box-text-bottom box-blog-post has-hover"
                                                                >
                                                                    <div class="box-image" style="border-radius: 5%">
                                                                    <div class="image-cover" style="padding-top: 56.25%">
                                                                        <img
                                                                        width="300"
                                                                        height="200"
                                                                        src="https://cfa99.a2ztech.vn/medias/2022/07/ads-1-300x200.jpg"
                                                                        class="attachment-medium size-medium wp-post-image"
                                                                        alt=""
                                                                        loading="lazy"
                                                                        srcset="
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1-300x200.jpg  300w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1-768x512.jpg  768w,
                                                                            https://cfa99.a2ztech.vn/medias/2022/07/ads-1.jpg         1000w
                                                                        "
                                                                        sizes="(max-width: 300px) 100vw, 300px"
                                                                        />
                                                                    </div>
                                                                    </div>
                                                                    <div class="box-text text-left">
                                                                    <div class="box-text-inner blog-post-inner">
                                                                        <h5 class="post-title is-large">
                                                                        5 Ảnh hưởng từ cuộc xung đột Nga – Ukraine đến toàn thế
                                                                        giới như thế nào ?
                                                                        </h5>
                                                                        <div class="is-divider"></div>
                                                                        <p class="from_the_blog_excerpt">
                                                                        5 Ảnh hưởng từ cuộc xung đột Nga – Ukraine đến toàn thế
                                                                        giới như......
                                                                        </p>

                                                                        <div class="info-news-meta">
                                                                        <div class="info-author">a2ztech_admin</div>
                                                                        <div class="info-date">
                                                                            <svg
                                                                            width="10"
                                                                            height="10"
                                                                            viewBox="0 0 10 10"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            >
                                                                            <path
                                                                                d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z"
                                                                                fill="#475467"
                                                                            ></path>
                                                                            </svg>
                                                                            24-07-22
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="snt-pagination-wrapper">
                                        <div class="snt-pagi-info">
                                        Hiển thị 1 - 20 trên 180
                                        </div>
                                        <div class="snt-pagination">
                                            <a href="#" class="arrow">
                                                <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.28 1.58L7.1 0.400002L0.5 7L7.1 13.6L8.28 12.42L2.86 7L8.28 1.58Z" fill="#1D2939"/>
                                                </svg>
                                                Đầu tiên
                                            </a>
                                            <a href="#">1</a>
                                            <a href="#" class="active">2</a>
                                            <a href="#">3</a>
                                            <a href="#">4</a>
                                            <a href="#">5</a>
                                            <a href="#" class="arrow">
                                                Cuối cùng 
                                                <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.419922 1.74667L5.67326 7L0.419922 12.2533L1.83326 13.6667L8.49992 7L1.83326 0.333336L0.419922 1.74667Z" fill="#1D2939"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="snt-pagi-select">
                                            <div>Hiển thị </div>
                                            <div class="pagi-select">
                                                <select name="pagi-select" id="">
                                                    <option value="">10</option>
                                                    <option value="">20</option>
                                                    <option value="">30</option>
                                                    <option value="">40</option>
                                                    <option value="">50</option>
                                                    <option value="">60</option>
                                                </select>
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

<?php get_footer(); ?>