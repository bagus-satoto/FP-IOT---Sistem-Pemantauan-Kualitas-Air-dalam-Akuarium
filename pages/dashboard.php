<div class="row">
    <div class="col-md-4">
    <div class="small-box bg-info">
        <div class="inner">
        <h3 id="ph-value">0</h3>
        <p>Nilai pH</p>
        </div>
        <div class="icon">
        <i class="fas fa-eye-dropper"></i>
        </div>
    </div>
    </div>

    <div class="col-md-4">
    <div class="small-box bg-info">
        <div class="inner">
        <h3 id="tds-value">0</h3>
        <p>Nilai TDS</p>
        </div>
        <div class="icon">
        <i class="fas fa-water"></i>
        </div>
    </div>
    </div>

    <div class="col-md-4">
    <div id="water-quality-box" class="small-box bg-warning">
        <div class="inner">
        <h3 id="water-quality">-</h3>
        <p id="quality-detail">-</p>
        </div>
        <div class="icon">
        <i class="fas fa-seedling"></i>
        </div>
    </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
    <!-- Line chart -->
    <div class="card card-primary card-outline">
        <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            pH Air
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body">
        <div id="line-chart-ph" style="height: 300px;"></div>
        </div>
        <!-- /.card-body-->
    </div>
    <!-- /.card -->
    </div>

    <div class="col-md-6">
    <!-- Line chart -->
    <div class="card card-primary card-outline">
        <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            TDS Air
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body">
        <div id="line-chart-tds" style="height: 300px;"></div>
        </div>
        <!-- /.card-body-->
    </div>
    <!-- /.card -->
    </div>
</div>