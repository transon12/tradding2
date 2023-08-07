<section class="section p-0 blog-archive">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            test
            <div class="col medium-8 small-12 large-6 snt-main-content">
                <div class="snt-auto">
                    <div class="col-inner">
                        <div class="px bg-fff">
                            <h1><?php the_title(); ?></h1>
                            <div class="content-chart">
                                <?php the_content(); ?>
                            </div>

                            <?php if(get_field('code_chart_trading_view',get_the_ID()) != ''): ?>

                            <div class="technical-chart-wrap">
                                <!-- TradingView Widget BEGIN -->
                                <div class="tradingview-widget-container">
                                    <div id="tradingview_290ee"></div>
                                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                    <script type="text/javascript">
                                    new TradingView.widget(
                                    {
                                    "autosize": true,
                                    "symbol": "<?php echo get_field('code_chart_trading_view',get_the_ID()); ?>",
                                    "interval": "D",
                                    "timezone": "Etc/UTC",
                                    "theme": "light",
                                    "style": "1",
                                    "locale": "vi_VN",
                                    "toolbar_bg": "#f1f3f6",
                                    "enable_publishing": false,
                                    "hide_legend": true,
                                    "withdateranges": true,
                                    "hide_side_toolbar": false,
                                    "save_image": false,
                                    "allow_symbol_change": true,
                                    "container_id": "tradingview_290ee"
                                    }
                                    );
                                    </script>
                                </div>
                                <!-- TradingView Widget END -->
                            </div>

                            <?php endif; ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
