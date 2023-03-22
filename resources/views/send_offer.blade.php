<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="@lang('miscellaneous.keywords')" name="keywords">
        <meta content="" name="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/img/favicon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">

        <!-- JavaScript Libraries -->
        <script src="{{ asset('assets/addons/custom/jquery/js/jquery.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('<form method="POST" action="https://cardpayment.flexpay.cd/v1/pay">' 
                        +'<input type="text" name="authorization" value=" ' + {{ request()->get('authorization') }} +'">'
                        +'<input type="text" name="merchant" value=" ' + {{ request()->get('merchant') }} +'">'
                        +'<input type="text" name="reference" value=" ' + {{ request()->get('reference') }} +'">'
                        +'<input type="text" name="amount" value=" ' + {{ request()->get('amount') }} +'">'
                        +'<input type="text" name="currency" value=" ' + {{ request()->get('currency') }} +'">'
                        +'<input type="text" name="description" value=" ' + {{ request()->get('description') }} +'">'
                        +'<input type="text" name="callback_url" value=" ' + {{ request()->get('callback_url') }} +'">'
                        +'<input type="text" name="approve_url" value=" ' + {{ request()->get('approve_url') }} +'">'
                        +'<input type="text" name="cancel_url" value=" ' + {{ request()->get('cancel_url') }} +'">'
                        +'<input type="text" name="decline_url" value=" ' + {{ request()->get('decline_url') }} +'">'
                    +'</form>').appendTo('body').submit();
            });
        </script>

        <title>@lang('miscellaneous.bank_transaction_description')</title>
    </head>

    <body>
    </body>
</html>
