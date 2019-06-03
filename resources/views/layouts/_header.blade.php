<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <title> @yield('title') | Promentee</title>


    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">

    <!-- Dashboard Core -->
    @if(app()->getLocale() == 'ar')
        <link href="{{asset('design')}}/assets/css/dashboard.rtl.css" rel="stylesheet" />
    @else
        <link href="{{asset('design')}}/assets/css/dashboard.css" rel="stylesheet" />
        <style>
            *, body{
                font-family: 'Kanit', sans-serif;
            }
        </style>
    @endif
    <link rel="stylesheet" href="/css/app.css"/>

    @routes
</head>
