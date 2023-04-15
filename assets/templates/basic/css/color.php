<?php
header("Content-Type:text/css");
$color1 = $_GET['color1']; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color1']) AND $_GET['color1'] != '') {
    $color1 = "#" . $_GET['color1'];
}

if (!$color1 OR !checkhexcolor($color1)) {
    $color1 = "#336699";
}  $secondColor = "#336699";

?>

a:hover, .custom--dropdown .dropdown-menu li .dropdown-item:hover, .page-breadcrumb li:first-child::before, .page-breadcrumb li a:hover, .cmn-list li::before, .btn-outline--base, .badge--base, .custom--checkbox input:checked ~ label::before, .header .main-menu li.menu_has_children:hover > a::before, .header .main-menu li a:hover, .header .main-menu li a:focus, .header .main-menu li .sub-menu li a:hover, .product-card__footer .left .category:hover, .post-meta__tags a:hover, .testimonial-card__content::before, .reply-btn, .contact-info-card__content a:hover, .account-header .content .account-info-list li i, .account-menu li a:hover, .sidebar .widget .search-form .search-btn, .sidebar .archive__list li a:hover, .footer-info-item .footer-info-number, .footer-menu-list li a:hover, .footer-social-list li a:hover {
    color: <?= $color1 ?>;
}

a.text-white:hover {
    color: <?= $color1 ?> !important;
}

.text--base {
    color: <?= $color1 ?> !important;
}

.preloader .preloader-container .animated-preloader, .preloader .preloader-container .animated-preloader:before {
    background: <?= $color1 ?>;
}

.section-subtitle.border-left::before, .custom--accordion .accordion-button:not(.collapsed), .custom--nav-tabs .nav-item .nav-link.active, .pagination .page-item.active .page-link, .pagination .page-item .page-link:hover, .video--btn, .scroll-to-top, .btn--base, .btn--base:hover, .btn-outline--base:hover, .icon-btn, .custom-radio label::after, .select2-container--default .select2-results__option--highlighted[aria-selected], .header__top, .header .main-menu li .sub-menu li a::before, .header-search-form::after, .header-search-form__btn, .side-ad .ad-header, .testimonial-slider .slick-dots li.slick-active button, .blog-details__thumb .post__date .date, .blog-details__footer .social__links li a:hover, .reply-btn:hover, .search-form .search-btn, .contact-info-card__icon, .custom--file-upload::before, .subscribe-form .subscribe-form-btn, .sidebar .widget .widget__title::after, .sidebar .tags a:hover, .action-sidebar .cmn-accordion2 .card-header .acc-btn, .footer-widget__title::after, .footer-social-list li a i, .download-links li::before, .modal-header .btn-close {
    background-color: <?= $color1 ?>;
}

.bg--base {
    background-color: <?= $color1 ?> !important;
}

.custom--nav-tabs .nav-item .nav-link.active, .pagination .page-item .page-link:hover, .custom-radio input[type=radio]:checked ~ label::before, .sidebar .tags a:hover {
    border-color: <?= $color1 ?>;
}

.form--control:focus {
    border-color: <?= $color1 ?> !important;
}

.btn-outline--base, .badge--base, .form--control {
    border: 1px solid <?= $color1 ?>;
}

.product-details-list-wrapper {
    border: 2px solid <?= $color1 ?>
}

.product-details-list-wrapper {
    box-shadow: 0 0 10px 1px  <?= $color1 ?>
}