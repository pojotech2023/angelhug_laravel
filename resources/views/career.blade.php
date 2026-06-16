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
									<li><a href="#"> @if($type == 'career') Careers @endif
    @if($type == 'ranklist') Rank List @endif
    @if($type == 'tender') Tenders @endif</a></li>
								</ul>
							</div>
							<div class="bread-title">
								<h2 class="page-title">
    @if($type == 'career') Careers @endif
    @if($type == 'ranklist') Rank List @endif
    @if($type == 'tender') Tenders @endif
</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="job-section">
    <div class="container">

        <!-- Job Card 1 -->
      @foreach($documents as $doc)
<div class="job-card">
    <div class="job-content">

        <!-- Description (text editor content) -->
        <p>{!! $doc->description !!}</p>

       

        <div class="job-footer">
            @if($doc->file)
                <a href="{{ asset('uploads/documents/'.$doc->file) }}" target="_blank" class="job-btn">
                    {{ $doc->button_name }}
                </a>
            @endif
        </div>

    </div>
</div>
@endforeach


        <!-- Job Card 2 -->
       

    </div>
</section>




@include('footer');
