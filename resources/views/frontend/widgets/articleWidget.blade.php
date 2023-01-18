@if(count($articles)>0)
@foreach($articles as $article)
    <!-- Featured blog post-->
    <div class="card mb-4">
        <a href="#!"><img class="card-img-top" src="{{$article->image}}" alt="..."/></a>
        <div class="card-body">
            <div class="small text-muted">
                <a class="badge bg-secondary text-decoration-none link-light"
                   href="#!">{{$article->getCategory->name}} </a>
                <span class="badge bg-info text-white"><i class="fa-solid fa-eye"></i>  {{$article->hit}}</span>
                <span style="float: right"><i class="fa-regular fa-clock"></i> {{$article->created_at->diffForHumans()}}</span>
            </div>
            <h2 class="card-title">{{$article->title}}</h2>
            <p class="card-text">{{\Illuminate\Support\Str::limit($article->contents,150)}}</p>
            <a class="btn btn-primary" href="{{route('single',[$article->getCategory->slug,$article->slug])}}">Devamını
                Oku →</a>
        </div>
    </div>
    <!-- Divider-->
    @if(!$loop->last)
        <hr class="my-4"/>
    @endif
@endforeach

{{$articles->links('vendor.pagination.custom')}}
@else
    <div class="alert alert-danger"><h4 class="text-center">Yazı bulunamadı</h4></div>
@endif
