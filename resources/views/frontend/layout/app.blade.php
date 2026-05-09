<!DOCTYPE html>
<html lang="en">
	<head>
		<title>@yield('title') - Portal Siswa LMS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="{{ URL::to('assets/media/logos/lms.png') }}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="{{ URL::to('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ URL::to('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        @stack('stylesheets')
        <style>
            .student-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .card-premium {
                border: none;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            }
        </style>
	</head>
	<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true" class="app-default">
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!-- Header -->
				<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-sticky">
					<div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
						<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
							<a href="{{ route('student.dashboard') }}">
								<img alt="Logo" src="{{ URL::to('assets/media/logos/lms.png') }}" class="h-30px h-lg-40px" />
							</a>
						</div>
						<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
							<div class="app-header-menu app-header-mobile-drawer align-items-stretch">
                                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0">
                                    <div class="menu-item me-0 me-lg-2">
                                        <a href="{{ route('student.dashboard') }}" class="menu-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                                            <span class="menu-title">Dashboard</span>
                                        </a>
                                    </div>
                                    <div class="menu-item me-0 me-lg-2">
                                        <a href="{{ route('learning-modules.index') }}" class="menu-link {{ request()->routeIs('learning-modules.*') ? 'active' : '' }}">
                                            <span class="menu-title">Materi Belajar</span>
                                        </a>
                                    </div>
                                    <div class="menu-item me-0 me-lg-2">
                                        <a href="{{ route('assignments.index') }}" class="menu-link {{ request()->routeIs('assignments.*') ? 'active' : '' }}">
                                            <span class="menu-title">Tugas Saya</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
							<div class="app-navbar flex-shrink-0">
								<div class="app-navbar-item ms-1 ms-md-4">
									<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
										<i class="ki-outline ki-user fs-2"></i>
									</div>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="{{ URL::to('assets/media/avatars/300-1.jpg') }}" />
												</div>
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}</div>
													<a href="#" class="fw-semibold text-muted text-hover-primary fs-7 text-uppercase">{{ auth()->user()->getRoleNames()->first() }}</a>
												</div>
											</div>
										</div>
										<div class="separator my-2"></div>
										<div class="menu-item px-5">
											<form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-link menu-link px-5 w-100 text-start">Sign Out</button>
                                            </form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Content -->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<div class="d-flex flex-column flex-column-fluid">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="{{ URL::to('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ URL::to('assets/js/scripts.bundle.js') }}"></script>
        @stack('scripts')
	</body>
</html>
