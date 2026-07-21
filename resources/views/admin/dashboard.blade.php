@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
	<div class="col-12 col-xl-12 grid-margin stretch-card">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
					<h6 class="card-title mb-0">MA Miftahul Midad Dashboard</h6>
					<div class="dropdown">
						<button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.articles.create') }}"><i data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah Artikel</span></a>
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.article-categories.create') }}"><i data-feather="tag" class="icon-sm me-2"></i> <span class="">Tambah Kategori</span></a>
						</div>
					</div>
				</div>
				<div class="row align-items-start">
					<div class="col-md-7">
						<p class="text-muted tx-13 mb-3 mb-md-0">Selamat datang di dashboard admin MA Miftahul Midad. Kelola artikel, kategori, dan penulis dengan mudah.</p>
					</div>
					<div class="col-md-5 d-flex justify-content-md-end">
						<div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
							<button type="button" class="btn btn-outline-primary">Hari ini</button>
							<button type="button" class="btn btn-outline-primary d-none d-md-block">Minggu ini</button>
							<button type="button" class="btn btn-primary">Bulan ini</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-7 col-xl-8 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-2">
					<h6 class="card-title mb-0">Statistik Portal</h6>
					<div class="dropdown mb-2">
						<button class="btn p-0" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.articles.index') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat Semua</span></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6 col-md-12 col-xl-5">
						<h3 class="mb-2">{{ $stats['total_articles'] }}</h3>
						<div class="d-flex align-items-baseline">
							<p class="text-success">
								<span>{{ $stats['published_articles'] }}</span>
								<i data-feather="trending-up" class="icon-sm mb-1"></i>
							</p>
						</div>
					</div>
					<div class="col-6 col-md-12 col-xl-7">
						<div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-5 col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h6 class="card-title">Ringkasan</h6>
				<div class="row">
					<div class="col-6">
						<div class="d-flex align-items-center">
							<div class="icon-sm bg-primary text-white rounded-3 me-3">
								<i data-feather="book"></i>
							</div>
							<div>
								<h6 class="mb-0">{{ $stats['total_articles'] }}</h6>
								<p class="text-muted mb-0">Total Artikel</p>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="d-flex align-items-center">
							<div class="icon-sm bg-success text-white rounded-3 me-3">
								<i data-feather="check-circle"></i>
							</div>
							<div>
								<h6 class="mb-0">{{ $stats['published_articles'] }}</h6>
								<p class="text-muted mb-0">Artikel Terbit</p>
							</div>
						</div>
					</div>
					<div class="col-6 mt-3">
						<div class="d-flex align-items-center">
							<div class="icon-sm bg-info text-white rounded-3 me-3">
								<i data-feather="user"></i>
							</div>
							<div>
								<h6 class="mb-0">{{ $stats['total_authors'] }}</h6>
								<p class="text-muted mb-0">Total Penulis</p>
							</div>
						</div>
					</div>
					<div class="col-6 mt-3">
						<div class="d-flex align-items-center">
							<div class="icon-sm bg-warning text-white rounded-3 me-3">
								<i data-feather="users"></i>
							</div>
							<div>
								<h6 class="mb-0">{{ $stats['total_users'] }}</h6>
								<p class="text-muted mb-0">Total User</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Additional Statistics -->
<div class="row">
	<div class="col-lg-3 col-md-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon-sm bg-info text-white rounded-3 me-3">
						<i data-feather="bell"></i>
					</div>
					<div>
						<h6 class="mb-0">{{ $stats['total_announcements'] }}</h6>
						<p class="text-muted mb-0">Total Pengumuman</p>
						<small class="text-success">{{ $stats['published_announcements'] }} Terbit</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon-sm bg-warning text-white rounded-3 me-3">
						<i data-feather="image"></i>
					</div>
					<div>
						<h6 class="mb-0">{{ $stats['total_galleries'] }}</h6>
						<p class="text-muted mb-0">Total Galeri</p>
						<small class="text-success">{{ $stats['featured_galleries'] }} Unggulan</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon-sm bg-purple text-white rounded-3 me-3">
						<i data-feather="edit-3"></i>
					</div>
					<div>
						<h6 class="mb-0">{{ $stats['total_pena_karsa'] }}</h6>
						<p class="text-muted mb-0">Total Pena Karsa</p>
						<small class="text-success">{{ $stats['featured_pena_karsa'] }} Unggulan</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="icon-sm bg-danger text-white rounded-3 me-3">
						<i data-feather="mail"></i>
					</div>
					<div>
						<h6 class="mb-0">{{ $stats['total_contact_messages'] }}</h6>
						<p class="text-muted mb-0">Total Pesan</p>
						@if($stats['unread_contact_messages'] > 0)
							<small class="text-danger">{{ $stats['unread_contact_messages'] }} Belum Dibaca</small>
						@else
							<small class="text-success">Semua Terbaca</small>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Alerts & Quick Actions -->
@if($alerts['unread_messages'] > 0 || $alerts['draft_articles'] > 0 || $alerts['draft_announcements'] > 0)
<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card border-warning">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<h6 class="card-title mb-0 text-warning">
							<i data-feather="alert-triangle" class="icon-sm me-2"></i>
							Perhatian & Tindakan
						</h6>
					</div>
				</div>
				<div class="row mt-3">
					@if($alerts['unread_messages'] > 0)
					<div class="col-md-4">
						<div class="alert alert-danger d-flex align-items-center" role="alert">
							<i data-feather="mail" class="icon-sm me-2"></i>
							<div>
								<strong>{{ $alerts['unread_messages'] }} pesan</strong> belum dibaca
								<br><a href="{{ route('admin.contact.index') }}" class="alert-link">Lihat pesan</a>
							</div>
						</div>
					</div>
					@endif
					@if($alerts['draft_articles'] > 0)
					<div class="col-md-4">
						<div class="alert alert-warning d-flex align-items-center" role="alert">
							<i data-feather="edit" class="icon-sm me-2"></i>
							<div>
								<strong>{{ $alerts['draft_articles'] }} artikel</strong> dalam draft
								<br><a href="{{ route('admin.articles.index') }}?status=draft" class="alert-link">Review artikel</a>
							</div>
						</div>
					</div>
					@endif
					@if($alerts['draft_announcements'] > 0)
					<div class="col-md-4">
						<div class="alert alert-info d-flex align-items-center" role="alert">
							<i data-feather="bell" class="icon-sm me-2"></i>
							<div>
								<strong>{{ $alerts['draft_announcements'] }} pengumuman</strong> dalam draft
								<br><a href="{{ route('admin.announcements.index') }}?status=draft" class="alert-link">Review pengumuman</a>
							</div>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endif

<!-- Page Views Statistics -->
<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-4">
					<h6 class="card-title mb-0">
						<i data-feather="bar-chart-2" class="icon-sm me-2"></i>
						Statistik Pengunjung Website
					</h6>
					<div class="btn-group" role="group" aria-label="Period selector" id="visitor-period">
						<button type="button" class="btn btn-outline-primary btn-sm" data-period="today">Hari Ini</button>
						<button type="button" class="btn btn-outline-primary btn-sm" data-period="week">Minggu Ini</button>
						<button type="button" class="btn btn-primary btn-sm" data-period="month">Bulan Ini</button>
						<button type="button" class="btn btn-outline-primary btn-sm" data-period="year">Tahun Ini</button>
					</div>
				</div>

				<!-- Page Views Cards -->
				<div class="row mb-4">
					<div class="col-md-3">
						<div class="card bg-primary text-white">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<div>
										<h4 class="mb-0" id="total-views">{{ $pageViewsStats['month']['total_views'] }}</h4>
										<p class="mb-0">Total Kunjungan</p>
									</div>
									<div class="align-self-center">
										<i data-feather="eye" class="icon-lg"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card bg-success text-white">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<div>
										<h4 class="mb-0" id="unique-visitors">{{ $pageViewsStats['month']['unique_visitors'] }}</h4>
										<p class="mb-0">Pengunjung Unik</p>
									</div>
									<div class="align-self-center">
										<i data-feather="users" class="icon-lg"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card bg-info text-white">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<div>
										<h4 class="mb-0" id="today-views">{{ $pageViewsStats['today']['total_views'] }}</h4>
										<p class="mb-0">Hari Ini</p>
									</div>
									<div class="align-self-center">
										<i data-feather="calendar" class="icon-lg"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card bg-warning text-white">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<div>
										<h4 class="mb-0" id="week-views">{{ $pageViewsStats['week']['total_views'] }}</h4>
										<p class="mb-0">Minggu Ini</p>
									</div>
									<div class="align-self-center">
										<i data-feather="trending-up" class="icon-lg"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Chart Full Width -->
				<div class="row mb-4">
					<div class="col-12">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h6 class="card-title mb-0" id="chart-title">Grafik Tren</h6>
						</div>
						<div class="chart-container-full" style="position: relative; height: 300px; overflow-x: auto;">
							<canvas id="pageViewsChart" height="300" style="min-width: 800px;"></canvas>
						</div>
					</div>
				</div>

				<!-- Top Pages Detailed -->
				<div class="row">
					<div class="col-md-8">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h6 class="card-title mb-0">Halaman Terpopuler</h6>
						</div>
						<div class="table-responsive">
							<table class="table table-hover">
								<thead class="table-light">
									<tr>
										<th width="5%">#</th>
										<th width="50%">Halaman</th>
										<th width="15%">Kunjungan</th>
										<th width="15%">Persentase</th>
										<th width="15%">Trend</th>
									</tr>
								</thead>
								<tbody id="top-pages">
									@foreach($pageViewsStats['month']['top_pages'] as $index => $page)
									@php $pageUrlDisplay = $page->url ?? $page->page_url; @endphp
									<tr>
										<td>
											<span class="badge bg-{{ $index < 3 ? 'primary' : 'secondary' }}">
												{{ $index + 1 }}
											</span>
										</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="me-2">
													@if(str_contains($pageUrlDisplay, '/article/'))
														<i data-feather="book" class="icon-sm text-primary"></i>
													@elseif(str_contains($pageUrlDisplay, '/announcements'))
														<i data-feather="bell" class="icon-sm text-info"></i>
													@elseif(str_contains($pageUrlDisplay, '/galleries'))
														<i data-feather="image" class="icon-sm text-warning"></i>
													@elseif(str_contains($pageUrlDisplay, '/pena-karsa'))
														<i data-feather="edit-3" class="icon-sm text-purple"></i>
													@elseif($pageUrlDisplay === '/')
														<i data-feather="home" class="icon-sm text-success"></i>
													@else
														<i data-feather="file" class="icon-sm text-secondary"></i>
													@endif
												</div>
												<div>
													<h6 class="mb-0">{{ $page->page_title ?: 'Halaman' }}</h6>
													<small class="text-muted">{{ $pageUrlDisplay }}</small>
												</div>
											</div>
										</td>
										<td>
											<span class="badge bg-primary fs-6">{{ number_format($page->views) }}</span>
										</td>
										<td>
											@php
												$totalViews = $pageViewsStats['month']['total_views'];
												$percentage = $totalViews > 0 ? round(($page->views / $totalViews) * 100, 1) : 0;
											@endphp
											<div class="progress" style="height: 8px;">
												<div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<small class="text-muted">{{ $percentage }}%</small>
										</td>
										<td>
											@if($index < 3)
												<span class="badge bg-success">
													<i data-feather="trending-up" class="icon-sm me-1"></i>Hot
												</span>
											@else
												<span class="badge bg-secondary">Stable</span>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="text-center mt-2">
							<small class="text-muted">Menampilkan 10 halaman terpopuler berdasarkan periode yang dipilih</small>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card bg-light mb-3">
							<div class="card-body">
								<h6 class="card-title mb-3">Sumber Rujukan</h6>
								<div id="referrers-list">
									<div class="text-muted">Memuat...</div>
								</div>
							</div>
						</div>
						<div class="card bg-light">
							<div class="card-body">
								<h6 class="card-title mb-3">Browser</h6>
								<div id="browsers-list">
									<div class="text-muted">Memuat...</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-8 col-xl-8 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-2">
					<h6 class="card-title mb-0">Artikel Terbaru</h6>
					<div class="dropdown mb-2">
						<button class="btn p-0" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.articles.index') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat Semua</span></a>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th class="pt-0">Judul</th>
								<th class="pt-0">Penulis</th>
								<th class="pt-0">Status</th>
								<th class="pt-0">Tanggal</th>
							</tr>
						</thead>
						<tbody>
							@foreach($recent_articles as $article)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<img src="{{ $article->image }}" alt="img" class="img-xs rounded-circle me-2">
										<div>
											<h6 class="mb-0">{{ Str::limit($article->title, 30) }}</h6>
											<small class="text-muted">{{ $article->categories->pluck('name')->implode(', ') }}</small>
										</div>
									</div>
								</td>
								<td>{{ $article->author->name }}</td>
								<td>
									@if($article->status === 'published')
										<span class="badge bg-success">Terbit</span>
									@else
										<span class="badge bg-warning">Draft</span>
									@endif
								</td>
								<td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-2">
					<h6 class="card-title mb-0">Penulis Aktif</h6>
				</div>
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th class="pt-0">Nama</th>
								<th class="pt-0">Artikel</th>
							</tr>
						</thead>
						<tbody>
							@foreach($recent_authors as $author)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<div class="me-2">
											@if(!empty($author->avatar))
												<img src="{{ $author->avatar }}" alt="img" class="img-xs rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
											@else
												@php
													$name = $author->name;
													$parts = preg_split('/\s+/', trim($name));
													$initials = '';
													foreach ($parts as $p) { $initials .= mb_strtoupper(mb_substr($p, 0, 1)); if (mb_strlen($initials) >= 2) break; }
												@endphp
												<div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: .8rem; font-weight: bold;">
													{{ $initials }}
												</div>
											@endif
										</div>
										<div>
											<h6 class="mb-0">{{ $author->name }}</h6>
											<small class="text-muted">{{ $author->specialization }}</small>
										</div>
									</div>
								</td>
								<td>{{ $author->articles_count }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Recent Activities -->
<div class="row">
	<div class="col-lg-4 col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-2">
					<h6 class="card-title mb-0">Pengumuman Terbaru</h6>
					<div class="dropdown mb-2">
						<button class="btn p-0" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.announcements.index') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat Semua</span></a>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th class="pt-0">Judul</th>
								<th class="pt-0">Status</th>
								<th class="pt-0">Tanggal</th>
							</tr>
						</thead>
						<tbody>
							@foreach($recent_announcements as $announcement)
							<tr>
								<td>
									<div>
										<h6 class="mb-0">{{ Str::limit($announcement->title, 25) }}</h6>
										<small class="text-muted">{{ $announcement->category->name ?? 'Umum' }}</small>
									</div>
								</td>
								<td>
									@if($announcement->is_published)
										<span class="badge bg-success">Terbit</span>
									@else
										<span class="badge bg-warning">Draft</span>
									@endif
								</td>
								<td>{{ $announcement->created_at->format('d M') }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-2">
					<h6 class="card-title mb-0">Galeri Terbaru</h6>
					<div class="dropdown mb-2">
						<button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.galleries.index') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat Semua</span></a>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th class="pt-0">Judul</th>
								<th class="pt-0">Status</th>
								<th class="pt-0">Tanggal</th>
							</tr>
						</thead>
						<tbody>
							@foreach($recent_galleries as $gallery)
							<tr>
								<td>
									<div>
										<h6 class="mb-0">{{ Str::limit($gallery->title, 25) }}</h6>
										<small class="text-muted">{{ $gallery->category->name ?? 'Umum' }}</small>
									</div>
								</td>
								<td>
									@if($gallery->is_published)
										<span class="badge bg-success">Terbit</span>
									@else
										<span class="badge bg-warning">Draft</span>
									@endif
								</td>
								<td>{{ $gallery->created_at->format('d M') }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-baseline mb-2">
					<h6 class="card-title mb-0">Pena Karsa Terbaru</h6>
					<div class="dropdown mb-2">
						<button class="btn p-0" type="button" id="dropdownMenuButton8" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton8">
							<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.pena-karsa.index') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat Semua</span></a>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th class="pt-0">Judul</th>
								<th class="pt-0">Jenis</th>
								<th class="pt-0">Tanggal</th>
							</tr>
						</thead>
						<tbody>
							@foreach($recent_pena_karsa as $pena)
							<tr>
								<td>
									<div>
										<h6 class="mb-0">{{ Str::limit($pena->title, 25) }}</h6>
										<small class="text-muted">{{ $pena->author_name }}</small>
									</div>
								</td>
								<td>
									<span class="badge bg-info">{{ ucfirst($pena->type) }}</span>
								</td>
								<td>{{ $pena->created_at->format('d M') }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('plugin-js')
<script src="{{ asset('template/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('custom-css')
<style>
.chart-container, .chart-container-full {
	scrollbar-width: thin;
	scrollbar-color: #007bff #f8f9fa;
}

.chart-container::-webkit-scrollbar, .chart-container-full::-webkit-scrollbar {
	height: 8px;
}

.chart-container::-webkit-scrollbar-track, .chart-container-full::-webkit-scrollbar-track {
	background: #f8f9fa;
	border-radius: 4px;
}

.chart-container::-webkit-scrollbar-thumb, .chart-container-full::-webkit-scrollbar-thumb {
	background: #007bff;
	border-radius: 4px;
}

.chart-container::-webkit-scrollbar-thumb:hover, .chart-container-full::-webkit-scrollbar-thumb:hover {
	background: #0056b3;
}

.chart-container, .chart-container-full {
	scroll-behavior: smooth;
}

.text-purple {
	color: #6f42c1 !important;
}

.bg-purple {
	background-color: #6f42c1 !important;
}
</style>
@endpush

@push('custom-js')
<script>
	$(function() {
		'use strict';

		var options = {
			series: [{{ $stats['published_articles'] }}, {{ $stats['total_articles'] - $stats['published_articles'] }}],
			chart: {
				width: 380,
				type: 'donut',
			},
			labels: ['Terbit', 'Draft'],
			colors: ['#28a745', '#ffc107'],
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}]
		};

		var chart = new ApexCharts(document.querySelector("#apexChart1"), options);
		chart.render();

		// Page Views Chart
		var dailyViewsData = @json($dailyViews);
		var chartContainer = document.querySelector('.chart-container-full');
		var pageViewsChart = null;

		// Initialize chart
		function initChart(data) {
			if (pageViewsChart) {
				pageViewsChart.destroy();
			}

			if (data && data.length > 0) {
				var labels = data.map(item => {
					if (item.label) { return item.label; }
					var date = new Date(item.date);
					return isNaN(date.getTime()) ? (item.date || '') : date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
				});
				var views = data.map(item => parseInt(item.views) || 0);

				var ctx = document.getElementById('pageViewsChart');
				if (ctx) {
					pageViewsChart = new Chart(ctx.getContext('2d'), {
						type: 'line',
						data: {
							labels: labels,
							datasets: [{
								label: 'Kunjungan',
								data: views,
								borderColor: '#007bff',
								backgroundColor: 'rgba(0, 123, 255, 0.1)',
								tension: 0.4,
								fill: true,
								pointBackgroundColor: '#007bff',
								pointBorderColor: '#ffffff',
								pointBorderWidth: 2,
								pointRadius: 4
							}]
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							scales: {
								y: {
									beginAtZero: true,
									ticks: {
										stepSize: 1
									}
								},
								x: {
									ticks: {
										maxTicksLimit: 15,
										autoSkip: false
									}
								}
							},
							plugins: {
								legend: {
									display: false
								},
								tooltip: {
									mode: 'index',
									intersect: false,
									callbacks: {
										title: function(context) {
											return 'Tanggal: ' + context[0].label;
										},
										label: function(context) {
											return 'Kunjungan: ' + context.parsed.y;
										}
									}
								}
							},
							interaction: {
								mode: 'nearest',
								axis: 'x',
								intersect: false
							}
						}
					});

					// Auto scroll to the end (most recent data)
					setTimeout(function() {
						if (chartContainer) {
							chartContainer.scrollLeft = chartContainer.scrollWidth;
						}
					}, 100);
				}
			} else {
				// Show message if no data
				var ctx = document.getElementById('pageViewsChart');
				if (ctx) {
					ctx.getContext('2d').fillStyle = '#6c757d';
					ctx.getContext('2d').font = '14px Arial';
					ctx.getContext('2d').textAlign = 'center';
					ctx.getContext('2d').fillText('Belum ada data kunjungan', ctx.width / 2, ctx.height / 2);
				}
			}
		}

		// expose for external callers
		window.initChart = initChart;

		// Initialize with default data (map to {label, views})
		var initialChartData = (dailyViewsData || []).map(function (item) {
			var d = new Date(item.date);
			var label = isNaN(d.getTime()) ? (item.date || '') : d.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
			return { label: label, views: parseInt(item.views) || 0 };
		});
		initChart(initialChartData);

		// Add smooth scrolling on hover
		if (chartContainer) {
			chartContainer.addEventListener('wheel', function(e) {
				if (e.deltaY !== 0) {
					e.preventDefault();
					chartContainer.scrollLeft += e.deltaY;
				}
			});

			// Add touch support for mobile
			var startX = 0;
			var scrollLeft = 0;

			chartContainer.addEventListener('touchstart', function(e) {
				startX = e.touches[0].pageX - chartContainer.offsetLeft;
				scrollLeft = chartContainer.scrollLeft;
			});

			chartContainer.addEventListener('touchmove', function(e) {
				e.preventDefault();
				var x = e.touches[0].pageX - chartContainer.offsetLeft;
				var walk = (x - startX) * 2;
				chartContainer.scrollLeft = scrollLeft - walk;
			});
		}
	});

	// Single unified fetch to update all visitor stats widgets
	function fetchVisitorStats(period) {
		// Activate button
		$('#visitor-period button').removeClass('btn-primary').addClass('btn-outline-primary');
		$('#visitor-period button[data-period="' + period + '"]').removeClass('btn-outline-primary').addClass('btn-primary');

		// Loading states
		$('#top-pages').html('<tr><td colspan="5" class="text-center"><div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>Memuat...</td></tr>');
		$('#referrers-list').html('<div class="text-muted">Memuat...</div>');
		$('#browsers-list').html('<div class="text-muted">Memuat...</div>');

		$.get('{{ route('admin.dashboard.visitor-stats') }}', { period: period })
			.done(function(resp) {
				if (!resp || !resp.success) throw new Error('Invalid response');

			// Totals
			$('#total-views').text((resp.totals.total_views || 0).toLocaleString());
			$('#unique-visitors').text((resp.totals.unique_visitors || 0).toLocaleString());

			// Trend chart
			var trendData = (resp.trend || []).map(function(t) { return { date: t.label, views: t.views }; });
			// Replace canvas and re-init
			var $parent = $('#pageViewsChart').parent();
			$parent.html('<canvas id="pageViewsChart" height="300" style="min-width: 800px;"></canvas>');
			initChart(trendData.map(function(d){ return { date: d.date, views: d.views }; }));
			$('#chart-title').text(period === 'today' ? 'Grafik Tren Per Jam (Hari Ini)' : 'Grafik Tren Harian');

			// Top pages
			var total = resp.totals.total_views || 1;
			var topPagesHtml = '';
			(resp.top_pages || []).forEach(function(page, index) {
				var url = page.url || page.page_url || '';
				var iconClass = 'file';
				var iconColor = 'text-secondary';
				if (url.includes('/article/')) { iconClass = 'book'; iconColor = 'text-primary'; }
				else if (url.includes('/announcements')) { iconClass = 'bell'; iconColor = 'text-info'; }
				else if (url.includes('/galleries')) { iconClass = 'image'; iconColor = 'text-warning'; }
				else if (url.includes('/pena-karsa')) { iconClass = 'edit-3'; iconColor = 'text-purple'; }
				else if (url === '/') { iconClass = 'home'; iconColor = 'text-success'; }

				var percentage = total > 0 ? ((page.views / total) * 100).toFixed(1) : 0;
				topPagesHtml += '<tr>' +
					'<td><span class="badge bg-' + (index < 3 ? 'primary' : 'secondary') + '">' + (index + 1) + '</span></td>' +
					'<td>' +
						'<div class="d-flex align-items-center">' +
							'<div class="me-2"><i data-feather="' + iconClass + '" class="icon-sm ' + iconColor + '"></i></div>' +
							'<div>' +
								'<h6 class="mb-0">' + (page.page_title || 'Halaman') + '</h6>' +
								'<small class="text-muted">' + url + '</small>' +
							'</div>' +
						'</div>' +
					'</td>' +
					'<td><span class="badge bg-primary fs-6">' + (page.views || 0).toLocaleString() + '</span></td>' +
					'<td>' +
						'<div class="progress" style="height: 8px;">' +
							'<div class="progress-bar" role="progressbar" style="width: ' + percentage + '%" aria-valuenow="' + percentage + '" aria-valuemin="0" aria-valuemax="100"></div>' +
						'</div>' +
						'<small class="text-muted">' + percentage + '%</small>' +
					'</td>' +
					'<td>' +
						'<span class="badge bg-' + (index < 3 ? 'success' : 'secondary') + '">' +
							(index < 3 ? '<i data-feather="trending-up" class="icon-sm me-1"></i>Hot' : 'Stable') +
						'</span>' +
					'</td>' +
				'</tr>';
			});
			if (!topPagesHtml) topPagesHtml = '<tr><td colspan="5" class="text-center text-muted">Belum ada data</td></tr>';
			$('#top-pages').html(topPagesHtml);
			feather.replace();

			// Referrers
			var refHtml = '';
			(resp.referrers || []).forEach(function(r){
				refHtml += '<div class="d-flex justify-content-between align-items-center mb-2">' +
					'<span class="text-truncate" style="max-width:70%">' + (r.referer || '-') + '</span>' +
					'<span class="badge bg-secondary">' + (r.views || 0).toLocaleString() + '</span>' +
				'</div>';
			});
			$('#referrers-list').html(refHtml || '<div class="text-muted">Belum ada data</div>');

			// Browsers
			var brHtml = '';
			if (resp.browsers) {
				Object.keys(resp.browsers).forEach(function(name){
					brHtml += '<div class="d-flex justify-content-between align-items-center mb-2">' +
						'<span>' + name + '</span>' +
						'<span class="badge bg-secondary">' + (resp.browsers[name] || 0).toLocaleString() + '</span>' +
					'</div>';
				});
			}
			$('#browsers-list').html(brHtml || '<div class="text-muted">Belum ada data</div>');
			})
			.fail(function() {
				$('#top-pages').html('<tr><td colspan="5" class="text-center text-danger">Gagal memuat data</td></tr>');
				$('#referrers-list').html('<div class="text-danger">Gagal memuat data</div>');
				$('#browsers-list').html('<div class="text-danger">Gagal memuat data</div>');
			});
	}

	// Bind top unified filter
	$(document).on('click', '#visitor-period button', function(){
		var period = $(this).data('period');
		fetchVisitorStats(period);
	});

	// Initial load using default 'month'
	$(function(){ fetchVisitorStats('month'); });
</script>
@endpush
