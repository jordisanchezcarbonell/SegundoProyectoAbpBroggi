<template>
  <div>
    <form ref="form" @submit.stop.prevent="handleSubmit">
      <!-- Afectat -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-1"
        label="Form afectat"
        label-for="input-1"
      >
        <!--
          <b-button  @click="modalAfectat = !modalAfectat" ref="botoAfectat">
            FORM AFECTAT
          </b-button>
        -->
        <modal-post  class="margeninput2" tipoaccion="afectats" @verificar-afectat="verificarAfectat"></modal-post>
        <b-icon
          v-b-tooltip.focus
          title="S'obrirà un modal on s'ha d'omplir amb la informació de l'afectat"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Num Inciedncia -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-1"
        label="Numero incidència"
        label-for="input-1"
      >
        <b-form-input
          class="margeninput2"
          id="input-num-incidencia"
          v-model="formIncidencia.num_incidencia"
          required
          placeholder="00000000000"
          type="number"
        ></b-form-input>
         <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb el numero d''incidencia"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Data -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-2"
        label="Data"
        label-for="input-1"
      >
        <b-form-input
         class="margeninput2"
          id="input-data"
          v-model="formIncidencia.data"
          required
          placeholder="Data de la incidecnia"
          type="date"
        ></b-form-input>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir la data de l'incidencia"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Hora -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-3"
        label="Hora d'alerta"
        label-for="input-3"
      >
        <b-form-input
        class="margeninput2"
          id="input-hora"
          v-model="formIncidencia.hora"
          required
          placeholder="0"
          type="time"
        ></b-form-input>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha de posar l'hora en que s'ha produit l'incidencia"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Tipus d'alertant -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-4"
        label="Tipus d'alertant"
        label-for="input-3"
      >
        <select
          v-model="formIncidencia.tipus_alertant_id"
          name="city"
          id="tipus-alertant"
          class="form-control margeninput2"
          tabindex="12"
        >
          <option
            v-for="(city, index) in tipoAlertant"
            :key="index"
            :value="city.id"
          >{{ city.tipus }}</option>
        </select>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb el tipus d'alertant"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
        <b-icon
          v-b-tooltip.focus
          title="ENGLISH: Who is injuried? PRONUNCIACIÓ: Ju is injured? SIGNIFICAT: Qui és l'afectat?"
          icon="question-circle"
          class="icona-info"
        ></b-icon>
        <b-icon
          v-b-tooltip.focus
          title="ENGLISH: Myself, Friend, Other Person PRONUNCIACIÓ: Maiself, Frend, Oder Person SIGNIFICAT: Jo mateix, Amic/ga, Una altra persona"
          icon="chat-dots"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Telefon alertant -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-8"
        label="Telefon alertant"
        label-for="input-2"
      >
        <b-form-input
        class="margeninput2"
          id="input-telefon"
          v-model="formIncidencia.telefon_alertant"
          required
          placeholder="000-000-000"
          type="number"
        ></b-form-input>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb el telefon de l'alertant"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
        <b-icon
          v-b-tooltip.focus
          title="ENGLISH: What's your phone number? PRONUNCIACIÓ: Güats yur fon nambar? SIGNIFICAT: Quin és el teu número de telèfon?"
          icon="question-circle"
          class="icona-info"
        ></b-icon>
        <b-icon
          v-b-tooltip.focus
          title="Zero , O = ziro, ou = 0 / One = uan = 1 / Two = chu = 2 / Three = zri = 3 / Four = for = 4 / Five = faif = 5 / Six = sics = 6 / Seven = Seven = 7 / Eight = Eit = 8 / Nine = nain = 9"
          icon="chat-dots"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Adreça -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-6"
        label="Adreça"
        label-for="input-2"
      >
        <b-form-input
        class="margeninput2"
          id="input-adreca"
          v-model="formIncidencia.adreca"
          required
          placeholder="Adreça"
          type="text"
        ></b-form-input>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb l'adreça de l'alertant"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
        <b-icon
          v-b-tooltip.focus
          title="ENGLISH: What's your current addres right now? PRONUNCIACIÓ: Güats yur current adres rai nau? SIGNIFICAT: Quina es l'adreça actual ara mateix?"
          icon="question-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Complement Adreça -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-7"
        label="Complemnet Adreça"
        label-for="input-2"
      >
        <b-form-input
        class="margeninput2"
          id="input-complement"
          v-model="formIncidencia.complement_adreca"
          required
          placeholder="Informacio complemntaria sobre l'adreça"
          type="text"
        ></b-form-input>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb informació complemntària sobre l'adreça de l'alertant"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
        <b-icon
          v-b-tooltip.focus
          title="ENGLISH: More information about the addres? PRONUNCIACIÓ: Mor informeishon abaut de adres? SIGNIFICAT: Mes informació sobre l'adreça?"
          icon="question-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Municipi -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-5"
        label="Municipi"
        label-for="input-3"
      >
        <b-button
        
          @click="modalMunicpis = !modalMunicpis"
          ref="botoMunincpi"
          class="boto-terciari margeninput2"
        >Selecionar Municipi</b-button>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb el municipi de l'alertant"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
        <b-icon
          v-b-tooltip.focus
          title="ENGLISH: What's the name of the town where you are? PRONUNCIACIÓ: Güats de neim of de taun güere yu ar? SIGNIFICAT: Com és diu el municipi on ets?"
          icon="question-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Alertants/Hospitals -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-5"
        label="Hospitals/Alertants"
        label-for="input-3"
      >
        <b-button
          @click="modalHospitals = !modalHospitals"
          ref="botoHospital"
          class="boto-terciari margeninput2"
        >Selecionar Hospital</b-button>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb l'hospital de l'alertant"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Descripcio -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-8"
        label="Descripció"
        label-for="input-2"
      >
        <b-form-input
        class="margeninput2"
          id="input-descripcio"
          v-model="formIncidencia.descripcio"
          required
          placeholder="Què ha passat?"
          type="text"
        ></b-form-input>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb la descripció sobre els fets que ens digui l'alertant"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
        <b-icon
          v-b-tooltip.focus
          title="ENGLISH: Can you tell me what happened? PRONUNCIACIÓ: Can yu tel mi güat japenet? SIGNIFICAT: Em pots que ha passat"
          icon="question-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

       <!-- Tipus incident -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-8"
        label="Tipus icidència"
        label-for="input-2"
      >
        <select
          v-model="formIncidencia.tipus_incident_id"
          name="tipus_incidencia"
          id="tipus_incidencia"
          class="form-control margeninput2"
          tabindex="12"
        >
          <option
            v-for="(tipoIncidente, index) in tipoIncidentes"
            :key="index"
            :value="tipoIncidente.id"
          >{{ tipoIncidente.tipus }}</option>
        </select>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb el tipus dincident en funció de la informació que ens hagi proporcionat l'alertant"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>


      <!-- Recurs mòbil -->
      <b-form-group
        label-cols="4"
        label-cols-md="3"
        label-cols-xl="2"
        id="input-group-9"
        label="Recurs mòbil"
        label-for="input-3"
      >
        <b-button
          @click="modalRecursos = !modalRecursos"
          ref="botoRecurs"
          class="boto-terciari margeninput2"
        >Selecionar Recurs Mòbil</b-button>
        <b-icon
          v-b-tooltip.focus
          title="Aquest camp s'ha d'omplir amb el recurs mobil oportú"
          icon="info-circle"
          class="icona-info"
        ></b-icon>
      </b-form-group>

      <!-- Boto submit -->
      <div class="d-flex justify-content-center">
        <button
          type="submit"
          id="boto-submit"
          v-on:click="postIncidencia()"
          disabled
          style="display: block;"
          class="btn boto-primari"
        >Guardar Incidencia</button>
      </div>
      <div class="d-flex justify-content-center">
        <p id="text-submit">Completa tots els camps</p>
      </div>
    </form>

    <!-- MODAL PARA Hospital -->
    <b-modal id="modal-hospital" title="Seleciona un hospital" size="xl" v-model="modalHospitals">
      <taula-form
        :current_items="alertants"
        col1="id"
        col2="nom"
        col3="adreca"
        col4="municipis_id"
        col5="telefon"
        @tancar-modal="tancarModal"
      ></taula-form>
    </b-modal>

    <!-- MODAL PARA Municipis -->
    <b-modal id="modal-municipi" title="Seleciona un municipi" size="xl" v-model="modalMunicpis">
      <taula-form
        :current_items="municipis"
        col1="id"
        col2="nom"
        col3="comarques_id"
        col8="id_provincia"
        col7="comarca.provincies_id"
        @tancar-modal="tancarModal"
      ></taula-form>
    </b-modal>

    <!-- MODAL PARA Recursos -->
    <b-modal id="modal-recurs" title="Seleciona un recurs mòbil" size="xl" v-model="modalRecursos">
      <taula-form
        :current_items="recursos"
        col1="id"
        col2="codi"
        col5="Tipus de recurs"
        col6="recursosid.tipus"
        @tancar-modal="tancarModal"
      ></taula-form>
    </b-modal>
  </div>
</template>
<script>
import Vuex from "vuex";
import TaulaForm from "./taula_form.vue";
export default {
  props: ["tipoaccion", "alertant", "test"],
  data() {
    return {
      formIncidencia: {
        num_incidencia: null,
        data: null,
        hora: "",
        tipus_alertant_id: null,
        alertants_id: null,

        telefon_alertant: "",

        municipis_id: null,
        adreca: "",
        complement_adreca: "",

        tipus_incident_id: null,
        // recurs_mobil: "",
        descripcio: "",

        estats_incidencia_id: "1",
        recurs_mobil_id: null,
        formAfectat: null
      },
      formAfectat: {
        cip: "",
        telefon: "",
        edat: null,
        sexe: null,
        nom: "",
        cognoms: "",
        tenir_tarjeta: null,
        municipis_id: null
      },
      modalHospitals: false,
      modalMunicpis: false,
      modalRecursos: false,
      errors: []
    };
  },
  computed: {
    ...Vuex.mapState([
      "message",
      "alertants",
      "count",
      "users",
      "posts",
      "tipoRols",
      "municipis",
      "tipoAlertant",
      "tipoIncidentes",
      "recursos"
    ])
  },
  methods: {
    // post incidencia
    postIncidencia() {
      axios
        .post("http://127.0.0.1:8000/api/incidencias", this.formIncidencia)
        .then(function(response) {
          console.log(response);
          alert("Insertat correctament");
          // fem ek redirect
          window.location.href = "http://127.0.0.1:8000/taula_incidencia";
        })
        .catch(function(error) {
          this.errors.push(error.response.data);
          console.log(error.response.data);
        });
    },
    // comprovem que hagi fet tots els forms
    comprobarCamps() {
      if (
        this.formIncidencia.formAfectat == null &&
        this.formIncidencia.recurs_mobil_id != null &&
        this.formIncidencia.alertants_id != null &&
        this.formIncidencia.municipis_id != null
      ) {
        document.getElementById("text-submit").innerHTML = "";
        document.getElementById("boto-submit").disabled = false;
      }
    },
    // tancar modal
    tancarModal(item) {
      //alert(item.id);
      //input = this.$refs['input-alertant'];
      console.log(item.codi);
      if (this.modalHospitals) {
        this.modalHospitals = false;
        this.$refs.botoHospital.textContent = item.nom;
        this.formIncidencia.alertants_id = item.id;
      } else if (this.modalMunicpis) {
        this.modalMunicpis = false;
        this.$refs.botoMunincpi.textContent = item.nom;
        this.formIncidencia.municipis_id = item.id;
      } else if (this.modalRecursos) {
        this.modalRecursos = false;
        this.$refs.botoRecurs.textContent = item.recursosid.tipus;
        console.log(item);
        this.formIncidencia.recurs_mobil_id = item.id;
      } else {
        this.modalAfectat = false;
      }
      this.comprobarCamps();
    },
    verificarAfectat(resposta) {
      if (resposta) {
        this.formIncidencia.formAfectat = "completat";
      } else {
        alert("Form afectat no completat correctament");
      }
    }
  },
  created() {
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/rols");
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/municipi");
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/TipusA");
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/alertant");
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/TipusI");
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/recurso");
  },
  beforeCreate() {},
  mounted() {
    console.log(this.test);
  }
};
</script>
<style scoped>
table {
  width: 100%;
}
</style>
