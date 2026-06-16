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
									<li><a href="#">CoE in IIoT SENSORS</a></li>
								</ul>
							</div>
							<div class="bread-title">
								<h2>CoE in IIoT SENSORS</h2>
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
            
        
            <!-- Right image -->
            <div class="col-lg-12 d-flex">
                <div class="funfact w-100 d-flex">
                    <img src="images/coe.jpg" class="img-fluid w-100 object-fit-cover" style="border-radius:10px;">
                </div>
            </div>

        </div>
    </div>	

</section>



@include('footer');
