@extends('layouts.app')

@section('title', $pageConfigs['title'])

@section('page-style')
    {{-- page style css files --}}
@endsection

@section('content')

    <div class="pageBody">
        <section>
            <div class="container py-5">
                <p class="smallTxt mb-4">Enter your credentials to proceed</p>
                <form method="post" action="{{ route('site.quiz') }}" class="userDeatilsForm">
                    @csrf
                    <div class="form-field">
                        <label for="name">Name<span>*</span></label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" class="form-control"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="email">Email ID<span>*</span></label>
                        <input type="email" id="email" name="email" placeholder="Enter your email"
                            class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="phoneNum">Phone Number<span>*</span></label>
                        <input type="number" id="phoneNum" name="phoneNum" placeholder="Enter your phone number"
                            class="form-control" value="{{ old('phoneNum') }}" required>
                        @error('phoneNum')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <div class="checkbox-groupwrap">
                            <label class="checkbox-group">Yes, I would like to receive updates via WhatsApp'
                                <input type="checkbox" name="whatsapp_update" class="form-control"
                                    {{ old('whatsapp_update') ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <div class="checkbox-groupwrap">
                            <label class="checkbox-group">I agree to the <a
                                    href="{{ route('site.terms-and-conditions') }}">Terms and
                                    Conditions</a> & the <a href="https://timespro.com/privacy-policy">Privacy Policy</a>.
                                <input type="checkbox" name="terms_and_conditions" class="form-control"
                                    {{ old('terms_and_conditions') ? 'checked' : '' }} required>
                                <span class="checkmark"></span>
                            </label>
                        </div>

                    </div>
                    @error('sector_quiz_attemp')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="blueBtn w-100 mt-4">Proceed</button>
                </form>

            </div>
        </section>

        <section class="bottomGraphic"></section>

    </div>

@endsection

@section('page-script')
    {{-- Page js files --}}
@endsection
