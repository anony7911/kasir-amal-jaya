<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ url('/') }}/assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/themify-icons.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/metisMenu.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/typography.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/default-css.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/styles.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="{{ url('/') }}/assets/js/vendor/modernizr-2.8.3.min.js"></script>
