@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('success') }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{ session('danger') }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{ session('warning') }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif