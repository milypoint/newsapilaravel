@isset($articles)
    @foreach($articles as $art)
        <h3>{{$art['title']}}</h3>
        <h4>{{$art['description']}}</h4>
        <h4><a href="{{$art['url']}}">{{$art['url']}}</a></h4>
        <br>
    @endforeach
@endisset
