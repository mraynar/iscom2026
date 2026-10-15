<!-- Komponen Modular Alerts Bootstrap 5.3 (SaaS Style) -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
        <i class="bi bi-check-circle-fill fs-5 me-2 flex-shrink-0 text-success"></i>
        <div class="fw-medium flex-grow-1">{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-5 me-2 flex-shrink-0 text-danger"></i>
        <div class="fw-medium flex-grow-1">{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-5 me-2 flex-shrink-0 text-danger"></i>
        <div class="fw-medium flex-grow-1">
            @if($errors->count() === 1)
                {{ $errors->first() }}
            @else
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
