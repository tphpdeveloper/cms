@if(isset($items))
    <ul class="nav">
        @foreach($items as $item)
            {{--{{ dd($item->isActive) }}--}}
            <li @lm-attrs($item) @lm-endattrs>
                @if($item->link)
                    <a @lm-attrs($item->link) @lm-endattrs
                        @if($item->hasChildren())
                            href="#{{ $item->nickname }}"
                            data-toggle="collapse"
                            aria-expanded="{{ $item->isActive }}"
                            aria-controls="{{ $item->nickname }}"
                        @else
                            href="{!! $item->url() !!}"
                        @endif
                        >


                        <i class="now-ui-icons {{ $item->icon }}"></i>
                        <p>{!! $item->title !!}</p>
                        @if($item->hasChildren())
                            <b class="caret"></b>
                        @endif
                    </a>
                @else
                    {!! $item->title !!}
                @endif
                @if($item->hasChildren())
                    <div class="collapse {{ $item->isActive ? 'show' : '' }}" id="{{ $item->nickname }}">
                        @include($prefix.'menu.build', ['items' => $item->children()])
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
@endif
