@if ($parent->hasVerifiedEmail())
    {{ $parent->email_verified_at->format('Y-m-d h:i A') }}
@else
    <i class="fas fa-times fa-lg text-danger"></i>
@endif
