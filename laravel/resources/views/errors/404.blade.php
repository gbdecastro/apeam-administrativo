@extends('adminlte::master') @section('body')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>

            <div class="error-content">
                <h3>
                    <i class="fa fa-warning text-yellow"></i> Oops! Página não Encontrada.</h3>

                <p>
                    Talvez a página esteja em construção
                    <a href="/perfil">retorne para o Perfil</a>.
                </p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection