<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="utf-8" />
	<title>Social and Natural Conservation Trust</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link href="images/logo/logo.png">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/plugin.min.css" rel="stylesheet">
	<link href="css/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;display=swap"
		rel="stylesheet">

	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/darkmode.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<style>
	.language-switcher {
    display: inline-block;
    margin: 10px;
}
.text-white {
            color: #ffffff;
        }

        .slide-title h3,
        .slide-text p {
            color: white;
            z-index: 2;
        }

        .about-sec-app .row > div {
    display: flex;
    flex-direction: column;
}

.about-sec-app img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px; /* Optional */
}

.info-card {
  transition: all 0.3s ease-in-out;
}
.info-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.language-switcher {
    display: inline-block;
    margin: 10px;
}
.language-switcher select {
    padding: 5px;
    border-radius: 5px;
}
.toggle span,
.toggle span:before,
.toggle span:after {
    background-color: #000 !important;
}
.toggle {
    display: block;
    width: 30px;
    height: 22px;
    position: relative;
}

.toggle span, .toggle span:before, .toggle span:after {
    content: '';
    background: #000;
    height: 2px;
    width: 100%;
    position: absolute;
    left: 0;
    transition: all 0.3s;
}

.toggle span {
    top: 10px;
}

.toggle span:before {
    top: -8px;
}

.toggle span:after {
    top: 8px;
}
*/
.nav-list li {
    margin: 0 15px; /* 15px space left and right */
    list-style: none;
}

/* Optional: Make links inside the li look nice */
.nav-list li a {
    text-decoration: none;
    color: #000; /* Set your text color */
    font-weight: 500;
    font-size: 16px;
}

/* Optional: Adjust Register button inside menu */


.language-switcher select {
    padding: 5px;
    border-radius: 5px;
}
</style>
</head>

<body>

@include('header')


	<section class="breadcrumb-area banner-1">
		<div class="text-block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 v-center">
						<div class="bread-inner">
							<div class="bread-menu">
								<ul>
									<li><a href="{{route('home')}}">{{ __('messages.home') }}</a></li>
									<li><a href="#">{{ __('messages.rules') }}</a></li>
								</ul>
							</div>
							<div class="bread-title">
								<h2>{{ __('messages.rules') }}</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="about-sec-app pad-tb pt60 dark-bg2">
    <div class="container">
        <div class="row d-flex align-items-stretch">
            <div class="col-lg-11">
                <div class="common-heading text-l h-100">
                    <h3 class="mb30">
                        <span class="text-second text-bold">1. {{ __('messages.application_title') }} </span>
                    </h3>
                    <p class="text-justify"> 1.{{ __('messages.acontent1') }}</p>
                        <p class="text-justify"> 2. {{ __('messages.acontent2') }}</p>
                        <p class="text-justify"> 3.  {{ __('messages.acontent3') }}</p>
                        <p><b style="color:black">4. {{ __('messages.acontent4') }}</b></p>
                        <p><i class="fa fa-check tick-icon text-success"></i>  {{ __('messages.acontent5') }}</p>
                        <p><i class="fa fa-check tick-icon text-success"></i>  {{ __('messages.acontent6') }}</p>
                        <p><b style="color:black">5. {{ __('messages.acontent7') }}</b></p>
                        <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent8') }}</p>
                        <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent9') }}</p>
                        <p class="text-justify"> 6.{{ __('messages.acontent10') }}</p>
                        <p class="text-justify"> 7.{{ __('messages.acontent11') }}</p>  
                       
                        <h3 class="mb30" style="margin-top:30px">
                        <span class="text-second text-bold" >2. {{ __('messages.acontent12') }} </span>
                    </h3>
                    <p class="text-justify"> 1.{{ __('messages.acontent13') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent14') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent15') }}</p>
                    <p class="text-justify"> 2.{{ __('messages.acontent16') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent17') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent18') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent19') }}</p>
                    <p class="text-justify"> 3.{{ __('messages.acontent20') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent21') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent22') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent23') }}</p>
                    <p><i class="fa fa-check tick-icon text-success"></i> {{ __('messages.acontent24') }}</p>
                    <p class="text-justify"> 3.{{ __('messages.acontent25') }}</p>
                   </div>
            </div>
          
        </div>
    </div>
</section>



<div class="container mx-auto p-4">
    <h1 class="text-xl font-semibold mb-6 text-center text-second">@lang('messages.faq_title')</h1>

    <div class="flex flex-col lg:flex-row items-center space-y-6 lg:space-x-6 lg:space-y-0">
        <div class="flex-1">
            @for ($i = 1; $i <= 19; $i++)
                <div class="border p-4 rounded-lg shadow-sm mb-4">
                    <h5 class="font-medium text-lg text-blue-700">@lang("messages.q$i")</h5>
                    <p class="mt-2 text-sm text-gray-800">@lang("messages.a$i")</p>
                </div>
            @endfor
        </div>

        <!-- Image Section on the right side -->
       
    </div>
</div>


	@include('footer')

	<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/plugin.min.js"></script>
	<script src="js/dark-mode.js"></script>

	<script src="js/main.js"></script>
</body>

</html>
