<ul class="treeview-menu">
    @foreach(Auth::user()->dependentes()->get() as $a)
        @if(count($a)>0)
            <li>
                <a href="{{ action('DeclaracoesController@imprimirDependente',['id_user' => $a->id_user, 'nb_identificacao' => $a->nb_identificacao]) }}">
                    <i class="far fa-user-circle"></i> {{ $a->name }}
                </a>
            </li>
        @endif
    @endforeach
</ul>