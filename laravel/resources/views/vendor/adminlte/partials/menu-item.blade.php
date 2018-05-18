@if (is_string($item))

    @if($item != 'ADMINISTRAÇÃO')
        <li class="header">{{ $item }}</li>
    @else
        @if(Auth::user()->categoria == 1)
            <li class="header">{{ $item }}</li>
        @endif
    @endif
@else
    <!-- GERENTE -->    
    @if(Auth::user()->categoria == 1)
        <li class="{{ $item['class'] }}">
            <a href="{{ $item['href'] }}"
               @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
            >
                <i class="fa fa-fw fa-{{ $item['icon'] or 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                <span>{{ $item['text'] }}</span>
                @if (isset($item['label']))
                    <span class="pull-right-container">
                        <span class="label label-{{ $item['label_color'] or 'primary' }} pull-right">{{ $item['label'] }}</span>
                    </span>
                @elseif (isset($item['submenu']))
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                @endif
            </a>
            @if (isset($item['submenu']))
                <ul class="{{ $item['submenu_class'] }}">
                    @each('adminlte::partials.menu-item', $item['submenu'], 'item')
                </ul>
            @endif
        </li>
    @else
    <!-- FUNCIONARIO -->    
        @if($item['permission']=='yes')
            <li class="{{ $item['class'] }}">
                <a href="{{ $item['href'] }}"
                   @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
                >
                    <i class="fa fa-fw fa-{{ $item['icon'] or 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                    <span>{{ $item['text'] }}</span>
                    @if (isset($item['label']))
                        <span class="pull-right-container">
                            <span class="label label-{{ $item['label_color'] or 'primary' }} pull-right">{{ $item['label'] }}</span>
                        </span>
                    @elseif (isset($item['submenu']))
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    @endif                            
                </a>
                @if (isset($item['submenu']))
                    @if($item['text']!='Dependente')
                        <ul class="{{ $item['submenu_class'] }}">
                            @each('adminlte::partials.menu-item', $item['submenu'], 'item')
                        </ul>
                    @else
                        @if(Auth::user()->categoria==0)
                            @include('adminlte::partials.menu-dependente')
                        @else
                            <ul class="{{ $item['submenu_class'] }}">
                                @each('adminlte::partials.menu-item', $item['submenu'], 'item')
                            </ul>                    
                        @endif
                    @endif
                @endif 
            </li>               
        @endif
    @endif
@endif
