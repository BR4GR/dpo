@extends(isset($layout) && $layout == 'raw' ? 'layouts.raw' : 'layouts.app')

@section('content')
<div class="container article">
    {!! $content !!}
</div>
@endsection