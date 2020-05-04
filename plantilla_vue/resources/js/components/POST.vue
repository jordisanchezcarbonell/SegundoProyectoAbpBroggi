<template>

  <div>


    <b-button v-if="tipoaccion == 'usuarios'" v-b-modal.modal-prevent-closing>1</b-button>
    <b-button v-if="tipoaccion == 'alertant'" v-b-modal.modal-Alertant>Afegeix un alertant </b-button>

    <b-button v-else v-b-modal.modalPostRol>2</b-button>


    <b-modal
      id="modalPostRol"
      ref="modal"
      title="Submit Your Name"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
     <p class="my-4">Hello from modal!</p>
         <b-form-group id="input-group-2" label="Nom" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="formRols.nom"
          required
          placeholder="Enter nom"
        ></b-form-input>
      </b-form-group>
      </form>
  </b-modal>

    <b-modal
      id="modal-Alertant"
      ref="modal"
      title="Submit Your Name"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">



      <b-form-group
        id="input-group-1"
        label="Nom"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="input-1"
          v-model="formAlertant.nom"
          required
          placeholder="Enter codi"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="adreca" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="formAlertant.adreca"
          required
          placeholder="Enter nom"
        ></b-form-input>
      </b-form-group>
  <b-form-group id="input-group-5" label="telefon" label-for="input-5">
        <b-form-input
          id="input-5"
          v-model="formAlertant.telefon"
          required
          placeholder="Enter contrasenya"
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-3" label="municipis_id" label-for="input-3">
                <select v-model="formAlertant.municipis_id" name="municipi" id="municipi" class="form-control" tabindex="12">
            <option v-for="(municipi, index) in municipis"
                    :key="index"
                    :value="municipi.id">{{ municipi.nom }}
            </option>
        </select>

      </b-form-group>



  <b-form-group id="input-group-4" label="tipus_alertant_id" label-for="input-3">
                <select v-model="formAlertant.tipus_alertant_id" name="city" id="city" class="form-control" tabindex="12">
            <option v-for="(city, index) in tipoAlertant"
                    :key="index"
                    :value="city.id">{{ city.tipus }}
            </option>
        </select>

      </b-form-group>






      </form>
    </b-modal>




    <b-modal
      id="modal-prevent-closing"
      ref="modal"
      title="Submit Your Name"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">



      <b-form-group
        id="input-group-1"
        label="codi"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="input-1"
          v-model="form.codi"
          required
          placeholder="Enter codi"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Nom" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.nom"
          required
          placeholder="Enter nom"
        ></b-form-input>
      </b-form-group>
  <b-form-group id="input-group-5" label="contrasenya" label-for="input-5">
        <b-form-input
          id="input-5"
          v-model="form.contrasenya"
          required
          placeholder="Enter contrasenya"
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-3" label="rols:" label-for="input-3">
                <select v-model="form.rols_id" name="city" id="city" class="form-control" tabindex="12">
            <option v-for="(city, index) in tipoRols"
                    :key="index"
                    :value="city.id">{{ city.nom }}
            </option>
        </select>

      </b-form-group>










      </form>
    </b-modal>
  </div>



</template>
<script>
import Vuex from 'vuex';
  export default {

        props:['tipoaccion','alertant',"test"],
    data() {
      return {
            form: {
                codi:0,
                nom:"",
                contrasenya:"",
                rols_id: null
            },
                rols_id: [


            ],

            formRols: {

                nom:"",


            },
             formAlertant: {

                nom:"",

                adreca:'',
                municipis_id:null,

                telefon:'',
                tipus_alertant_id:null


            },
        name: '',
        nameState: null,
        submittedNames: []
      }
    },
    computed:{
                   ...Vuex.mapState(['message','count','users','posts','tipoRols','municipis','tipoAlertant']),


    },
    methods: {
      checkFormValidity() {
        const valid = this.$refs.form.checkValidity()
        this.nameState = valid
        return valid
      },
      resetModal() {
          if(this.tipoaccion=="usuarios"){
        this.name = ''
        this.form.nom='';
        this.form.codi='';

        this.form.contrasenya='';
        this.form.rols_id='';

        this.nameState = null
        }
        else if(this.tipoaccion=="alertant"){
            this.formAlertant.nom="",
                 this.formAlertant.adreca='',
                  this.formAlertant.telefon='',
                  this.formAlertant.municipis_id=null,
                  this.formAlertant.tipus_alertant_id=null
            }
            else{

        this.formRols.nom='';

        }
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing

        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
          console.log(this.formAlertant);
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        // Push the name to submitted names
        console.log(this.tipoaccion);
          axios.post('http://127.0.0.1:8000/api/'+this.tipoaccion,this.formAlertant).then(function(response){
                    //me.rols=response.data;
                    console.log(response);

                    alert("Se ha generado correctamente.");


                })
                .catch(function(error){
                console.log(error)
                 })
        // Hide the modal manually
        this.$nextTick(() => {
            if(this.tipoaccion == 'usuarios'){
          this.$bvModal.hide('modal-prevent-closing')
          }
   else if(this.tipoaccion=="alertant"){

                this.$bvModal.hide('modal-Alertant')
            }          else{
                this.$bvModal.hide('modalPostRol')


          }
        })
      }


    },
    created(){
              this.$store.dispatch('loadUsers',' http://127.0.0.1:8000/api/rols');
               this.$store.dispatch('loadUsers',' http://127.0.0.1:8000/api/municipi');
               this.$store.dispatch('loadUsers',' http://127.0.0.1:8000/api/TipusA');

    },
    beforeCreate(){




    },
    mounted(){
        console.log(this.test);
    }

  }
</script>
<style scoped>
table {
  width: 100%;
}
</style>
