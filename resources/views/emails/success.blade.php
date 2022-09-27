<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="{{ asset('/bootstrap-rtl.min.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400&display=swap" rel="stylesheet">
        <style>
            body {
                font-family:  'Cairo', sans-serif;
                background-color: #f2fcfc;
                min-height: 100vh;
            }
            [type=email], [type=file], [type=number], [type=password], [type=tel], [type=url], code, samp, var {
                direction: rtl !important;
                text-align: right !important;
            }
        </style>
    @else
        <link rel="stylesheet" href="{{ asset('/bootstrap.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type='text/css'>
        <style>
            body {
                font-family: 'Raleway';
                background-color: #f2fcfc;
                min-height: 100vh;
            }
        </style>
    @endif
    <link href="{{ asset('/jquerysctipttop.css')}}" rel="stylesheet" type="text/css">
    <title>Seller verification</title>
    <style type="text/css">
        #map{
            height: 500px;
            margin-bottom: 30px;
        }
        .not-allowed {
            cursor: not-allowed;
        }
        .show_change_phone {
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
        }
        .border-left {
            border-left:1px solid #777
        }
        .border-right {
            border-right:1px solid #777
        }
        .border-top {
            border-top:1px solid #777
        }
        .card-header {
            background-color: rgb(233 255 255);
        }
        .card-body {
            background: #fbffff;
        }
        label {
            font-size: 13px;
        }
        .container {
            margin: 30px auto;
        }

        .tab-pane {
            padding: 10px 0;
        }
        .custom-map-control-button:hover {
            background: #dedede;
        }
        .custom-map-control-button
        {
            background: #fff;
            border: none;
            padding: 13px;
            font-size: 14px;
            margin-top: 10px;
            cursor: pointer;
        }
        a:hover {
            color: #0f7864;
        }
        a {
            color: #18BC9C;
        }
    </style>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var page_data = {!! pageJsonData() !!};
        /* ]]> */
    </script>
</head>
<body>

    <div style="background: #3cd0cc;
    height: 73px;
    padding: 13px;
    text-align: center;
    font-size: 33px;
    font-weight: 900;
    color: #fff;">

        {{ __('auth.kushkatna') }}

        @if (App::isLocale('ar'))
            <a href="{{ route('lang', 'en') }}" class="btn btn-md" style="    color: #000;font-weight: 600;">{{ __('auth.en') }}</a>
        @else
            <a href="{{ route('lang', 'ar') }}" class="btn btn-md" style="    color: #000;font-weight: 600;">{{ __('auth.ar') }}</a>
        @endif

    </div>

<div class="container">


    <h3 style="margin-bottom: 30px"> {{ __('auth.Welcome') }} <span style="color: red" >{{ $seller->name }}</span> {{ __('auth.title') }} </h3>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info"
               aria-selected="true">{{ __('auth.info') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="Documents-tab" data-toggle="tab" href="#Documents" role="tab"
               aria-controls="Documents" aria-selected="false">{{ __('auth.Documents') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="Store-tab" data-toggle="tab" href="#Store" role="tab" aria-controls="Store"
               aria-selected="false">{{ __('auth.Store') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="Shipping-tab" data-toggle="tab" href="#Shipping" role="tab" aria-controls="Shipping"
               aria-selected="false">{{ __('auth.Shipping') }}</a>
        </li>
    </ul>

    @if ( isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data" action="{{ route('SellerInfoPpst') }}">
        @csrf
        <input type="hidden" id="seller_id" seller_id="{{ $seller->id }}" value="{{ $seller->id }}" name="id">

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                <h1 style="margin: 18px 0 33px 0;">
                    {{ __('auth.Personal_information') }}
                </h1>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{ __('auth.name') }}</label>
                    <input type="text" class="form-control {{e_form_invalid_class('name', $errors )}}" id="exampleFormControlInput1" name="name"
                           value="{{ old('name') ? old('name') : $seller->name }}" placeholder="{{ __('auth.name') }}">
                    {!! e_form_error('name', $errors ) !!}
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{ __('auth.Email') }}</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" style="cursor: no-drop;"
                           disabled value="{{ $seller->email }}" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label  for="exampleFormControlInput1" class="form-label">
                        {{ __('auth.Avater') }} </label>
                    <input class="form-control {{e_form_invalid_class('img', $errors )}}" value="{{ old('img') ? old('img') : '' }}" name="img" id="imgUpload" type="file" />
                    {!! e_form_error('img', $errors ) !!}
                </div>
                <div class="mb-3">
                    <div class="row" >
                        <div class="col-md-8" >
                            <label for="exampleFormControlInput1" class="form-label">{{ __('auth.Phone') }}</label>
                            <input type="number" class="form-control {{e_form_invalid_class('phone', $errors )}}" name="phone" id="phone" value="{{  old('phone') ? old('phone') : $seller->phone }}"
                                   placeholder="9710121156546">
                            {!! e_form_error('phone', $errors ) !!}
                                <div style="display: none" class="phone-msg alert" ></div>
                        </div>
                        <div class="col-md-4" >
                            <button type="button" style="margin-top: 2em;display: none;"  class="change_phone_btn btn btn-primary" >{{ __('auth.update') }}</button>
                        </div>
                    </div>

                </div>
                <div class="mb-3">
                    <div class="row" >
                        @if($seller->phone_verification_staus == 0)
                            <div class="col-md-8" >
                                <label for="exampleFormControlInput1" class="form-label phone_verification-label">{{ __('auth.Code') }}</label>
                                <input type="number" class="form-control {{e_form_invalid_class('phone_verification', $errors )}}" id="phone_verification_code" name="phone_verification"
                                       placeholder="1234">
                                {!! e_form_error('phone_verification', $errors ) !!}
                                <div style="display: none" class="msg">
                                    <div class="alert-msg alert" ></div>
                                    <div class="to_check" >
                                        {{ __('auth.to_check') }}
                                        <span class="show_change_phone" >{{ __('auth.click_her') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <button type="button" style="margin-top: 2em;" id="phone_verification_btn"  class="btn btn-primary" >{{ __('auth.verify') }}</button>
                            </div>
                        @else
                            <div class="col-md-8" >
                                <div class="alert-msg alert alert-success" >{{ __('auth.CodeSuccess') }}</div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="Documents" role="tabpanel" aria-labelledby="Documents-tab">
                <h1 style="margin: 18px 0 33px 0;">
                    {{ __('auth.Documents') }}
                </h1>
                <div class="row">

                    <div class="col-md-6 mb-4" >
                        <div class="card" >
                            <div class="card-header text-center">{{ __('auth.Bank_account') }}</div>
                            <div class="card-body">

                                <div class="row" >
                                    <div class="col-6 {{ app()->getLocale() == 'ar' ? 'border-left' : 'border-right' }}" >
                                        <div class="mb-3">
                                            <label for="Bank_account_number" class="form-label">{{ __('auth.Bank_account_number') }}</label>
                                            <input type="number" class="form-control {{e_form_invalid_class('Bank_account_number', $errors )}}" id="Bank_account_number" name="Bank_account_number"
                                                   value="{{ old('Bank_account_number') ? old('Bank_account_number') : '' }}" placeholder="{{ __('auth.Bank_account_number') }}">
                                            {!! e_form_error('Bank_account_number', $errors ) !!}
                                        </div>
                                        <div class="mb-3">
                                            <label for="IBAN" class="form-label">{{ __('auth.IBAN') }}</label>
                                            <input type="number" class="form-control {{e_form_invalid_class('IBAN', $errors )}}" id="IBAN" name="IBAN"
                                                   value="{{ old('IBAN') ? old('IBAN') : '' }}" placeholder="{{ __('auth.IBAN') }}">
                                            {!! e_form_error('IBAN', $errors ) !!}
                                        </div>
                                    </div>
                                    <div class="col-6 " >
                                        <div class="mb-3">
                                            <label for="Certificate_of_account_number" class="form-label">
                                                {{ __('auth.Certificate_of_account_number') }} </label>
                                            <input class="form-control {{e_form_invalid_class('Certificate_of_account_number', $errors )}}" value="{{ old('Certificate_of_account_number') ? old('Certificate_of_account_number') : '' }}" name="Certificate_of_account_number" type="file" />
                                            {!! e_form_error('Certificate_of_account_number', $errors ) !!}
                                        </div>
                                        <div class="mb-3">
                                            <label for="IBAN_certificate" class="form-label">
                                                {{ __('auth.IBAN_certificate') }} </label>
                                            <input class="form-control {{e_form_invalid_class('IBAN_certificate', $errors )}}" value="{{ old('IBAN_certificate') ? old('IBAN_certificate') : '' }}" name="IBAN_certificate" type="file" />
                                            {!! e_form_error('IBAN_certificate', $errors ) !!}
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4" >
                        <div class="card" >
                            <div class="card-header text-center">{{ __('auth.Commercial') }}</div>
                            <div class="card-body">

                                <div class="row" >
                                    <div class="col-6 {{ app()->getLocale() == 'ar' ? 'border-left' : 'border-right' }}" >
                                        <div class="mb-3">
                                            <label for="Release_Date" class="form-label">{{ __('auth.Release_Date') }}</label>
                                            <input type="text" class="form-control {{e_form_invalid_class('liciense_release_date', $errors )}}" id="Release_Date" name="liciense_release_date"
                                                   value="{{ old('liciense_release_date') ? old('liciense_release_date') : '' }}" placeholder="{{ __('auth.Release_Date') }}">
                                            {!! e_form_error('liciense_release_date', $errors ) !!}
                                        </div>
                                        <div class="mb-3">
                                            <label for="Expiry_date" class="form-label">{{ __('auth.Expiry_date') }}</label>
                                            <input type="text" class="form-control {{e_form_invalid_class('liciense_expiry_date', $errors )}}" id="Expiry_date" name="liciense_expiry_date"
                                                   value="{{ old('liciense_expiry_date') ? old('liciense_expiry_date') : '' }}" placeholder="{{ __('auth.Expiry_date') }}">
                                            {!! e_form_error('liciense_expiry_date  ', $errors ) !!}
                                        </div>
                                    </div>
                                    <div class="col-6 " >
                                        <div class="mb-3">
                                            <label for="liciense" class="form-label">
                                                {{ __('auth.liciense') }} </label>
                                            <input class="form-control {{e_form_invalid_class('liciense', $errors )}}" value="{{ old('liciense') ? old('liciense') : '' }}" name="liciense" type="file" />
                                            {!! e_form_error('liciense', $errors ) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>



                    <div class="col-md-6 mb-4" >
                        <div class="card" >
                            <div class="card-header text-center">{{ __('auth.identification') }}</div>
                            <div class="card-body">

                                <div class="row" >
                                    <div class="col-6 {{ app()->getLocale() == 'ar' ? 'border-left' : 'border-right' }}" >
                                        <div class="mb-3">
                                            <label for="Release_Date" class="form-label">{{ __('auth.Release_Date') }}</label>
                                            <input type="text" class="form-control {{e_form_invalid_class('identification_release_date', $errors )}}" id="Release_Date" name="identification_release_date"
                                                   value="{{ old('identification_release_date') ? old('identification_release_date') : '' }}" placeholder="{{ __('auth.Release_Date') }}">
                                            {!! e_form_error('identification_release_date', $errors ) !!}
                                        </div>
                                        <div class="mb-3">
                                            <label for="Expiry_date" class="form-label">{{ __('auth.Expiry_date') }}</label>
                                            <input type="text" class="form-control {{e_form_invalid_class('identification_expiry_date', $errors )}}" id="Expiry_date" name="identification_expiry_date"
                                                   value="{{ old('identification_expiry_date') ? old('identification_expiry_date') : '' }}" placeholder="{{ __('auth.Expiry_date') }}">
                                            {!! e_form_error('identification_expiry_date', $errors ) !!}
                                        </div>
                                    </div>
                                    <div class="col-6 " >
                                        <div class="mb-3">
                                            <label for="the_front_id_photo" class="form-label">
                                                {{ __('auth.The_front_ID_photo') }} </label>
                                            <input class="form-control {{e_form_invalid_class('the_front_id_photo', $errors )}}" value="{{ old('the_front_id_photo') ? old('the_front_id_photo') : '' }}" name="the_front_id_photo" type="file" />
                                            {!! e_form_error('the_front_id_photo', $errors ) !!}
                                        </div>
                                        <div class="mb-3">
                                            <label for="The_back_ID_photo" class="form-label">
                                                {{ __('auth.The_back_ID_photo') }} </label>
                                            <input class="form-control {{e_form_invalid_class('the_back_id_photo', $errors )}}" value="{{ old('the_back_id_photo') ? old('the_back_id_photo') : '' }}" name="the_back_id_photo" type="file" />
                                            {!! e_form_error('the_back_id_photo', $errors ) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="Store" role="tabpanel" aria-labelledby="Store-tab">
                <h1 style="margin: 18px 0 33px 0;">
                    {{ __('auth.Store_information') }}
                </h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <textarea class="form-control {{e_form_invalid_class('store_desc_ar', $errors )}}" name="store_desc_ar" placeholder="{{ __('auth.store_desc_ar_place') }}"
                                      id="floatingTextarea2" style="height: 130px">{{ old('store_desc_ar') }}</textarea>
                            {!! e_form_error('store_desc_ar', $errors ) !!}
                            <label style="font-size: 12px;" for="floatingTextarea2">{{ __('auth.store_desc_ar_hint') }}</label>
                        </div>
                        <br>
                        <input name="banner_img" value="{{ old('banner_img') ? old('banner_img') : '' }}" class="form-control {{e_form_invalid_class('banner_img', $errors )}}" type="file" />
                        {!! e_form_error('banner_img', $errors ) !!}
                        <label style="font-size: 12px;" for="exampleFormControlInput1" class="form-label"> {{ __('auth.banner_img') }} (400 * 200) apx </label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <textarea class="form-control {{e_form_invalid_class('store_desc_en', $errors )}}" name="store_desc_en" placeholder="{{ __('auth.store_desc_en_place') }}"
                                      id="floatingTextarea2" style="height: 130px">{{ old('store_desc_en') }}</textarea>
                            {!! e_form_error('store_desc_en', $errors ) !!}
                            <label style="font-size: 12px;" for="floatingTextarea2"> {{ __('auth.store_desc_en_hint') }} </label>
                        </div>
                        <br>
                        <input name="logo" value="{{ old('logo') ? old('logo') : '' }}" class="form-control {{e_form_invalid_class('logo', $errors )}}" type="file" />
                        {!! e_form_error('logo', $errors ) !!}
                        <label style="font-size: 12px;" for="exampleFormControlInput1" class="form-label"> {{ __('auth.logo') }} (100 * 100) px </label>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="Shipping" role="tabpanel" aria-labelledby="Shipping-tab">
                <h1 style="margin: 18px 0 33px 0;">
                    {{ __('auth.Shipping_Addres') }}
                </h1>

                <label for="exampleInputEmail1">{{ __('auth.Emirates') }}</label>
                <select name="cite" id="cite" class="custom-select mb-3 {{e_form_invalid_class('cite', $errors )}}" >
                    <option selected>{{ __('auth.select_city') }}</option>
                    @foreach($cities as $city)
                        <option cityName="{{ $city['city_name'] }}" value="{{ $city['id'] }}">{{ $city['city_name'] }}</option>
                    @endforeach
                </select>
                {!! e_form_error('cite', $errors ) !!}

                <label for="exampleInputEmail1">{{ __('auth.Area') }}</label>
                <select name="block" class="custom-select mb-3 state_options {{e_form_invalid_class('block', $errors )}}" >
                    <option selected>{{ __('auth.select_Area') }}</option>
                </select>
                {!! e_form_error('block', $errors ) !!}

                <h1 class="tstt">{{ __('auth.select_location') }}</h1>
                <p class="tstt">{{ __('auth.click_location') }}</p>

                <!--map div-->
                <div id="map"></div>

                <input type="hidden" name="latLng" class="saveSellerLocation">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('auth.Build_number') }}</label>
                            <input type="number" value="{{ old('Buildnumber') ? old('Buildnumber') : '' }}"  name="Buildnumber" class="form-control {{e_form_invalid_class('Buildnumber', $errors )}}" id="Buildnumber"
                                   aria-describedby="emailHelp">
                            {!! e_form_error('Buildnumber', $errors ) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('auth.street_number') }}</label>
                            <input type="number" value="{{ old('unitNumber') ? old('unitNumber') : '' }}"  name="unitNumber" class="form-control {{e_form_invalid_class('unitNumber', $errors )}}"  id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                            {!! e_form_error('unitNumber', $errors ) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('auth.flate_Number') }}</label>
                            <input type="number" value="{{ old('flateNumber') ? old('flateNumber') : '' }}"  name="flateNumber" class="form-control {{e_form_invalid_class('flateNumber', $errors )}}"  id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                            {!! e_form_error('flateNumber', $errors ) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" {{ $seller->phone_verification_staus == 0 ? 'disabled' : ''  }} class="btn btn-primary not-allowed submit">{{ __('auth.Submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div style="margin-top: 50px;">
        <button class="prevtab btn btn-primary" style="color: #fff;
    background-color: #2C3E50;
    border-color: #2C3E50;border-color:#2C3E50" >{{ __('auth.Prev') }}</button>
        <button class="nexttab btn btn-danger" style="background: rgb(207, 109, 168);border-color: rgb(207, 109, 168);">{{ __('auth.Next') }}</button>
    </div>


</div>
    <!-- /.container -->


<!-- Optional JavaScript -->
{{--<!-- jQuery first, then Popper.js, then Bootstrap JS -->--}}
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"--}}
{{--        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"--}}
{{--        crossorigin="anonymous"></script>--}}
<script src="{{ asset('/jquery-3.5.1.js')}}"></script>
<script src="{{ asset('/jquery.min.js')}}"></script>
<script src="{{ asset('/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp7Zo5o0AkU16Xhug5rw6GGYHeQH1ZbZU&libraries=places"></script>
    <script type="text/javascript" src="{{ asset('/map.js')}}"></script>

    <script type="text/javascript">
    $('#map').hide();
    $('.tstt').hide();
    /* -------------------------------------------------------------
          bootstrapTabControl
      ------------------------------------------------------------- */
    function bootstrapTabControl() {
        var i, items = $('.nav-link'), pane = $('.tab-pane');
        // next
        $('.nexttab').on('click', function () {
            for (i = 0; i < items.length; i++) {
                if ($(items[i]).hasClass('active') == true) {
                    break;
                }
            }
            if (i < items.length - 1) {
                // for tab
                $(items[i]).removeClass('active');
                $(items[i + 1]).addClass('active');
                // for pane
                $(pane[i]).removeClass('show active');
                $(pane[i + 1]).addClass('show active');
            }

            if (i >= items.length - 2) {
                $(this).hide()
            }

        });
        // Prev
        $('.prevtab').on('click', function () {
            for (i = 0; i < items.length; i++) {
                if ($(items[i]).hasClass('active') == true) {
                    break;
                }
            }
            if (i != 0) {
                // for tab
                $(items[i]).removeClass('active');
                $(items[i - 1]).addClass('active');
                // for pane
                $(pane[i]).removeClass('show active');
                $(pane[i - 1]).addClass('show active');
            }
            if (items.length - 1 == i) {
                $('.nexttab').show()
            }
        });
    }

    bootstrapTabControl();
</script>
</body>
<script type="text/javascript">

    $(document).on('change', '#cite', function () {
        // return console.log()
        var url = page_data.routes.blocks
        // initMap($("#cite option:selected").html() + ' الإمارات العربية المتحدة ');
        var newUrl  = url.replace('{id}',$(this).val())
        $.ajax({
            type : 'get',
            url : newUrl,
            success: function(data){
                $('.state_options').html(data.block_options);
            }
        });
    })
    $(document).on('click', '#phone_verification_btn', function () {
        let el = $('#phone_verification_code')
        let btn = $(this)
        var id = $('#seller_id').attr('seller_id')
        $.ajax({
            type : 'get',
            url : page_data.routes.ChekSellerPhoneVerification,
            data : {
                code: el.val(),
                id: id
            },
            success: function(data) {
                $('.msg').show()
                if (data.status){
                    el.hide()
                    btn.hide()
                    $('.phone_verification-label').hide()
                    $('.alert-msg').removeClass('alert-danger').addClass('alert-success').html(data.msg);
                    $('.submit').removeAttr('disabled').removeClass('not-allowed')
                }
                else{
                    $('.alert-msg').removeClass('alert-success').addClass('alert-danger').html(data.msg);
                }
            }
        });
    })

    $(document).on('click', '.show_change_phone', function () {
       $('.change_phone_btn').show();
        $('.msg').hide()
    })

    $(document).on('click', '.change_phone_btn', function () {
        let el = $(this)
        $.ajax({
            type : 'get',
            url : page_data.routes.UpdateSellerPhone,
            data : {
                phone: $('#phone').val(),
                id: $('#seller_id').attr('seller_id')
            },
            success: function(data) {
                $('.phone-msg').show()
                if (data.status){
                    el.hide()
                    $('.phone-msg').removeClass('alert-danger').addClass('alert-success').html(data.msg);
                }
                else{
                    $('.phone-msg').removeClass('alert-success').addClass('alert-danger').html(data.msg);
                }
            }
        });
    })

    $(document).on('change', '.state_options', function () {
        $('#map').show();
        $('.tstt').show();
        initMap( ' الإمارات العربية المتحدة ' + $("#cite option:selected").html() + ' ' + $(".state_options option:selected").html());
    })
</script>
</html>
