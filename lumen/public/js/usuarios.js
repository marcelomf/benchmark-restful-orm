Vue.prototype.$http = axios;

new Vue({
    el: "#app",
    data: {
        nameBox: 'list',
        usuario: {},
        usuarios: []
    },
    mounted() {
        this.query();
    },
    methods: {
        query() {
            this.$http.get('/usuarios/query')
            .then(response => {
                this.usuarios = response.data;
            })
            .catch(e => {
                console.log(e);
            });
        },
        createOrUpdate() {
            if(this.usuario.id == null) {
                this.$http.post('/usuarios', this.usuario)
                .then(response => {
                    this.query();
                    this.usuario = {};
                })
                .catch(e => {
                    console.log(e);
                });
            } else {
                this.$http.put('/usuarios/'+this.usuario.id, this.usuario)
                .then(response => {
                    this.query();
                    this.usuario = {};
                })
                .catch(e => {
                    console.log(e);
                });
            }
        },
        select(usuario){
            this.usuario = usuario;
        },
        destroy(usuario){
            this.$http.delete('/usuarios/'+usuario.id)
            .then(response => {
                this.query();
            })
            .catch(e => {
                console.log(e);
            });
        },
        box(nameBox){
            if(nameBox == this.nameBox)
                return true;
            else
                return false;
        }
    }
});