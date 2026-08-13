<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - EduFlow</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/renad.css') }}">
</head>
<body>

{{-- Nav bar --}}
<nav class="navbar navbar-expand-lg sticky-top glass-navbar">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">EduFlow</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('browse.courses') }}">Browse Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#categories">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <a class="nav-link cart-link position-relative" href="{{ route('cart') }}">
          <i class="bi bi-cart3"></i>
          @if(count($cart) > 0)
            <span class="cart-badge">{{ collect($cart)->sum('qty') }}</span>
          @endif
        </a>
        <a class="nav-link loginlink" href="{{ route('login') }}">Login</a>
        <a class="btn btn-primary" href="{{ route('signup') }}">Sign Up</a>
      </div>
    </div>
  </div>
</nav>

<section class="checkout-header py-4">
  <div class="container">
    <p class="text-muted mb-0">Review your items and complete your purchase securely. Your journey to mastery begins here.</p>
  </div>
</section>

<div class="container">
  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
</div>

<section class="container pb-5">
  <div class="row g-4">

    {{-- Order summary --}}
    <div class="col-lg-7">

      @if(count($cart) === 0)
        <div class="empty-cart text-center py-5">
          <i class="bi bi-cart-x display-4 text-muted mb-3 d-block"></i>
          <h5 class="fw-bold mb-2">Your cart is empty</h5>
          <p class="text-muted mb-4">Looks like you haven't added any courses yet.</p>
          <a href="{{ route('browse.courses') }}" class="btn btn-primary-custom px-4">Browse Courses</a>
        </div>
      @else
        <div class="order-summary-header d-flex justify-content-between align-items-center mb-3">
          <span class="fw-bold"><i class="bi bi-cart3 me-2"></i>Order Summary</span>
          <span class="item-count-badge">{{ count($cart) }} Item{{ count($cart) > 1 ? 's' : '' }}</span>
        </div>

        @foreach($cart as $course_id => $item)
          <div class="cart-item d-flex gap-3 mb-3">
            <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=200&q=80' }}"
                 alt="{{ $item['title'] }}" class="cart-item-img">

            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="cart-item-category mb-1">{{ strtoupper($item['category']) }}</p>
                  <h6 class="fw-bold mb-1">{{ $item['title'] }}</h6>
                </div>
                <form method="POST" action="{{ route('cart.remove', $course_id) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="cart-remove-btn"><i class="bi bi-x-lg"></i></button>
                </form>
              </div>

              <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="text-muted small"><i class="bi bi-clock me-1"></i>{{ $item['duration'] }}</span>
                <span class="fw-bold">${{ number_format($item['price'] * $item['qty'], 2) }}</span>
              </div>
            </div>
          </div>
        @endforeach

        <div class="promo-box d-flex align-items-center gap-2 mt-4">
          <i class="bi bi-tag text-primary"></i>
          <span class="fw-semibold text-primary small">Add Promo Code</span>
          <div class="d-flex ms-auto promo-input-wrap flex-grow-1">
            <input type="text" class="form-control promo-input" placeholder="Enter code">
            <button class="promo-submit-btn"><i class="bi bi-arrow-right"></i></button>
          </div>
        </div>
      @endif
    </div>

    {{-- Payment details --}}
    @if(count($cart) > 0)
    <div class="col-lg-5">
      <div class="payment-card">
        <h5 class="fw-bold mb-4"><i class="bi bi-lock-fill text-primary me-2"></i>Payment Details</h5>

        <div class="payment-method-tabs d-flex gap-2 mb-4">
          <button type="button" class="payment-tab active" data-method="card">
            <i class="bi bi-credit-card me-1"></i> Card
          </button>
          <button type="button" class="payment-tab" data-method="paypal">
            <i class="bi bi-paypal me-1"></i> PayPal
          </button>
        </div>

        <form method="POST" action="{{ route('cart.checkout') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label small fw-semibold">CARDHOLDER NAME</label>
            <input type="text" class="form-control payment-input" placeholder="Jane Doe">
          </div>

          <div class="mb-3">
            <label class="form-label small fw-semibold">CARD NUMBER</label>
            <div class="input-icon-wrap">
              <input type="text" class="form-control payment-input" placeholder="0000 0000 0000 0000">
              <i class="bi bi-credit-card-2-front card-icon-right"></i>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-6">
              <label class="form-label small fw-semibold">EXPIRY (MM/YY)</label>
              <input type="text" class="form-control payment-input" placeholder="MM/YY">
            </div>
            <div class="col-6">
              <label class="form-label small fw-semibold">CVV</label>
              <input type="text" class="form-control payment-input" placeholder="•••">
            </div>
          </div>

          <hr class="my-4">

          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Subtotal</span>
            <span class="fw-semibold">${{ number_format($subtotal, 2) }}</span>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <span class="text-muted">Tax (5%)</span>
            <span class="fw-semibold">${{ number_format($tax, 2) }}</span>
          </div>

          <hr class="my-3">

          <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="fw-bold fs-5">Total</span>
            <span class="fw-bold fs-3 text-primary">${{ number_format($total, 2) }}</span>
          </div>

          <button type="submit" class="btn btn-primary-custom w-100 py-2">
            Confirm Purchase <i class="bi bi-arrow-right ms-1"></i>
          </button>
        </form>
      </div>
    </div>
    @endif

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>