@extends('frontend.layouts.master')
@section('title','İletişim')
@section('bg','https://zerdasoftware.com/wp-content/uploads/2023/01/android_c.jpg')
@section('content')
    <div class="col-md-10 col-lg-8 col-xl-7">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p>Bizimle iletişime geçebilirsiniz</p>
            <div class="my-5">
                <form method="post" action="{{route('contact.post')}}">
                    @csrf
                    <div class="form-floating">
                        <input class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="Ad Soyad Girin..." required />
                        <label for="name">Ad Soyad</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">Bir isim gerekli.</div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="E-posta girin..." required />
                        <label for="email">E-posta Adresi</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">Bir e-posta gerekli.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">E-posta geçerli değil.</div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" name="phone" value="{{old('phone')}}" type="tel" placeholder="Telefon numaranızı girin..." required />
                        <label for="phone">Telefon Numarası</label>
                        <div class="invalid-feedback" data-sb-feedback="phone:required">Bir telefon numarası gerekli.</div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="message"  value="{{old('message')}}" placeholder="Mesajınızı buraya girin..." style="height: 12rem" required></textarea>
                        <label for="message">Mesaj</label>
                        <div class="invalid-feedback" data-sb-feedback="message:required">Bir mesaj gerekli.</div>
                    </div>
                    <br />

                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Form gönderimi başarılı!</div>
                        </div>
                    </div>

                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Mesaj gönderirken hata oluştu!</div></div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>
                </form>
            </div>
    </div>
@endsection
