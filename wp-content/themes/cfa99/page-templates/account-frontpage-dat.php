<?php
/*
	Template Name: Quản lý tài khoản

*/
get_header(); 
?>

<section class="section p-0 account-frontpage snt">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content">
                <div class="snt-auto">
                    <div class="col-inner">

                        <div class="snt-account-header d-flex align-item-center">
                            <div class="avatar rounded-circle">
                                <img src="<?php echo get_avatar_url( $current_user->ID ); ?>">
                            </div>
                            <div class="user-title">
                                <div class="user-name">Tài khoản <?php echo $current_user->display_name; ?></div>
                                <div class="user-group d-flex align-item-center">
                                    <span>Gói tài khoản </span>
                                    <span class="snt-usergroup">Premium+</span>
                                </div>
                            </div>
                        </div>

                        <div onclick="sntDarkmode()" class="snt-darkmode-btn">
                            <svg id="Layer_4" height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg" data-name="Layer 4"><path d="m30.706 19.721a1 1 0 0 0 -1.042-.234 13.423 13.423 0 0 1 -17.151-17.152 1 1 0 0 0 -1.276-1.278 15.214 15.214 0 0 0 -5.727 3.623 15.422 15.422 0 0 0 21.81 21.81 15.214 15.214 0 0 0 3.623-5.728 1 1 0 0 0 -.237-1.041z"/></svg>
                        </div>

                        <div class="tabbed-content snt-account-tab px-20"><!-- Account Tab Start -->
                            <ul class="nav nav-simple nav-normal nav-size-large nav-left"> <!-- Tab Menus -->
                                <li class="tab has-icon active"><a href="#tab1"><span>Cổ phiếu đang theo dõi</span> <sup class="number">20</sup></a>
                                </li>
                                <li class="tab has-icon"><a href="https://google.com"><span>Thông tin membership</span></a>
                                </li>
                                <li class="tab has-icon"><a href="#tab3"><span>Lịch sử video đã xem</span></a>
                                </li>
                                <li class="tab has-icon"><a href="#tab4"><span>Trung tâm hỗ trợ</span></a>
                                </li>
                                <li class="tab has-icon"><a href="#tab5"><span>Tùy chỉnh hồ sơ</span></a>
                                </li>
                                <li class="tab has-icon"><a href="#tab6"><span>Thanh toán</span></a>
                                </li>
                            </ul>
                            <div class="tab-panels snt"> <!-- Tab Panels -->
                                <div class="panel entry-content active" id="tab1">
                                    <div class="tab_inner"> <!--#tab1-->
                                        <table id="uptrend_stocks" class="dataTable"> <!-- Stock Uptrend Follow -->
                                            <thead>
                                                <tr>
                                                    <th rowspan="1" colspan="1">
                                                        <img src="https://cfa99.net/wp-content/themes/cfa99/assets/img/sort.svg">
                                                        <img src="https://cfa99.net/wp-content/themes/cfa99/assets/img/up.svg">
                                                    </th>
                                                    <th rowspan="1" colspan="1">Mã cổ phiếu</th>
                                                    <th rowspan="1" colspan="1">Tên doanh nghiệp</th>
                                                    <th rowspan="1" colspan="1">Giá hỗ trợ mạnh</th>
                                                    <th rowspan="1" colspan="1">Giá kháng cự mạnh</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                                
                                                <tr>
                                                    <td class="stt">
                                                        <i class="icon-star-o"></i>
                                                        2
                                                    </td>
                                                    <td>
                                                        <span class="avata">
                                                            <img width="90" height="47" src="https://cfa99.net/medias/2022/07/vinhomes_logo.svg" class="attachment-full size-full wp-post-image" alt="" loading="lazy">
                                                        </span>
                                                        <span class="code_stocks">VHM</span>
                                                    </td>						
                                                    <td class="title_stocks">
                                                        CÔNG TY CỔ PHẦN VINHOMES
                                                    </td>
                                                    <td>
                                                        61400
                                                        <span class="char_money">vnd</span>
                                                    </td>
                                                    <td>
                                                        61400
                                                        <span class="char_money">vnd</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="stt">
                                                        <i class="icon-star-o"></i>
                                                        3
                                                    </td>
                                                    <td>
                                                        <span class="avata">
                                                            <img width="90" height="47" src="https://cfa99.net/medias/2022/07/vinhomes_logo.svg" class="attachment-full size-full wp-post-image" alt="" loading="lazy">
                                                        </span>
                                                        <span class="code_stocks">VHM</span>
                                                    </td>						
                                                    <td class="title_stocks">
                                                        CÔNG TY CỔ PHẦN VINHOMES
                                                    </td>
                                                    <td>
                                                        61400
                                                        <span class="char_money">vnd</span>
                                                    </td>
                                                    <td>
                                                        61400
                                                        <span class="char_money">vnd</span>
                                                    </td>
                                                </tr>
                                                                
                                            </tbody>
                                        </table>

                                        <div class="snt-pagination-wrapper"> <!-- Pagination -->
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
                                <div class="panel entry-content" id="tab2">
                                    <div class="tab_inner"> <!--#tab2-->
                                        <div class="tab-membership-wrapper">
                                            <div>
                                                <div class="membership-status">Bạn hiện đang sử dụng gói tài khoản
                                                    <span class="snt-usergroup membership-package">Premium+</span>
                                                </div>
                                                <div class="membership-exp">Hiệu lực đến hết
                                                    <span class="">30/06/2022</span>
                                                </div>
                                                <div class="membership-readmore"><a href="#">Tìm hiểu thêm</a></div>
                                            </div>
                                            <div class="membership-action">
                                                <button class="btn">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7.49996 10.0003L9.16663 11.667L12.9166 7.91699M14.9176 4.16575C15.0892 4.58077 15.4186 4.91066 15.8333 5.08289L17.2877 5.68531C17.7027 5.85723 18.0324 6.18699 18.2044 6.60204C18.3763 7.0171 18.3763 7.48345 18.2044 7.8985L17.6024 9.35183C17.4304 9.76707 17.4302 10.2339 17.6029 10.6489L18.2039 12.1018C18.2891 12.3074 18.333 12.5277 18.333 12.7503C18.333 12.9728 18.2892 13.1932 18.2041 13.3988C18.1189 13.6044 17.9941 13.7912 17.8367 13.9485C17.6793 14.1059 17.4925 14.2306 17.2869 14.3157L15.8336 14.9177C15.4186 15.0893 15.0887 15.4187 14.9165 15.8335L14.3141 17.2878C14.1422 17.7029 13.8124 18.0327 13.3974 18.2046C12.9823 18.3765 12.516 18.3765 12.101 18.2046L10.6477 17.6026C10.2326 17.4311 9.76648 17.4314 9.35169 17.6036L7.89737 18.2051C7.48256 18.3766 7.01664 18.3765 6.60193 18.2047C6.18723 18.0329 5.85767 17.7036 5.68564 17.289L5.08306 15.8342C4.91146 15.4191 4.58208 15.0892 4.16733 14.917L2.71301 14.3146C2.29815 14.1427 1.96851 13.8132 1.79653 13.3984C1.62455 12.9836 1.62432 12.5174 1.79588 12.1024L2.39785 10.6491C2.56934 10.2341 2.56899 9.76787 2.39687 9.35306L1.79577 7.89765C1.71055 7.69208 1.66666 7.47172 1.66663 7.24919C1.66659 7.02665 1.7104 6.80628 1.79556 6.60069C1.88072 6.39509 2.00555 6.20829 2.16293 6.05095C2.32031 5.89362 2.50715 5.76884 2.71276 5.68375L4.16604 5.08176C4.58069 4.9103 4.91036 4.58133 5.08271 4.16704L5.68511 2.71267C5.85703 2.29761 6.18677 1.96785 6.60181 1.79593C7.01685 1.62401 7.48318 1.62401 7.89822 1.79593L9.3515 2.39792C9.76655 2.56942 10.2327 2.56907 10.6475 2.39695L12.1024 1.79687C12.5174 1.62504 12.9837 1.62508 13.3986 1.79696C13.8136 1.96885 14.1433 2.29852 14.3152 2.71346L14.9178 4.16827L14.9176 4.16575Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    Thay đổi gói
                                                </button>
                                                <button class="btn">
                                                    Hủy gói
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel entry-content" id="tab3">
                                    <div class="tab_inner"> <!--#tab3-->
                                        Content---3
                                        <div class="snt-pagination-wrapper"> <!-- Pagination -->
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
                                                <div>Hiển thị</div>
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
                                <div class="panel entry-content" id="tab4">
                                    <div class="tab_inner"> <!--#tab4-->
                                        <?php
                                        $my_postid = 431;//This is page id or post id
                                        $content_post = get_post($my_postid);
                                        $content = $content_post->post_content;
                                        $content = apply_filters('the_content', $content);
                                        $content = str_replace(']]>', ']]&gt;', $content);
                                        echo $content;
                                        ?>
                                    </div>
                                </div>
                                <div class="panel entry-content" id="tab5">
                                    <div class="tab_inner"> <!--#tab5-->
                                        <div id="message"></div>
                                        <form action="" name="form_edit-profile" id="form_edit-profile" class="snt-form">
                                            <div class="row row-small tab-custom-profile">
                                                <div class="col medium-12 small-12 large-6 desc">
                                                    <div class="col-inner">
                                                        <strong>Cập nhật thông tin công khai</strong><br/>
                                                        Những thông tin này sẽ được hiển thị công khai và hiển thị cho tất cả người dùng.
                                                    </div>
                                                </div>
                                                <div class="col medium-12 small-12 large-6">
                                                    <div class="col-inner">
                                                        <label class="form-label" for="phone_profile">Số điện thoại</label>
                                                        <input type="tel" id="phone_profile" name="phone_profile" class="form-control" placeholder="Số điện thoại">
                                                        <label class="form-label" for="phone_profile">Họ và tên</label>
                                                        <input type="text" id="fullname_profile" name="fullname_profile" class="form-control" placeholder="Họ và tên">
                                                    </div>
                                                </div>
                                                <div class="col medium-12 small-12 large-6 desc">
                                                    <div class="col-inner">
                                                        <strong>Thay đổi mật khẩu</strong><br/>
                                                        Quản lý mật khẩu của bạn để đảm bảo mật khẩu của bạn được an toàn
                                                    </div>
                                                </div>
                                                <div class="col medium-12 small-12 large-6">
                                                    <div class="col-inner">
                                                        <label class="form-label" for="oldpw">Mật khẩu cũ</label>
                                                        <div class="position-relative">
                                                            <input type="password" id="oldpw_profile" name="phone_profile" class="form-control input__password" placeholder="Mật khẩu cũ của bạn">
                                                            <button class="snt-toggle-password eye-disable" type="button">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="#7C8493"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <label class="form-label" for="newpw_profile">Mật khẩu mới</label>
                                                        <div class="position-relative">
                                                            <input type="password" id="newpw_profile" name="fullname_profile" class="form-control input__password" placeholder="Mật khẩu mới của bạn">
                                                            <button class="snt-toggle-password eye-disable" type="button">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="#7C8493"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col medium-12 small-12 large-6">
                                                    <div class="col-inner">
                                                    </div>
                                                </div>
                                                <div class="col medium-12 small-12 large-6">
                                                    <div class="col-inner">
                                                    <button type="button" form="form_edit-profile" id="save-info-user" value="Submit" class="edit_profile_submit check_validation">Lưu thay đổi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="panel entry-content" id="tab6">
                                    <div class="tab_inner"> <!--#tab6-->
                                        <?php
                                        $my_postid = 592;//This is page id or post id
                                        $content_post = get_post($my_postid);
                                        $content = $content_post->post_content;
                                        $content = apply_filters('the_content', $content);
                                        $content = str_replace(']]>', ']]&gt;', $content);
                                        echo $content;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Account Tab End -->                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
echo wp_hash_password(wp_hash_password('12345678'));
?>
<?php get_footer(); ?>