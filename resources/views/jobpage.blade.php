<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/job.css') }}" rel="stylesheet">
    <title>{{ $job->getTitle() }} Page</title>
</head>
<body>
@include('layouts.header')
<div class="jobContainer">
    <label class="jobLabel">Company: {{ $job->getCompany() }}</label>
    <label class="jobLabel">Job Title: {{ $job->getTitle() }}</label>
    <div class="descContainter">
        <label class="jobLabel">Description: </label>
        <p class="jobDescription">{{ $job->getDescription() }}</p>
    </div>
    <a href="#apply" class="applyBtn">Apply</a>
</div>
@include('layouts.footer')
</body>
</html>
