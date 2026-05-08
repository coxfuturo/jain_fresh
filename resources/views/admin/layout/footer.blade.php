<footer class="admin-footer mt-auto py-3 bg-white border-top">
    <div class="container-fluid px-4">
        <div class="row align-items-center justify-content-between g-3">
            <div class="col-12 col-md-auto text-center text-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                    <span class="text-muted small">&copy; {{ date('Y') }}</span>
                    <span class="fw-bold text-dark small">{{ config('app.name', 'Zain Fresh') }}</span>
                    <span class="badge bg-primary bg-opacity-10 text-primary extra-small rounded-pill">v1.0.0</span>
                </div>
            </div>
            
            <div class="col-12 col-md-auto">
                <ul class="nav justify-content-center justify-content-md-end gap-3">
                    <li class="nav-item">
                        <a href="#" class="nav-link p-0 text-muted small hover-primary transition-all">Support</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link p-0 text-muted small hover-primary transition-all">Documentation</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link p-0 text-muted small hover-primary transition-all">Privacy</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
