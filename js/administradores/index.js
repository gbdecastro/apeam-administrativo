const app = new Vue({
    el: '#administrador',
    created: function () {
        this.getAdministradores();
    },
    data: {
        administradores: [],
        new_administrador: {
            id_user: ''
        }
    },
    methods: {
        getNotAdministradores: function(){
            
            var url = 'administradores/not';

            axios.get(url).then(response => {
                $('#not_administradores').select2('destroy');
                $('#not_administradores').html('');
                $.each(response.data, function (i, entry) {
                    var categoria = '';
                    if(entry.categoria == 1)
                        categoria = 'Administrador';
                    if(entry.categoria == 0)
                        categoria = 'Associado';
                    var option = '<option value=' + entry.id + '>' + entry.name + ' - '+categoria+'</option>';
                    $('#not_administradores').append(option);
                });

            }).then(()=>{
                $('#not_administradores').select2({
                    width: '100%',
                    allowClear: true                        
                });
            });


        },
        getAdministradores: function () {

            $('.overlay').show();

            $('#table_administradores').DataTable().destroy();
            $('#table_administradores').hide();

            var url = 'administradores/all';

            axios.get(url).then(response => {
                
                //joga na lista de administradores
                this.administradores = response.data;

            }).then(() => {
                //Plugin Datatables
                $('#table_administradores').DataTable({
                    "order": [],
                    "oLanguage": {
                      "sUrl": "js/libs/datatables_ptbr.json"
                    }
                });

                $('#table_administradores').show();
                $('.overlay').hide();
            });
            this.getNotAdministradores();
        },
        createAdministrador: function () {

            var url = 'administradores';

            var administrador = this.new_administrador;

            administrador.id_user = $('#not_administradores').val();

            axios.post(url, administrador)
                .then(response => {
                    //atualiza a lista de administradores
                    this.getAdministradores();
                    //fecho modal
                    $('#modal_create').modal('hide');
                    //informo ao usuario
                    toastr.success('Administrador ' + administrador.tx_grupo + ' criado com sucesso');
                }).catch(error => {
                    toastr.error(error);
                });
        },
        deletarAdministrador:  function(administrador){
            var url = 'administradores/'+administrador.id_user;
            axios.delete(url).then((response)=>{
                if(response.data){
                    toastr.error("Você não pode Excluir-se");
                }else{
                    //atualiza a lista de administradores
                    this.getAdministradores();                     
                    toastr.success('Administrador ' + administrador.tx_grupo + ' EXCLUÍDO com sucesso');                    
                }
            }).catch(error => {
                toastr.error(error);
            });

        }
    }

});