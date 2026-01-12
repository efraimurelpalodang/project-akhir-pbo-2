<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <livewire:components.card-info
                    title="Transaksi Hari Ini"
                    :value="'Rp ' . number_format($transaksiHariIni, 0, ',', '.')"
                    color="primary"
                    icon="fas fa-calendar" />

                <livewire:components.card-info
                    title="Total Penjualan"
                    :value="'Rp ' . number_format($totalPenjualan, 0, ',', '.')"
                    color="success"
                    icon="fas fa-dollar-sign" />

                <livewire:components.card-info
                    title="Barang Restock"
                    :value="$barangRestock"
                    color="info"
                    icon="fas fa-clipboard-list" />

                <livewire:components.card-info
                    title="Pesanan Menunggu"
                    :value="$pesananMenunggu"
                    color="warning"
                    icon="fas fa-comments" />
            </div>
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Statistik Data Penjualan Mingguan</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
