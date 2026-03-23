<?php 
try {
  $i_lost = $conn->query("SELECT count(id) from item_list where status = 1")->fetch_row()[0];
  $i_found = $conn->query("SELECT count(id) from item_list where status = 2")->fetch_row()[0];
  $p_claims = $conn->query("SELECT count(id) from claims where status = 0")->fetch_row()[0];
  $r_claims = $conn->query("SELECT count(id) from claims where status = 1")->fetch_row()[0];
  $t_users = $conn->query("SELECT count(id) from users where type = 2")->fetch_row()[0];
} catch (Exception $e) {}
?>
<div class="row">
    <!-- Active Lost Items -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card sales-card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold">Active Lost</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger text-white me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="ri-file-search-line"></i>
                    </div>
                    <div class="ps-3"><h2 class="fw-bold mb-0"><?= $i_lost ?? 0 ?></h2></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Active Found Items -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card revenue-card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold">Active Found</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success text-white me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="ri-search-eye-line"></i>
                    </div>
                    <div class="ps-3"><h2 class="fw-bold mb-0"><?= $i_found ?? 0 ?></h2></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Claims -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card customers-card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold">Pending Claims</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning text-dark me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="ri-shield-check-line"></i>
                    </div>
                    <div class="ps-3"><h2 class="fw-bold mb-0"><?= $p_claims ?? 0 ?></h2></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Registered Users -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card customers-card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold">Total Users</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-white me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="ri-group-line"></i>
                    </div>
                    <div class="ps-3"><h2 class="fw-bold mb-0"><?= $t_users ?? 0 ?></h2></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body pt-4">
                <h5 class="card-title fw-bold mb-4">System Overview Chart</h5>
                <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#trafficChart")).setOption({
                      tooltip: { trigger: 'item' },
                      legend: { top: '5%', left: 'center' },
                      series: [{
                        name: 'Reports', type: 'pie', radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: { borderRadius: 10, borderColor: '#fff', borderWidth: 2 },
                        label: { show: false, position: 'center' },
                        emphasis: { label: { show: true, fontSize: '18', fontWeight: 'bold' } },
                        labelLine: { show: false },
                        data: [
                          { value: <?= $i_lost ?? 0 ?>, name: 'Lost Items' },
                          { value: <?= $i_found ?? 0 ?>, name: 'Found Items' },
                          { value: <?= $r_claims ?? 0 ?>, name: 'Resolved Claims' }
                        ]
                      }]
                    });
                  });
                </script>
            </div>
        </div>
    </div>
</div>