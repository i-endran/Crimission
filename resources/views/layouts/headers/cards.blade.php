<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Complaints</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $postCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{ $postRatio > 10.0 ? 'success':'danger'}} mr-2"><i class="fa fa-arrow-{{ $postRatio > 10.0 ? 'up':'down'}}"></i> {{ $postRatio }}%</span>
                                <span class="text-nowrap">Since last week</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Verifications</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $verificationCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{ $verificationRatio > 10.0 ? 'success':'danger'}} mr-2"><i class="fas fa-arrow-{{ $verificationRatio > 10.0 ? 'up':'down'}}"></i> {{ $verificationRatio }}%</span>
                                <span class="text-nowrap">Since last week</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Verdict</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $verdictCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{ $verdictRatio > 10.0 ? 'success':'danger'}} mr-2"><i class="fas fa-arrow-{{ $verdictRatio > 10.0 ? 'up':'down'}}"></i> {{ $verdictRatio }}%</span>
                                <span class="text-nowrap">Since begining</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Community</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $communityCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{ $communityRatio > 10.0 ? 'success':'danger'}} mr-2"><i class="fas fa-arrow-{{ $communityRatio > 10.0 ? 'up':'down'}}"></i> {{ $communityRatio }}%</span>
                                <span class="text-nowrap">Since last year</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>