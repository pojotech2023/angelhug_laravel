@include('header');
<section class="breadcrumb-areav2" data-background="images/banner/6.jpg">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7">
					<div class="bread-titlev2">
						<h1 class="wow fadeInUp" data-wow-delay=".2s">News & Events</h1>

					</div>
				</div>
			</div>
		</div>
	</section>


<section class="blog-section pad-tb" style="background-color: #f9f9f9; padding: 60px 0;">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-10 text-center">
        <span style="color: #e60000; font-weight: bold;">Latest News & Events</span>
        <h2 style="font-size: 32px; margin-top: 10px;">Latest News & Events</h2>
      </div>
    </div>

    <div class="row">

      <!-- Blog Post 1 -->
        @foreach ($services as $service)
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="blog-card">
          <div class="blog-image">
            <img src="{{ asset('storage/'.$service->image) }}" alt="Make Your Brand Stand Out" class="img-fluid">
          </div>
          <div class="blog-content">
            <div class="blog-meta">
              <span><i class="fa fa-user"></i> samuga puyal</span>
              <span><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($service->date)->format('M jS Y') }} </span>
            </div>
            <h4><a href="{{ route('servicedetails', $service->id) }}">{{ $service->title }}</a></h4>
            <p>{{ $service->subtitle }}</p>
            <a href="{{ route('servicedetails', $service->id) }}" class="read-more">Read More →</a>
          </div>
        </div>
      </div>
@endforeach
      <!-- Blog Post 2 -->
   

      <!-- Blog Post 3 -->
      <!--<div class="col-lg-4 col-md-6 mb-4">
        <div class="blog-card">
          <div class="blog-image">
            <img src="img/news.jpg" alt="Quick Social Media Audit" class="img-fluid">
          </div>
          <div class="blog-content">
            <div class="blog-meta">
              <span><i class="fa fa-user"></i>  Bio Cute</span>
              <span><i class="fa fa-calendar"></i> 08 Apr, 2025</span>
            </div>
            <h4><a href="event_details.html">New Product Launch - Dermacure+ Cream</a></h4>
            <p>A 30-minute guide to reviewing your brand’s social media performance effectively.</p>
            <a href="event_details.html" class="read-more">Read More →</a>
          </div>
        </div>
      </div>-->

    </div>
  </div>
</section>
@include('footer');
