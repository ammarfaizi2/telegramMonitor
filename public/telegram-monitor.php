<?php
require __DIR__."/../config/init.php";
require __DIR__."/../vendor/autoload.php";

$tg = new TelegramMonitoringUI;

?><!DOCTYPE html> 
<!-- 
Halamn index by Gusti
-->
<html lang="en">
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8"/>
        <title>Telegram Monitoring</title>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/wordcloud.js"></script>
        <meta name="description" content="Latest updates and statistic charts">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
        <!--end::Web font -->         
        <!--begin::Base Styles -->         
        <!--end::Page Vendors -->
        <link href="assets/css/gabung.bundle.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link href="assets/css/dashboard/dash.style.bundle.css" rel="stylesheet" type="text/css"/>
        <!--end::Base Styles -->
    </head>
    <!-- end::Head -->
    <!-- end::Body -->
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Header -->
            <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
                <div class="m-container m-container--fluid m-container--full-height">
                    <div class="m-stack m-stack--ver m-stack--desktop">
                        <!-- BEGIN: Brand -->
                        <div class="m-stack__item m-brand  m-brand--skin-light ">
                            <div class="m-stack m-stack--ver m-stack--general">
                                <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                    <a href="index.html" class="m-brand__logo-wrapper">
                                        <img alt="" src="assets/img/Logo.png"/>
                                    </a>
                                    <h3 class="m-header__title">
										Apps </h3>
                                </div>
                                <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                    <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                    <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block"> <span></span> </a>
                                    <!-- END -->                                     
                                    <!-- BEGIN: Responsive Header Menu Toggler -->
                                    <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block"> <span></span> </a>
                                    <!-- END -->                                     
                                    <!-- BEGIN: Topbar Toggler -->
                                    <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block"> <i class="flaticon-more"></i> </a>
                                    <!-- BEGIN: Topbar Toggler -->
                                </div>
                            </div>
                        </div>
                        <!-- END: Brand -->
                        <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                            <div class="m-header__title">
                                <h3 class="m-header__title-text">
									Webapp Name </h3>
                            </div>
                            <!-- BEGIN: Horizontal Menu -->
                            <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
                                <i class="la la-close"></i>
                            </button>
                            <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                                <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                    <li class="m-menu__item  m-menu__item--active  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"> 
                                        <a href="javascript:;" class="m-menu__link m-menu__toggle"> <span class="m-menu__item-here"></span> <span class="m-menu__link-text">
												Quick Actions </span> <i class="m-menu__hor-arrow fa fa-chevron-down"></i> <i class="m-menu__ver-arrow la la-angle-right"></i> </a> 
                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                            <ul class="m-menu__subnav">
                                                <li class="m-menu__item  m-menu__item--active " aria-haspopup="true">
                                                    <a href="index.html" class="m-menu__link "> <i class="m-menu__link-icon flaticon-diagram"></i> <span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Create Email</span> <span class="m-menu__link-badge"> <span class="m-badge m-badge--success">
																		2 </span> </span> </span> </span> </a>
                                                </li>
                                                <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="javascript:;" class="m-menu__link m-menu__toggle"> <i class="m-menu__link-icon flaticon-business"></i> <span class="m-menu__link-text">Create Cases</span> </a>
                                                </li>
                                                <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="javascript:;" class="m-menu__link m-menu__toggle"> <i class="m-menu__link-icon flaticon-chat-1"></i> <span class="m-menu__link-text">Lorem Ipsum</span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                                                </li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="inner.html" class="m-menu__link "> <i class="m-menu__link-icon flaticon-users"></i> <span class="m-menu__link-text">Lorem Ipsum Dolor</span> </a>
                                                </li>
                                            </ul>
                                        </div>                                         
                                    </li>
                                </ul>
                            </div>
                            <!-- END: Horizontal Menu -->                             
                            <!-- BEGIN: Topbar -->
                            <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                                <div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-light" id="m_quicksearch" m-quicksearch-mode="default">
                                    <!--BEGIN: Search Form -->
                                    <form class="m-header-search__form">
                                        <div class="m-header-search__wrapper">
                                            <span class="m-header-search__icon-search" id="m_quicksearch_search"> <i class="flaticon-search"></i> </span>
                                            <span class="m-header-search__input-wrapper"> <input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Search..." id="m_quicksearch_input"> </span>
                                            <span class="m-header-search__icon-close" id="m_quicksearch_close"> <i class="la la-remove"></i> </span>
                                            <span class="m-header-search__icon-cancel" id="m_quicksearch_cancel"> <i class="la la-remove"></i> </span>
                                        </div>
                                    </form>
                                    <!--END: Search Form -->                                     
                                    <!--BEGIN: Search Results -->
                                    <div class="m-dropdown__wrapper">
                                        <div class="m-dropdown__arrow m-dropdown__arrow--center"></div>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
                                                    <div class="m-dropdown__content m-list-search m-list-search--skin-light"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--BEGIN: END Results -->
                                </div>
                                <div class="m-stack__item m-topbar__nav-wrapper">
                                    <ul class="m-topbar__nav m-nav m-nav--inline">
                                        <li class="m-nav__item m-topbar__notifications m-dropdown--large 	m-dropdown--mobile-full-width m-dropdown__arrow--right m-dropdown--arrow m-dropdown--align-right m-dropdown" m-dropdown-toggle="click" m-dropdown-persistent="1">
                                            <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon"> <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span> <span class="m-nav__link-icon"> <span class="m-nav__link-icon-wrapper"> <i class="flaticon-music-2"></i> </span> </span> </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center">
                                                        <span class="m-dropdown__header-title">
															9 New </span>
                                                        <span class="m-dropdown__header-subtitle">
															User Notifications </span>
                                                    </div>
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
                                                                <div class="m-list-timeline m-list-timeline--skin-light">
                                                                    <div class="m-list-timeline__items">
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                            <span class="m-list-timeline__text">
																						12 new users registered </span>
                                                                            <span class="m-list-timeline__time">
																						Just now </span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">
																						System shutdown <span class="m-badge m-badge--success m-badge--wide">
																							pending </span> </span>
                                                                            <span class="m-list-timeline__time">
																						14 mins </span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">
																						New invoice received </span>
                                                                            <span class="m-list-timeline__time">
																						20 mins </span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">
																						DB overloaded 80% <span class="m-badge m-badge--info m-badge--wide">
																							settled </span> </span>
                                                                            <span class="m-list-timeline__time">
																						1 hr </span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">
																						System error - <a href="#" class="m-link">
																							Check </a> </span>
                                                                            <span class="m-list-timeline__time">
																						2 hrs </span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item m-list-timeline__item--read">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span href="" class="m-list-timeline__text">
																						New order received <span class="m-badge m-badge--danger m-badge--wide">
																							urgent </span> </span>
                                                                            <span class="m-list-timeline__time">
																						7 hrs </span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item m-list-timeline__item--read">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">
																						Production server down </span>
                                                                            <span class="m-list-timeline__time">
																						3 hrs </span>
                                                                        </div>
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge"></span>
                                                                            <span class="m-list-timeline__text">
																						Production server up </span>
                                                                            <span class="m-list-timeline__time">
																						5 hrs </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="m-nav__item m-topbar__quick-actions m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--align-push m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--arrow m-menu__item" m-dropdown-toggle="click">
                                            <a href="#" class="m-nav__link m-dropdown__toggle"> <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span> <span class="m-nav__link-icon"> <span class="m-nav__link-icon-wrapper"> <i class="flaticon-share"></i> </span> </span> </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center">
                                                        <span class="m-dropdown__header-title">
															Quick Actions </span>
                                                        <span class="m-dropdown__header-subtitle">
															Shortcuts </span>
                                                    </div>
                                                    <div class="m-dropdown__body m-dropdown__body--paddingless">
                                                        <div class="m-dropdown__content">
                                                            <div class="m-scrollable" data-scrollable="false" data-max-height="380" data-mobile-max-height="200">
                                                                <div class="m-nav-grid m-nav-grid--skin-light">
                                                                    <div class="m-nav-grid__row">
                                                                        <a href="#" class="m-nav-grid__item"> <i class="m-nav-grid__icon flaticon-file"></i> <span class="m-nav-grid__text">
																				Generate Report </span> </a>
                                                                        <a href="#" class="m-nav-grid__item"> <i class="m-nav-grid__icon flaticon-time"></i> <span class="m-nav-grid__text">
																				Add New Event </span> </a>
                                                                    </div>
                                                                    <div class="m-nav-grid__row">
                                                                        <a href="#" class="m-nav-grid__item"> <i class="m-nav-grid__icon flaticon-folder"></i> <span class="m-nav-grid__text">
																				Create New Task </span> </a>
                                                                        <a href="#" class="m-nav-grid__item"> <i class="m-nav-grid__icon flaticon-clipboard"></i> <span class="m-nav-grid__text">
																				Completed Tasks </span> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                            <a href="#" class="m-nav__link m-dropdown__toggle"> <span class="m-topbar__userpic m--hide"> <img src="assets/img/foto/100_1.jpg" class="m--img-rounded m--marginless m--img-centered" alt=""/> </span> <span class="m-nav__link-icon m-topbar__usericon"> <span class="m-nav__link-icon-wrapper"> <i class="flaticon-user-ok"></i> </span> </span> <span class="m-topbar__username m--hide">
													Nick </span> </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center">
                                                        <div class="m-card-user m-card-user--skin-light">
                                                            <div class="m-card-user__pic">
                                                                <img src="assets/img/foto/profile-pic.png" class="m--img-rounded m--marginless" alt=""/>
                                                            </div>
                                                            <div class="m-card-user__details">
                                                                <span class="m-card-user__name m--font-weight-500">
																	Dinda Zahra </span>
                                                                <a href="" class="m-card-user__email m--font-weight-300 m-link">
																	dinda.zahra@gmail.com </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav m-nav--skin-light">
                                                                <li class="m-nav__section m--hide">
                                                                    <span class="m-nav__section-text">
																		Section </span>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link"> <i class="m-nav__link-icon flaticon-profile-1"></i> <span class="m-nav__link-title"> <span class="m-nav__link-wrap"> <span class="m-nav__link-text">
																					My Profile </span> <span class="m-nav__link-badge"> <span class="m-badge m-badge--success">
																						2 </span> </span> </span> </span> </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link"> <i class="m-nav__link-icon flaticon-share"></i> <span class="m-nav__link-text">
																			Activity </span> </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link"> <i class="m-nav__link-icon flaticon-chat-1"></i> <span class="m-nav__link-text">
																			Messages </span> </a>
                                                                </li>
                                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link"> <i class="m-nav__link-icon flaticon-info"></i> <span class="m-nav__link-text">
																			FAQ </span> </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link"> <i class="m-nav__link-icon flaticon-lifebuoy"></i> <span class="m-nav__link-text">
																			Support </span> </a>
                                                                </li>
                                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                <li class="m-nav__item">
                                                                    <a href="snippets/pages/user/login-1.html" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
																		Logout </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END: Topbar -->
                        </div>
                    </div>
                </div>
            </header>
            <!-- END: Header -->             
            <!-- begin::Body -->
            <!-- end:: Body -->             
            <!-- begin::Footer -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <!-- BEGIN: Left Aside -->
                <button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
                    <i class="la la-close"></i>
                </button>
                <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
                    <!-- BEGIN: Aside Menu -->                     
                    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " data-menu-vertical="true" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
                        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                            <li class="m-menu__item  m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Dashboard">
                                <a href="index.html" class="m-menu__link"> <i class="m-menu__link-icon flaticon-dashboard"></i> <span class="m-menu__link-text">
										Dashboard </span> </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Cases">
                                <a href="cases.html" class="m-menu__link"> <i class="m-menu__link-icon flaticon-suitcase"></i> <span class="m-menu__link-text">
										Cases </span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Mailbox">
                                <a href="inbox.html" class="m-menu__link"> <i class="m-menu__link-icon flaticon-mail"></i> <span class="m-menu__link-text">
										Inbox </span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Data Person">
                                <a href="person-data.html" class="m-menu__link"> <i class="m-menu__link-icon flaticon-users"></i> <span class="m-menu__link-text">
										Data Person </span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="CCTV">
                                <a href="pencarian-data.html" class="m-menu__link m--margin-top-5 m--margin-bottom-10"> <i class="m-menu__link-icon m--padding-top-10 flaticon-search"></i> <span class="m-menu__link-text">
										Pencarian</span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="News & Media">
                                <a href="news.html" class="m-menu__link"> <i class="m-menu__link-icon flaticon-file"></i> <span class="m-menu__link-text">
										Data Person </span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Social Media">
                                <a href="social-media.html" class="m-menu__link"> <i class="m-menu__link-icon flaticon-network"></i> <span class="m-menu__link-text">
										Data Person </span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="User">
                                <a href="user.html" class="m-menu__link"> <i class="m-menu__link-icon flaticon-user-add"></i> <span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">
												Users </span> </span> </span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                            </li>
                            <li class="m-menu__section ">
                                <h4 class="m-menu__section-text">
									Reports </h4>
                                <i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Pencarian Data Orang">
                                <a href="trace-person.html" class="m-menu__link"> <i class="m-menu__link-icon flaticon-user-ok"></i> <span class="m-menu__link-text">
										Data Person </span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                                <a href="javascript:;" class="m-menu__link m-menu__toggle"> <i class="m-menu__link-icon flaticon-cogwheel-1"></i> <span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">
												Support </span> <span class="m-menu__link-badge"> <span class="m-badge m-badge--danger">
													23 </span> </span> </span> </span> <i class="m-menu__ver-arrow la la-angle-right"></i> </a>
                                <div class="m-menu__submenu ">
                                    <span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" m-menu-link-redirect="1">
                                            <span class="m-menu__link"> <span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Tools</span> </span> </span> </span>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                                            <a href="online-call.html" class="m-menu__link "> <i class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span> </i> <span class="m-menu__link-text">Online Call</span> </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                                            <a href="web-akses.html" class="m-menu__link "> <i class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span> </i> <span class="m-menu__link-text">
									Online Web Access </span> </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                                            <a href="online-sms.html" class="m-menu__link "> <i class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span> </i> <span class="m-menu__link-text">
													Online SMS</span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- END: Aside Menu -->
                </div>
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <div class="m-subheader-search">
                        <h2 class="m-subheader-search__title">Telegram Monitoring</h2>
                    </div>
                    <div>
                        <div>
                            <h3>Account Status</h3>
                            <table border="1" style="border-collapse: collapse;">
                                <tr><td align="center">No.</td><td align="center" style="padding-left: 10px; padding-right: 10px;">Session Name</td><td align="center" style="padding-left: 10px; padding-right: 10px;">Status</td><td align="center">Action</td></tr>
                                <?php $i = 1; foreach ($tg->getSessions() as $session): ?>
                                    <tr><td align="center"><?php print $i++; ?>.</td><td align="center"><?php print $session; ?></td><td align="center">Off</td><td>Stop | Restart</td></tr>
                                <?php endforeach ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="m-grid__item		m-footer ">
                <div class="m-container m-container--fluid m-container--full-height m-page__container">
                    <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                        <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                            <span class="m-footer__copyright">
								Copyright ©2018 &copy; <a href="#" class="m-link">
									Codedroid </a> </span>
                        </div>
                        <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                            <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                                <li class="m-nav__item">
                                    <a href="#" class="m-nav__link"> <span class="m-nav__link-text">
											About </span> </a>
                                </li>
                                <li class="m-nav__item">
                                    <a href="#" class="m-nav__link"> <span class="m-nav__link-text">
											Privacy </span> </a>
                                </li>
                                <li class="m-nav__item">
                                    <a href="#" class="m-nav__link"> <span class="m-nav__link-text">
											T&amp;C </span> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end::Footer -->
        </div>
        <div id="m_scroll_top" class="m-scroll-top">
            <i class="flaticon-up-arrow"></i>
        </div>
        <!-- end:: Page -->         
        <!-- begin::Quick Sidebar -->
        <!-- end::Quick Sidebar -->         
        <!-- begin::Scroll Top -->
        <!-- end::Scroll Top -->         
        <!-- begin::Quick Nav -->
        <!-- begin::Quick Nav -->         
        <!--begin::Base Scripts -->
        <script src="assets/js/gabung.bundle.js" type="text/javascript"></script>
        <script src="assets/js/plugin/dashboard.js" type="text/javascript"></script>
        <script src="assets/js/dashboard/dash.scripts.bundle.js" type="text/javascript"></script>
        <script src="assets/js/plugin/bootstrap-select.js" type="text/javascript"></script>         
        <!--end::Page Vendors -->         
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>