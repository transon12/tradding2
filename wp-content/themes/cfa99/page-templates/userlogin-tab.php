
<?php
/*
	Template Name: Tabber - UserLogin

*/
?>
<?php get_header(); ?>

<div class="tabber-userlogin">
  <div class="tabbed-content bg-fff px-20"><!-- Account Tab Start -->
    <ul class="nav nav-simple nav-normal nav-size-large nav-left"> <!-- Tab Menus -->
  
        <li class="tab has-icon active"><a href="step1"><span>Bước 1/4</span></a>
        </li>
        <li class="tab has-icon"><a href="#step2"><span>Bước 2/4</span></a>
        </li>
        <li class="tab has-icon"><a href="#step3"><span>Bước 3/4</span></a>
        </li>
        <li class="tab has-icon"><a href="#step4"><span>Bước 4/4</span></a>
        </li>
  
    </ul>
    <div class="tab-panels snt"> <!-- Tab Panels -->
        <div class="panel entry-content active" id="step1">
            <div class="tab_inner"> <!--#step1-->
                Content--- 1/4
            </div>
        </div>
        <div class="panel entry-content" id="step2">
            <div class="tab_inner"> <!--#step2-->
                Content--- 2/4
            </div>
        </div>
        <div class="panel entry-content" id="step3">
            <div class="tab_inner"> <!--#step3-->
                Content--- 3/4
            </div>
        </div>
        <div class="panel entry-content" id="step4">
            <div class="tab_inner"> <!--#step4-->
                Content--- 4/4
            </div>
        </div>
    </div>
  </div><!-- Account Tab End -->
</div>

<?php get_footer(); ?>