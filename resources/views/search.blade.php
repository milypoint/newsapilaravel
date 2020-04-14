<?php
if (!isset($language)) {
    $language = '';
}
if (!isset($languages)) {
    $languages = ['ar', 'de', 'en', 'es', 'fr', 'he', 'it', 'nl', 'no', 'pt', 'ru', 'se', 'ud', 'zh'];
}
?>
<!doctype html>
<html>
<head>
	<title>Search news</title>
    <script type="text/javascript" src="{{ URL::asset('js/live_request.js') }}"></script>
</head>
<body>
<div>
	<form id="input_form" method="get" action="">
		<input id="input_field" required type="text" name="q" value="{{$q ?? ''}}">
		Language
		<select id="input_lang" name="language">
			<option selected value='all'>all</option>
            @foreach ($languages as $_language)
                <option {{($_language==$language)?'selected':''}} value="{{$_language}}">{{$_language}}</option>
            @endforeach
		</select>
{{--		<button type="submit">Search</button>--}}
	</form>
</div>
<div id="result"></div>
</body>
</html>
