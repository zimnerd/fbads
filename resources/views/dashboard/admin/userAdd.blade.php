@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <h1>{{ __('Register') }}</h1>
                        <p class="text-muted">Create your account</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                          <span class="input-group-text">
                            <svg class="c-icon">
                              <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                            </svg>
                          </span>
                            </div>
                            <input class="form-control  @error('name') is-invalid @enderror" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                          <span class="input-group-text">
                            <svg class="c-icon">
                              <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-envelope-open"></use>
                            </svg>
                          </span>
                            </div>
                            <input class="form-control  @error('email') is-invalid @enderror" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                          <span class="input-group-text">
                            <svg class="c-icon">
                              <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                            </svg>
                          </span>
                            </div>
                            <input class="form-control   @error('password') is-invalid @enderror" type="password" placeholder="{{ __('Password') }}" name="password" required>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                          <span class="input-group-text">
                            <svg class="c-icon">
                              <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                            </svg>
                          </span>
                            </div>
                            <input class="form-control" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                          <span class="input-group-text">
                            <svg class="c-icon">
                              <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-people"></use>
                            </svg>
                          </span>
                            </div>
                            <input class="form-control   @error('organisation') is-invalid @enderror" type="text" placeholder="{{ __('Organisation name') }}" name="organisation" required>
                            @error('organisation')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror</div>


                        <button class="btn btn-block btn-success" type="submit">{{ __('Register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')

@endsection

