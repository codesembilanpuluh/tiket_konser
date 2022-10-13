<aside class="main-sidebar sidebar-dark-primary">
	<a href="#" class="brand-link">
		<img src="{{asset('img/logo.png')}}" alt="" class="brand-image img-circle" style="opacity: .8">
		<span class="brand-text font-weight-light" style="font-size: 1.1rem;">Administrator</span>
	</a>
	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="{{ asset('img/user.jpg') }}" class="img-circle" alt="User Image">
			</div>
			<div class="info">
				<a href="javascript:void(0)" class="d-block">{{ucwords(str_replace('_',' ', auth()->user()->nm_lengkap))}}</a>
				<a href="javascript:void(0)" class="d-block">{{ucwords(str_replace('_',' ', auth()->user()->username))}}</a>
			</div>
		</div>

		@include('admin.layout.menu')
	</div>
</aside>