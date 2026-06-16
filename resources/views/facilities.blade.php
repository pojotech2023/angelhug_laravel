<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="utf-8" />
	<title>PojoCoursePilot - Facilities</title>
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
.toggle {
    display: block;
    width: 30px;
    height: 22px;
    position: relative;
}
.toggle span,
.toggle span:before,
.toggle span:after {
    background-color: #000 !important;
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
									<li><a href="#">{{ __('messages.med') }}</a></li>
								</ul>
							</div>
							<div class="bread-title">
								<h2>{{ __('messages.med') }}</h2>
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
            <div class="col-lg-10">
                <div class="common-heading text-l h-100">
                    <h2 class="mb30">
                        <span class="text-second text-bold">{{ __('messages.medical_facilities_title') }} </span>
                    </h2>
                    <p class="text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        {{ __('messages.medical_facilities_description') }}</p>
                        <p class="text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        {{ __('messages.medical_facilities_key_provisions') }}</p>
                    <p class="text-justify">
                        <b style="color:black">{{ __('messages.medical_facilities_route') }}</b> </p>
                    <p class="mt10 text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        <b style="color:black">{{ __('messages.medical_stations1') }}</b> {{ __('messages.medical_stations') }}</p>
                    <p class="mt10 text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        <b style="color:black">{{ __('messages.medics_on_bikes1') }}</b> {{ __('messages.medics_on_bikes') }}</p>
                        <p class="mt10 text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        <b style="color:black">{{ __('messages.ambulances1') }}</b> {{ __('messages.ambulances') }}</p>
                        <p class="text-justify">
                        <b style="color:black">{{ __('messages.hospital_support') }}</b> </p>
                        <p class="text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        {{ __('messages.partner_hospital') }}</p>
                        <p class="text-justify"><b style="color:black">
                        {{ __('messages.base_camps') }}</b></p>
                        <p class="text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        {{ __('messages.medical_base_camps') }}</p>
                        <p class="text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        {{ __('messages.mini_medical_camps') }}</p>
                        <p class="text-justify"><b style="color:black">{{ __('messages.specialized_monitoring') }}</b></p>
                        <p class="text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        {{ __('messages.physiotherapist_team') }}</p>
                        <p class="text-justify"><i class="fa fa-check tick-icon text-success"></i>
                        {{ __('messages.spotters_in_last_2km') }}</p>
                        <p class="text-justify"><b style="color:black">{{ __('messages.mist_blowers') }}</b></p>
                        <p class="text-justify">{{ __('messages.water_jet_machines') }}</p>
                        


                        
                    </div>
            </div>
            
        </div>
    </div>
</section>
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
