<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="utf-8" />
	<title>PojoCoursePilot</title>
	<meta name="description" content="">
	<meta name="keywords" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="theme-color" content="#4302b2">
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<link rel="icon" type="image/jpeg" href="{{ asset('img/logo (2).png') }}">
	<link rel="shortcut icon" href="{{ asset('img/logo (2).png') }}">
	<link rel="apple-touch-icon" href="{{ asset('img/logo (2).png') }}">
	<link href="{{ asset('css/swiper.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('css/plugin.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
	<link href="{{ asset('css/font-awesome/5.11.2/css/all.min.css')}}" rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;display=swap"
		rel="stylesheet">

	<link href="{{ asset('css/style.css')}}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css')}}" rel="stylesheet">
	<link href="{{ asset('css/darkmode.css')}}" rel="stylesheet">
	<link href="{{ asset('css/custom.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<style>
		@media (max-width: 991.98px) {
			body {
				overflow-x: hidden;
				padding-top: 64px;
			}

			header.main-header.navfix.fixed-top {
				position: fixed !important;
				top: 0;
				left: 0;
				right: 0;
				width: 100%;
				z-index: 9999;
				transform: none !important;
				visibility: visible !important;
				opacity: 1 !important;
				background: #fff !important;
				box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08) !important;
			}

			header.main-header.navfix.fixed-top.sticky {
				top: 0 !important;
				transform: none !important;
				visibility: visible !important;
				opacity: 1 !important;
				background: #fff !important;
			}

			.container,
			.container-fluid {
				padding-left: 12px !important;
				padding-right: 12px !important;
			}

			.menu-header {
				display: flex;
				align-items: center;
				justify-content: space-between;
				flex-wrap: nowrap;
				gap: 8px;
				min-height: 56px;
				padding: 8px 0;
			}

			.dsk-logo {
				flex: 1 1 auto;
				max-width: none;
				min-width: 0;
			}

			.dsk-logo .nav-brand {
				display: flex;
				align-items: center;
				gap: 10px;
				max-width: 100%;
				min-width: 0;
			}

			.dsk-logo .logo-text {
				font-size: 18px !important;
				line-height: 1.15 !important;
				max-width: 100%;
				margin: 0 !important;
				overflow: hidden;
			}

			.custom-nav .hidedesktop {
				flex-shrink: 0;
			}

			.custom-nav {
				display: flex;
				align-items: center;
				justify-content: flex-end;
				margin-left: auto;
				flex: 0 0 auto;
			}

			.right-end-btn {
				display: flex;
				align-items: center;
				flex-wrap: nowrap;
				gap: 8px;
				margin: 0;
				padding-left: 0;
				padding-right: 8px;
			}

			.right-end-btn .hidedesktop {
				margin: 0 !important;
			}

			.right-end-btn .btn-round- {
				width: 42px !important;
				height: 42px !important;
				min-width: 42px !important;
				border-radius: 50% !important;
				display: inline-flex !important;
				align-items: center !important;
				justify-content: center !important;
				padding: 0 !important;
				box-shadow: none !important;
				margin-right: 2px !important;
			}

			.right-end-btn .btn-round- i {
				font-size: 16px !important;
				line-height: 1;
			}

			.right-end-btn .navm.hidedesktop {
				display: list-item !important;
			}

			.pad-tb {
				padding-top: 50px !important;
				padding-bottom: 50px !important;
			}

			img {
				max-width: 100%;
				height: auto;
			}
		}

		@media (max-width: 767.98px) {
			body {
				padding-top: 64px; /* Adjusted padding for fixed header */
			}

			.custom-nav > .nav-list:not(.right-end-btn) {
				display: none !important;
			}

			.menu-header {
				min-height: 60px; /* Increased height for better spacing */
				gap: 10px; /* Adjusted gap for better alignment */
				padding: 10px 0;
			}

			.dsk-logo {
				flex: 1 1 auto;
				max-width: none;
			}

			.dsk-logo .nav-brand {
				max-width: 100%;
				min-width: 0;
			}

			.dsk-logo .logo-text {
				font-size: clamp(11px, 2.25vw, 15px) !important;
				line-height: 1.08 !important;
				max-width: 138px;
				white-space: normal !important;
				word-break: break-word;
				overflow: hidden;
			}

			.logo-text .desktop-logo-lines {
				display: none;
			}

			.logo-text .mobile-logo-lines {
				display: inline;
			}

			.container-fluid.m-pad {
				padding-left: 10px !important;
				padding-right: 10px !important;
			}

			.custom-nav {
				flex: 0 0 auto;
				min-width: fit-content;
			}

			.right-end-btn {
				gap: 8px; /* Increased gap for better spacing */
				justify-content: flex-end;
				margin-left: auto;
				padding-right: 12px;
				min-width: fit-content;
			}

			.right-end-btn .navm.hidedesktop {
				display: list-item !important;
			}

			.right-end-btn .btn-round- {
				width: 42px !important; /* Slightly larger call button */
				height: 42px !important;
				min-width: 42px !important;
				margin-right: 0;
				margin-left: 10px; /* push to right side */
			}

			.right-end-btn .toggle {
				margin-left: 10px;
			}

			.right-end-btn .btn-round- i {
				font-size: 16px !important;
			}

			.breadcrumb-area {
				padding-top: 90px !important;
			}

			.bread-title h2,
			.common-heading h2 {
				font-size: 28px !important;
				line-height: 1.3 !important;
			}

			.common-heading p,
			.bread-menu li,
			.bread-menu a {
				font-size: 14px !important;
			}

			.footer-row2 h4 {
				font-size: 24px !important;
			}

			.footer-row2 p,
			.footer-row2 a,
			.footer-row2 span,
			.footer-row2 strong {
				font-size: 14px !important;
				line-height: 1.6 !important;
			}

			.contact-page .dbox .text {
				padding-left: 12px !important;
			}

			.contact-location iframe {
				height: 300px !important;
			}
		}

		@media (min-width: 992px) {
			header.main-header.navfix.fixed-top {
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				z-index: 9999;
				background: #fff;
				box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			}

			body {
				padding-top: 0px; /* Increased padding to create a larger gap between the header and hero section */
			}
		}

   /* ADD HERE */
   /* header.main-header,
   header.main-header.navfix,
   header.main-header.navfix.fixed-top,
   header.main-header.navfix.fixed-top.sticky{
       position: fixed !important;
       top: 0 !important;
       left: 0;
       right: 0;
       width: 100%;
       z-index: 99999;
       transform: none !important;
       transition: none !important;
       animation: none !important;
       background: #fff !important;
   }

   .main-header.hide,
   .main-header.up,
   .main-header.down{
       transform: none !important;
       top: 0 !important;
   }

   body{
       padding-top:70px;
   } */

/* Desktop header stability */
.menu-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
}

.dsk-logo {
    flex: 0 1 420px;
    min-width: 0;
}

.dsk-logo .nav-brand {
    display: flex !important;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.dsk-logo .logo-text {
    font-size: clamp(16px, 1.55vw, 24px) !important;
    line-height: 1.08 !important;
    white-space: normal;
}

.logo-text .desktop-logo-lines {
    display: inline;
}

.logo-text .mobile-logo-lines {
    display: none;
}

.custom-nav {
    flex: 1 1 auto;
    min-width: 0;
}

.custom-nav .nav-list {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
}

.custom-nav .nav-list li {
    flex: 0 0 auto;
}

.custom-nav .nav-list li a.menu-links {
    white-space: nowrap;
}

/* Header action buttons */
.right-end-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 0 0 auto;
    flex-wrap: nowrap;
}

.nav-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 44px;
    padding: 0 18px;
    border-radius: 12px;
    border: 1px solid #d7e2ee;
    background: #ffffff;
    color: #17324d;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.01em;
    text-decoration: none;
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
}

.nav-action-btn i {
    font-size: 14px;
}

.nav-action-btn:hover,
.nav-action-btn:focus {
    color: #0b4f74;
    border-color: #b9cde0;
    background: #f8fbff;
    transform: translateY(-1px);
    box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12);
}

.nav-action-btn:active {
    transform: translateY(0);
    box-shadow: 0 8px 18px rgba(15, 23, 42, 0.1);
}

.nav-action-btn.nav-action-primary {
    background: linear-gradient(135deg, #0b4f74 0%, #146c94 100%);
    border-color: #0b4f74;
    color: #ffffff;
    box-shadow: 0 12px 26px rgba(11, 79, 116, 0.22);
}

.nav-action-btn.nav-action-primary:hover,
.nav-action-btn.nav-action-primary:focus {
    color: #ffffff;
    background: linear-gradient(135deg, #094261 0%, #105b7c 100%);
    border-color: #094261;
}

.cart-icon {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    color: #17324d;
    background: #ffffff;
    border: 1px solid #d7e2ee;
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, background-color 0.2s ease;
}

.cart-icon:hover,
.cart-icon:focus {
    color: #0b4f74;
    border-color: #b9cde0;
    background: #f8fbff;
    transform: translateY(-1px);
    box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12);
}

.cart-count {
    position: absolute;
    top: -6px;
    right: -6px;
    min-width: 20px;
    height: 20px;
    padding: 0 5px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #ef476f;
    color: #ffffff;
    font-size: 11px;
    font-weight: 700;
    line-height: 1;
    border: 2px solid #ffffff;
}

@media (max-width: 1400px) {
    .menu-header {
        gap: 14px;
    }

    .dsk-logo {
        flex-basis: 360px;
    }

    .dsk-logo .logo-text {
        font-size: clamp(15px, 1.35vw, 20px) !important;
    }

    .custom-nav .nav-list li a.menu-links {
        font-size: 14px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .nav-action-btn {
        min-height: 42px;
        padding: 0 14px;
        font-size: 13px;
    }

    .right-end-btn {
        gap: 10px;
    }
}

@media (max-width: 1200px) {
    .dsk-logo {
        flex-basis: 300px;
    }

    .dsk-logo .logo-text {
        font-size: clamp(14px, 1.2vw, 18px) !important;
    }

    .custom-nav .nav-list li a.menu-links {
        font-size: 13px;
        padding-left: 8px;
        padding-right: 8px;
    }

    .nav-action-btn {
        padding: 0 12px;
        font-size: 12px;
    }
}

@media (max-width: 991.98px) {
    .right-end-btn {
        gap: 8px;
    }

    .nav-action-btn {
        min-height: 40px;
        padding: 0 14px;
        font-size: 13px;
        border-radius: 10px;
    }

    .cart-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
    }
}
/* STOP HEADER HIDING ON SCROLL */
.main-header.hide,
.main-header.up,
.main-header.down{
    transform: translateY(0) !important;
    top: 40px !important;
    opacity: 1 !important;
}

/* Ensure header always visible */
.main-header{
    position: fixed !important;
    top: 40px !important;
    left: 0;
    width: 100%;
    z-index: 9999;
}

/* MOBILE FIX */
@media (max-width:768px){

.main-header{
	position: fixed !important;
    top: 60px !important; /* below top header */
}

.main-header.hide,
.main-header.up,
.main-header.down{
    transform: translateY(0) !important;
    top: 60px !important;
}

}
/* mobile fix */
@media (max-width:768px){

.main-header{
top: 60px !important;   /* adjust below mobile top header */
}

.main-header.hide,
.main-header.up,
.main-header.down{
top: 60px !important;
}

}
@media (max-width:768px){

/* show top header */
.top-header{
position:fixed;
top:0;
left:0;
width:100%;
z-index:10000;
}

/* move main header below it */
header.main-header{
top:40px !important;
}

/* prevent page content hiding */
body{
padding-top:110px;
}

/* mobile layout */
.top-header-wrapper{
flex-direction:column;
text-align:center;
gap:5px;
}

.top-left a{
display:block;
margin-right:0;
font-size:12px;
}

}



.top-header{
position:fixed;
top:0;
left:0;
width:100%;
background:#0b4f74;
color:#fff;
padding:8px 0;
font-size:14px;
z-index:99999;
}

/* .top-header-wrapper{
display:flex;
align-items:center;
justify-content:center;
} */

.top-left a{
color:#fff;
margin-right:20px;
text-decoration:none;
}

.top-left i{
margin-right:6px;
}

.top-left a:hover{
color:#d1e7ff;
}

/* move main header below top header */
header.main-header{
top:40px !important;
}

/* mobile */
@media (max-width:768px){

.top-header-wrapper{
flex-direction:column;
text-align:center;
gap:5px;
}

.top-left a{
display:block;
margin-right:0;
}

header.main-header{
top:60px !important;
}
.dsk-logo .logo-text {
	font-size: 18px !important;
	line-height: 1.2 !important;
	max-width: 160px;
	white-space: normal;
	word-wrap: break-word;
}

@media (max-width: 480px) {
	.dsk-logo .logo-text {
		font-size: 16px !important;
		max-width: 120px;
	}
}
body{
padding-top:120px;
}

}
.top-header{
position:fixed;
top:0;
left:0;
width:100%;
background:#0b4f74;
color:#fff;
padding:8px 0;
font-size:14px;
z-index:99999;
}

.top-header-wrapper{
display:flex;
align-items:center;
justify-content:center;

}

.top-left a{
color:#fff;
margin-right:25px;
text-decoration:none;
font-weight:500;
}

/* ICON COLOR FIX */
.top-left i{
margin-right:6px;
color:#ff69b4 !important;   /* force pink instead of white */
}

.top-left a:hover{
color:#d1e7ff;
}

/* FORCE MOBILE HEADER VISIBLE ON SCROLL */
@media (max-width: 991.98px) {
    header.main-header,
    header.main-header.navfix,
    header.main-header.navfix.fixed-top,
    header.main-header.navfix.fixed-top.sticky,
    header.main-header.navfix.hide,
    header.main-header.navfix.up,
    header.main-header.navfix.down,
    .navfix,
    .navfix.hide,
    .navfix.up,
    .navfix.down,
    .main-header,
    .main-header.hide,
    .main-header.up,
    .main-header.down {
        position: fixed !important;
        top: 60px !important;
        left: 0 !important;
        width: 100% !important;
        transform: translateY(0) !important;
        transition: none !important;
        animation: none !important;
        opacity: 1 !important;
        visibility: visible !important;
        z-index: 99999 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    body {
        padding-top: 160px !important;
    }
}

@media (max-width: 768px) {
    .dsk-logo .logo-text {
        font-size: 16px !important;
        line-height: 1.08 !important;
        max-width: 145px !important;
        white-space: normal !important;
        word-break: break-word !important;
    }

    .dsk-logo .logo-text .desktop-logo-lines {
        display: none !important;
    }

    .dsk-logo .logo-text .mobile-logo-lines {
        display: inline !important;
    }
}

	</style>


</head>

	<body>

	@php
		$headerCart = session('cart', []);

		if (auth()->check() && empty($headerCart) && \Illuminate\Support\Facades\Schema::hasColumn('users', 'cart')) {
			$headerCart = auth()->user()->cart ?? [];
			session()->put('cart', $headerCart);
		}

		$headerCartCount = is_array($headerCart) ? count($headerCart) : 0;
	@endphp

		<!--<div class="onloadpage" id="page_loader">
	<div class="pre-content">
			<div class="logo-pre"><img src="images/logo.png" alt="Logo" class="img-fluid" /></div>
			<div class="pre-text- text-radius text-light text-animation bg-b">Niwax - Creative Agency & Portfolio HTML
				Template Are 2 Seconds Away. Have Patience</div>
		</div>
	</div>-->

<div class="top-header">
    <div class="container">
        <div class="top-header-wrapper">

            <div class="top-left">
                <a href="tel:+918072515050">
                    <i class="fas fa-phone"></i> +91 8072515050
                </a>

               

                <a href="mailto:services@pojotechnology.com">
                    <i class="fas fa-envelope"></i> services@pojotechnology.com
                </a>
            </div>

        </div>
    </div>
</div>
	<header class="header-pr nav-bg-b main-header navfix fixed-top menu-white" style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
		<div class="container-fluid m-pad">
			<div class="menu-header">
				<div class="dsk-logo">
    <a class="nav-brand" href="{{route('home')}}" style="text-decoration:none; display:flex; align-items:center; gap:14px;">
        <img src="{{ asset('img/logo (2).png') }}" alt="PojoCoursePilot Logo" style="max-height:100px; width:auto; display:block;" />
        <div class="logo-text" style="color:#0b4f74; font-weight:bold; font-size:32px; line-height:1.2;">
            {{-- <span class="desktop-logo-lines">PojoCoursePilot</span>
            <span class="mobile-logo-lines">PojoCoursePilot</span> --}}
        </div>
    </a>
</div>
				<div class="custom-nav" role="navigation">
					<ul class="nav-list">
						<li>
							<a href="{{route('home')}}" class="menu-links">Home</a>

						</li>
						<li>
							<a href="{{route('about')}}" class="menu-links">About</a>

						</li>
						<li>
						<a href="{{ url('list/course') }}" class="menu-links">Course List</a>
						</li>
						<li>
						<a href="{{route('contact')}}" class="menu-links">Contact Us</a>
						</li>
						
					

					</ul>

						<ul class="nav-list right-end-btn">
						<li class="hidemobile"><a href="{{ route('cart') }}" class="cart-icon">
							<i class="fa fa-shopping-cart"></i>
							<span class="cart-count">{{ $headerCartCount }}</span>
						</a>
	                   </li>
						@auth
						<li class="hidemobile"><a href="{{ route('my.orders') }}" class="nav-action-btn"><i class="fas fa-box-open"></i>My Orders</a></li>
						<li class="hidemobile"><a href="{{ route('logout') }}" class="nav-action-btn nav-action-primary"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
						@else
						<li class="hidemobile"><a href="{{route('customer.login')}}" target="blank" class="nav-action-btn nav-action-primary">Login</a> </li>
						@endauth

						<li class="hidedesktop"><a data-bs-toggle="offcanvas" href="#offcanvasExample"
								class="btn-round- btn-br bg-btn2" style="margin-right: 15px;">
							<i class="fas fa-phone-alt"></i>
						</a></li>
						<li class="navm- hidedesktop"> <a class="toggle" href="#"><span></span></a></li>
					</ul>
				</div>
			</div>

			<nav id="main-nav">
				<ul class="first-nav">
					<li>
						<a href="{{route('home')}}">Home</a>

					</li>
					<li>
						<a href="{{route('about')}}">About</a>
					</li>
					<li>
						<a href="{{ url('list/course') }}">Course List</a>
					</li>
					<li>
						<a href="{{route('contact')}}">Contact Us</a>
					</li>
					<li>
						<a href="{{ route('cart') }}">Cart</a>
					</li>
					@auth
					<li>
						<a href="{{ route('my.orders') }}">My Orders</a>
					</li>
					<li>
						<a href="{{ route('logout') }}">Logout</a>
					</li>
					@else
					<li>
									<a href="{{ route('customer.login') }}" class="nav-action-btn nav-action-primary">Login</a>
					@endauth



				</ul>

			</nav>
		</div>
	</header>


	<div class="niwaxofcanvas offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample">
		<div class="offcanvas-body">
			<div class="cbtn animation">
				<div class="btnclose"> <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
						aria-label="Close"></button></div>
			</div>

			<div class="getintouchblock mt30">
				<h4>Get In Touch</h4>

				<div class="media mt15">
					<div class="icondive"><img src="images/icons/call.svg" alt="icon"></div>
					<div class="media-body getintouchinfo">
						<a href="tel:+918072515050">+91 8072515050<span>Mon-Fri 9am - 6pm</span></a>
					</div>
				</div>
				<div class="media mt15">
					<div class="icondive"><img src="{{ asset('images/icons/whatsapp.svg')}}" alt="icon"></div>
					<div class="media-body getintouchinfo">
						<a href="https://wa.me/+918072515050" target="_blank">+91 8072515050 <span>Mon-Fri 9am -
								6pm</span></a>
					</div>
				</div>
				<div class="media mt15">
					<div class="icondive"><img src="{{ asset('images/icons/mail.svg')}}" alt="icon"></div>
					<div class="media-body getintouchinfo">
						<a href="mailto:services@pojotechnology.com" target="_blank">services@pojotechnology.com
							<span>Online Support</span></a>
					</div>
				</div>
				<div class="media mt15">
					<div class="icondive"><img src="{{ asset('images/icons/map.svg')}}" alt="icon"></div>
					<div class="media-body getintouchinfo">
						<a href="#">
								No 77, Velachery main road, Near to Tata motors show room,<br>Rajakilpakkam, Tambaram, Chennai 600073<span>Visit Our Office</span></a>
					</div>
				</div>
			</div>
			<div class="contact-data mt30">
				<h4>Follow Us On:</h4>
				<div class="social-media-linkz mt10">
					<a href="https://www.facebook.com/kudsit" target="blank"><i class="fab fa-facebook"></i></a>
					<a href="https://x.com/dukerala" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.instagram.com/accounts/suspended/?next=https%3A%2F%2Fwww.instagram.com%2Fdukerala%2F%3F__coig_ufac%3D1#" target="blank"><i class="fab fa-instagram"></i></a>
					<a href="https://www.youtube.com/c/DigitalUniversityKerala" target="blank"><i class="fab fa-youtube"></i></a>
					</div>
			</div>
		</div>
	</div>

