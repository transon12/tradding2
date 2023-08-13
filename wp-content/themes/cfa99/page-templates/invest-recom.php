<?php
/*
	Template Name: Khuyến nghị đầu tư

*/
get_header(); 
?>

<section class="section p-0 exp__stock">
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
                        <div class="px bg-fff">
                            <h1 class="entry-title">Khuyến nghị đầu tư</h1>
                            <div id="filter-table">
                                <div class="filter-left">
                                <div class="filter-care">
                                    <div class="save-car">
                                        <i class="icon-star-o"></i>
                                    </div>
                                    <div class="text">&ensp;Quan tâm</div>
                                </div>
                                <div class="filter-all">
                                    <form class="stocks-ordering mb-0" method="get">
                                        <select name="stocks-ordering-length" class="mb-0">
                                            <option value="all">Tất cả cổ phiếu</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </form>
                                </div>
                                </div>
                                <div class="filter-right">
                                <div class="filter-length stocks-ordering">
                                    <div class="text">Hiển thị&ensp;</div>
                                    <select name="stocks_length" class="mb-0">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <table id="uptrend_stocks" class="dataTable">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">
                                        <img
                                            src="https://cfa99.a2ztech.vn/wp-content/themes/cfa99/assets/img/sort.svg"
                                        />
                                        <img
                                            src="https://cfa99.a2ztech.vn/wp-content/themes/cfa99/assets/img/up.svg"
                                        />
                                        </th>
                                        <th rowspan="1" colspan="1">Mã cổ phiếu</th>
                                        <th rowspan="1" colspan="1">Giá mua</th>
                                        <th rowspan="1" colspan="1">Giá chốt lời</th>
                                        <th rowspan="1" colspan="1">Giá cắt lỗ</th>
                                        <th rowspan="1" colspan="1">Lý do mua mua</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="stt">
                                            <i class="icon-star-o"></i>1                                                    
                                        </td>
                                        <td>
                                            <span class="avata"
                                                ><img
                                                width="90"
                                                height="47"
                                                src="https://cfa99.a2ztech.vn/medias/2022/07/vinhomes_logo.svg"
                                                class="attachment-full size-full wp-post-image"
                                                alt="" />
                                            </span>
                                            <span class="code_stocks">VHM</span>
                                        </td>
                                        <td>
                                            <span class="gia-mua">61402</span>
                                            <span class="char_money">vnd</span></td>
                                        <td>
                                            <span class="gia-chot-loi">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        <td>
                                            <span class="gia-chot-lo">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        
                                        <td class="title_stocks">Khi Nga phát động cuộc chiến quân sự tại Ukraine vào ngày 24/02/2022, đây là mộtdđ</td>
                                    </tr>
                                    <tr>
                                        <td class="stt">
                                            <i class="icon-star-o"></i>2                                                    
                                        </td>
                                        <td>
                                            <span class="avata"
                                                ><img
                                                width="90"
                                                height="47"
                                                src="https://cfa99.a2ztech.vn/medias/2022/07/vinhomes_logo.svg"
                                                class="attachment-full size-full wp-post-image"
                                                alt="" />
                                            </span>
                                            <span class="code_stocks">VHM</span>
                                        </td>
                                        <td>
                                            <span class="gia-mua">61402</span>
                                            <span class="char_money">vnd</span></td>
                                        <td>
                                            <span class="gia-chot-loi">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        <td>
                                            <span class="gia-chot-lo">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        
                                        <td class="title_stocks">Khi Nga phát động cuộc chiến quân sự tại Ukraine vào ngày 24/02/2022, đây là mộtdđ</td>
                                    </tr>
                                    <tr>
                                        <td class="stt">
                                            <i class="icon-star-o"></i>3                                                    
                                        </td>
                                        <td>
                                            <span class="avata"
                                                ><img
                                                width="90"
                                                height="47"
                                                src="https://cfa99.a2ztech.vn/medias/2022/07/vinhomes_logo.svg"
                                                class="attachment-full size-full wp-post-image"
                                                alt="" />
                                            </span>
                                            <span class="code_stocks">VHM</span>
                                        </td>
                                        <td>
                                            <span class="gia-mua">61402</span>
                                            <span class="char_money">vnd</span></td>
                                        <td>
                                            <span class="gia-chot-loi">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        <td>
                                            <span class="gia-chot-lo">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        
                                        <td class="title_stocks">Khi Nga phát động cuộc chiến quân sự tại Ukraine vào ngày 24/02/2022, đây là mộtdđ</td>
                                    </tr>
                                    <tr>
                                        <td class="stt">
                                            <i class="icon-star-o"></i>4                                                    
                                        </td>
                                        <td>
                                            <span class="avata"
                                                ><img
                                                width="90"
                                                height="47"
                                                src="https://cfa99.a2ztech.vn/medias/2022/07/vinhomes_logo.svg"
                                                class="attachment-full size-full wp-post-image"
                                                alt="" />
                                            </span>
                                            <span class="code_stocks">VHM</span>
                                        </td>
                                        <td>
                                            <span class="gia-mua">61402</span>
                                            <span class="char_money">vnd</span></td>
                                        <td>
                                            <span class="gia-chot-loi">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        <td>
                                            <span class="gia-chot-lo">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        
                                        <td class="title_stocks">Khi Nga phát động cuộc chiến quân sự tại Ukraine vào ngày 24/02/2022, đây là mộtdđ</td>
                                    </tr>
                                    <tr>
                                        <td class="stt">
                                            <i class="icon-star-o"></i>5                                                    
                                        </td>
                                        <td>
                                            <span class="avata"
                                                ><img
                                                width="90"
                                                height="47"
                                                src="https://cfa99.a2ztech.vn/medias/2022/07/vinhomes_logo.svg"
                                                class="attachment-full size-full wp-post-image"
                                                alt="" />
                                            </span>
                                            <span class="code_stocks">VHM</span>
                                        </td>
                                        <td>
                                            <span class="gia-mua">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        <td>
                                            <span class="gia-chot-loi">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        <td>
                                            <span class="gia-chot-lo">61402</span>
                                            <span class="char_money">vnd</span>
                                        </td>
                                        
                                        <td class="title_stocks">Khi Nga phát động cuộc chiến quân sự tại Ukraine vào ngày 24/02/2022, đây là mộtdđ</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="snt-pagination-wrapper">
                                <div class="snt-pagi-info">Hiển thị 1 - 20 trên 180</div>
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
</section>

<?php get_footer(); ?>