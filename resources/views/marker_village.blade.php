	@include('header');
    <section class="breadcrumb-area banner-1" data-background="images/banner/9.jpg">
		<div class="text-block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 v-center">
						<div class="bread-inner">
							<div class="bread-menu">
								<ul>
									<li><a href="{{route('home')}}">Home</a></li>
									<li><a href="#">Makervillage</a></li>
								</ul>
							</div>
							<div class="bread-title">
								<h2>Makervillage</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="about-sec-app pad-tb pt60 dark-bg2">
    <div class="container">
        <div class="row align-items-stretch"> <!-- make both columns same height -->
            
            <!-- Left content -->
            <div class="col-lg-6 d-flex">
                <div class="common-heading text-l my-auto"> <!-- vertically center -->
                    <h2 class="mb30"><span class="text-second text-bold">About Maker Village</span></h2>
                    <p class="text-justify">Maker Village is the largest electronic hardware incubator and ESDM facility in the country, which is a pioneering startup initiative of Ministry of Electronics and Information Technology, Government of India with Indian Institute of Information Technology, Trivandrum as the implementation agency and Kerala Startup Mission as the supporting partner. </p>
                   </div>
            </div>

            <!-- Right image -->
            <div class="col-lg-6 d-flex">
                <div class="funfact w-100 d-flex">
                    <img src="images/about-banner.jpg" class="img-fluid w-100 object-fit-cover" style="border-radius:10px;">
                </div>
            </div>

        </div>
    </div>	<section class="about-sec-app pad-tb pt60 dark-bg2">
    <div class="container">
        <div class="row align-items-stretch"> <!-- make both columns same height -->
            
            <!-- Left content -->
            <div class="col-lg-12 d-flex">
                <div class="funfact w-100 d-flex">
    <video class="img-fluid w-100 object-fit-cover" autoplay loop muted playsinline style="border-radius:10px;">
        <source src="images/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

            </div>

            <!-- Right image -->
            

        </div>
    </div>
</section>
</section>



@include('footer');
