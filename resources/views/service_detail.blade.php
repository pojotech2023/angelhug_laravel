@include('header');
<section class="breadcrumb-areav2" data-background="images/banner/6.jpg">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7">
					<div class="bread-titlev2">
						<h1 class="wow fadeInUp" data-wow-delay=".2s">{{ $service->title }} </h1>

					</div>
				</div>
			</div>
		</div>
	</section>
  <div class="event-detail-wrapper">
  <div class="event-header">
    <h1>{{ $service->title }} </h1>
    <div class="event-meta">📅{{ \Carbon\Carbon::parse($service->date)->format('M jS Y') }} </div>
  </div>
  <div class="event-content" >
<h3>{{ $service->title }}</h3> 

  
  </div>
  
  <div class="blog-image mb-4">
    <img src="{{ asset('storage/'.$service->image) }}" 
         alt="Event Banner" 
         class="w-100 rounded shadow-sm" 
         style="height: 500px; object-fit: cover;">
</div>


   
  <p style="margin-top:50px">{{ $service->subtitle }}</p>



  <div class="event-content">
   {{ strip_tags($service->description) }}

 </div>

  
</div>
@include('footer');
