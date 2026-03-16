<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance - Quizara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Quizara/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/Quizara/assets/css/maintenance.css">
</head>

<body>

    <div class="card maintenance-card border-0 rounded-5 text-center p-5 shadow-premium">
        <div class="status-badge text-dark">
            <i class="fas fa-circle"></i> System Relay Status: Maintenance
        </div>

        <div class="mb-5 position-relative d-inline-block">
            <i class="fas fa-cog fa-5x gear-icon"></i>
            <div class="tool-icon">
                <i class="fas fa-wrench"></i>
            </div>
        </div>

        <h1 class="fw-black text-dark mb-3">System Maintenance</h1>
        <p class="text-muted fw-medium px-md-4 mb-5">
            We are currently optimizing our quiz engine and refreshing core modules to serve you better. We'll be back online in briefly.
        </p>

        <div class="row g-3 d-flex justify-content-center">
            <div class="col-sm-auto">
                <a href="/Quizara/logout.php" class="btn btn-danger rounded-pill px-4 py-3 fw-bold border-opacity-25">
                    <i class="fas fa-sign-out-alt me-2"></i>Exit Portal
                </a>
            </div>
            <div class="col-sm-auto">
                <a href="#" onclick="window.location.reload()" class="btn btn-indigo rounded-pill px-5 py-3 fw-bold shadow-premium hover-scale btn-glow">
                    Re-verify Status <i class="fas fa-sync-alt ms-2 small"></i>
                </a>
            </div>
        </div>

        <div class="mt-5 pt-4 border-top border-white border-opacity-10">
            <div class="d-flex align-items-center justify-content-center text-slate-400 small fw-bold">
                <i class="fas fa-hourglass-half me-2 text-indigo-400"></i> Estimated Recovery: 60 Minutes
            </div>
        </div>
    </div>

</body>

</html>