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
									<li><a href="#">{{ $type == 'board_of_director' ? 'Board of Directors' : 'People' }}</a></li>
								</ul>
							</div>
							<div class="bread-title">
								<h2 class="team-heading">
    {{ $type == 'board_of_director' ? 'Board of Directors' : 'People' }}</h2>
</h2></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="team-section">
   
    <div class="team-grid">

        <!-- Single Item -->
        @foreach($leaders as $item)
        <div class="team-item"
             onclick="openPopup('{{ asset('storage/'.$item->image) }}',
                                '{{ $item->name }}',
                                '{{ $item->designation }}',
                                `{{ $item->description }}`)">
            <div class="team-img-wrap">
                <img src="{{ asset('storage/'.$item->image) }}" class="team-img">
            </div>
            <h4>{{ $item->name }}</h4>
            <p>{{ $item->designation }}</p>
        </div>
    @endforeach
        
    </div>
</section>

<!-- POPUP MODAL -->
<!-- POPUP MODAL -->
<div id="popupModal" class="popup-overlay">
    <div class="popup-box">
        <span class="popup-close" onclick="closePopup()">×</span>

        <div class="popup-content">
            <div class="popup-left">
                <img id="popupImg" class="popup-img">
            </div>

            <div class="popup-right">
                <h2 id="popupName" class="popup-title"></h2>
                <p id="popupRole" class="popup-role"></p>
                <hr class="popup-divider">
                <p id="popupDesc" class="popup-desc"></p>
            </div>
        </div>
    </div>
</div>



<script>
    function openPopup(img, name, role, desc) {
    document.getElementById('popupImg').src = img;
    document.getElementById('popupName').innerText = name;
    document.getElementById('popupRole').innerText = role;
    document.getElementById('popupDesc').innerText = desc;

    document.getElementById('popupModal').style.display = "flex";
}

function closePopup() {
    document.getElementById('popupModal').style.display = "none";
}

    </script>
@include('footer');
