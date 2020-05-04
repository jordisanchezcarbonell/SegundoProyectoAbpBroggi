<template>
    <div>


        <modal-Post></modal-Post>
        <!-- The modal
        <modal></modal>
        <tableJS></tableJS>
        <tablecomplexa></tablecomplexa>

        <tableJS></tableJS>-->

        <tablecomplexa ref="table" nombreApi="usuarios"></tablecomplexa>

    </div>
</template>

<script>
import Vuex from 'vuex';

export default {

    data() {
        return {
            form: {
                codi:0,
                nom:"",
                contrasenya:"",
                rols_id: null
            },

            rols_id: [
                { text: "Select One", value: null },
                1,
                2

            ],
            show: true,
            modalShow: false

        };
    },
  computed: {
              message() {
                this.test= this.$store.state.message;
                },
                /*...Vuex.mapState(['message']),
                ...Vuex.mapState(['count']),*/
                ...Vuex.mapState(['message','count','users','posts']),
                                //...Vuex.mapState(['posts']),



        },
        mounted(){

                                        this.$store.dispatch('loadUsers','http://127.0.0.1:8000/api/usuarios');
        },
          updated() {
        //SE EJECUTA CUÁNDO SE RALIZAN LOS CAMBIOS
                                                this.$store.dispatch('loadUsers','http://127.0.0.1:8000/api/usuarios');

        console.log('update');
       // onReset(evt);

    },
         created() {

            //this.$store.dispatch('loadUsers','https://jsonplaceholder.typicode.com/users');
            //this.$store.dispatch('loadUsers','https://jsonplaceholder.typicode.com/posts');
              //          this.$store.dispatch('loadUsers','https://pokeapi.co/api/v2/pokemon');
              //this.$store.dispatch('loadUsers','http://127.0.0.1:8000/api/alertant');


  },
    methods: {


        ...Vuex.mapMutations(['incrementBy','disminuir','hideModal']),
        onSubmit(evt) {
            evt.preventDefault();
              let me=this;
              console.log(JSON.stringify(this.form));
                axios.post('http://127.0.0.1:8000/api/usuarios',this.form).then(function(response){
                    //me.rols=response.data;
                    console.log(response);

                    alert("Se ha generado correctamente.");


                })
                .catch(function(error){
                console.log(error)
                 })
                  setTimeout(function(){
                    this.codi = this.nom = '';

                        evt.target.reset();            }, 2000);
                          /*this.form.codi = "";
                      this.form.nom = "";
                      this.form.contrasenya = null;*/

            },

        onReset() {

            // Reset our form values

            this.form.codi = "";
            this.form.nom = "";
            this.form.contrasenya = null;
            // Trick to reset/clear native browser form validation state
            this.show = false;
            this.$nextTick(() => {
                this.show = true;
            });
        },
        modal(){
              this.hideModal();
        },
    }
}

</script>
<style scoped>
table {
  width: 100%;
}
</style>
