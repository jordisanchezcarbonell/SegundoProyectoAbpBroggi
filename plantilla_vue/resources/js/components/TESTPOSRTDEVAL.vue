<template>
  <div>
    <b-button
      class="btn boto-terciari"
      v-if="tipoaccion == 'usuarios'"
      v-b-modal.modal-prevent-closing
    >Open Modal</b-button>

    <!-- Boto PARA ROL -->
    <b-button
      class="btn boto-terciari"
      v-if="tipoaccion == 'alertant'"
      v-b-modal.modal-Alertant
    >Afegeix alertant</b-button>

    <!-- boto PARA Recurso -->
    <b-button
      class="btn boto-terciari"
      v-if="tipoaccion == 'recurso'"
      v-b-modal.modal-recursos
    >Afegeix recurs</b-button>
    <!-- boto PARA Afectat -->
    <b-button
      class="btn boto-terciari"
      v-if="tipoaccion == 'afectats'"
      v-b-modal.modal-afectat
    >Afegeix afectat</b-button>

    <!-- MODALS -->
    <!-- FORM PARA ROL -->
    <b-modal
      id="modalPostRol"
      ref="modal"
      title="Submit Your Name"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      class="margeninput"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <p class="my-4">Hello from modal!</p>
        <b-form-group id="input-group-2" label="Nom" label-for="input-2">
          <div>
            <b-icon
              v-b-tooltip.focus
              title="Aquest camp s'ha d'omplir amb el municipio del alertante"
              icon="info-circle"
              class="icona-info"
            ></b-icon>
          </div>
          <b-form-input id="input-2" v-model="formRols.nom" required placeholder="Enter nom"></b-form-input>
        </b-form-group>
      </form>
    </b-modal>

    
    <!-- FORM PARA ALERTANT  ok-only ok-variant="secondary" ok-title="Cancel" -->
    <b-modal
      hide-footer
      class="margeninput"
      id="modal-Alertant"
      ref="modal"
      @show="resetModal"
      @hidden="resetModal"
      title="Afegeix un alertant/vip "
    >
      <form inline ref="form" @submit.stop.prevent="onSubmit">

        <!-- Nom -->
        <b-form-group id="input-group-1" label="Nom" label-for="input-1" label-class="margenform">
          <b-form-input
            class="margeninput"
            id="input-1"
            v-model="formAlertant.nom"
            required
            placeholder="nom"
          ></b-form-input>
          <b-icon
            v-b-tooltip.focus
            title="Aquest camp s'ha d'omplir amb el nom de l'alertant"
            icon="info-circle"
            class="icona-info"
          ></b-icon>
        </b-form-group>

        <!-- Adreça -->
        <b-form-group
          id="input-group-2"
          label-class="margenform"
          label="Adreça"
          label-for="input-2"
        >
          <b-form-input
            class="margeninput"
            id="input-2"
            v-model="formAlertant.adreca"
            required
            placeholder="adreça"
          ></b-form-input>
          <b-icon
            v-b-tooltip.focus
            title="Aquest camp s'ha d'omplir amb la direcció de l'alertant"
            icon="info-circle"
            class="icona-info"
          ></b-icon>
        </b-form-group>

        <!-- Telefon -->
        <b-form-group
          id="input-group-5"
          label-class="margenform"
          label="Telefon"
          label-for="input-5"
        >
          <b-form-input
            class="margeninput"
            id="input-5"
            v-model="formAlertant.telefon"
            required
            placeholder="telefon"
          ></b-form-input>
          <b-icon
            v-b-tooltip.focus
            title="Aquest camp s'ha d'omplir amb el telèfon de l'alertant"
            icon="info-circle"
            class="icona-info"
          ></b-icon>
        </b-form-group>
        <!--
      <b-form-group id="input-group-3"                  label-class="margenform"
 label="municipis_id" label-for="input-3">
                <select

v-model="formAlertant.municipis_id" name="municipi" id="municipi" class="form-control margeninput" tabindex="12">
            <option v-for="(municipi, index) in municipis"
                    :key="index"
                    :value="municipi.id">{{ municipi.nom }}
            </option>
        </select>
        <b-icon v-b-tooltip.focus title="Aquest camp s'ha d'omplir amb el municipio del alertante" icon="info-circle" class="icona-info"b-icon>

      </b-form-group>
        --->

        <!-- Municipi -->
        <b-form-group
          label-class="margenform"
          id="input-group-3"
          label="Municipi"
          label-for="input-3"
        >
          <!--
        <select
          v-model="formIncidencia.municipis_id"
          name="municipi"
          id="municipi"
          class="form-control"
          tabindex="12"
        >
          <option
            v-for="(municipi, index) in municipis"
            :key="index"
            :value="municipi.id"
          >{{ municipi.nom }}</option>
        </select>
          -->

          <b-button
            class="margeninput boto-primari"
            @click="modalMunicpis2 = !modalMunicpis2"
            ref="botoMunincpi2"
          >Selecionar municipi</b-button>
          <b-icon
            v-b-tooltip.focus
            title="Aquest camp s'ha d'omplir amb el municipi de l'alertant"
            icon="info-circle"
            class="icona-info"
          ></b-icon>
        </b-form-group>
        
        <!-- Tipus alertant -->
        <b-form-group
          label-class="margenform"
          id="input-group-4"
          label="Tipus s'alertant"
          label-for="input-3"
        >
          <select
            v-model="formAlertant.tipus_alertant_id"
            name="city"
            id="city"
            class="form-control margeninput"
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
            title="Aquest camp s'ha d'omplir amb el tipus d'alertant que hi ha"
            icon="info-circle"
            class="icona-info"
          ></b-icon>
        </b-form-group>

        <!-- SUBMIT -->
        <div class="d-flex justify-content-center">
          <b-button ref="submit" class="boto-primari" type="submit" :disabled="busy">Submit</b-button>
        </div>

        <!-- Modal confirmacio -->
        <b-overlay :show="busy" no-wrap @shown="onShown" @hidden="onHidden">
          <template v-slot:overlay>
            <div v-if="processing" class="text-center p-4 bg-primary text-light rounded">
              <b-icon icon="cloud-upload" font-scale="4"></b-icon>
              <div class="mb-3">Processing...</div>
              <b-progress
                min="1"
                max="20"
                :value="counter"
                variant="success"
                height="3px"
                class="mx-n4 rounded-0"
              ></b-progress>
            </div>
            <div
              v-else
              ref="dialog"
              tabindex="-1"
              role="dialog"
              aria-modal="false"
              aria-labelledby="form-confirm-label"
              class="text-center p-3"
            >
              <p>
                <strong id="form-confirm-label">Estas segur?</strong>
              </p>
              <div class="d-flex">
                <b-button variant="outline-danger" class="mr-3" @click="onCancel">NO</b-button>
                <b-button variant="outline-success" @click="onOK">SI</b-button>
              </div>
            </div>
          </template>
        </b-overlay>

        <!-- MODAL PARA Municipis -->
        <b-modal
          id="modal-municipi2"
          title="Seleciona un municipi"
          @ok="handleOk"
          size="xl"
          v-model="modalMunicpis2"
        >
          <taula-form
            :current_items="municipis"
            col1="id"
            col2="nom"
            col3="comarques_id"
            @tancar-modal="tancarModal"
          ></taula-form>
        </b-modal>
      </form>
    </b-modal>

    <!-- FORM PARA rol -->

    <b-modal
      id="modal-prevent-closing"
      ref="modal"
      title="Submit Your Name"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
    >
      <form ref="form" @submit.stop.prevent="onSubmit">
        <b-form-group
          label-class="margenform"
          id="input-group-1"
          label="codi"
          label-for="input-1"
          description="We'll never share your email with anyone else."
        >
          <b-form-input
            class="margeninput"
            id="input-1"
            v-model="form.codi"
            required
            placeholder="Enter codi"
          ></b-form-input>

          <b-icon
            v-b-tooltip.focus
            title="Aquest camp s'ha d'omplir amb el municipio del alertante"
            icon="info-circle"
            class="icona-info"
          ></b-icon>
        </b-form-group>

        <b-form-group id="input-group-2" label="Nom" label-for="input-2">
          <b-form-input id="input-2" v-model="form.nom" required placeholder="Enter nom"></b-form-input>
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
            <option v-for="(city, index) in tipoRols" :key="index" :value="city.id">{{ city.nom }}</option>
          </select>
        </b-form-group>
      </form>
    </b-modal>

    <!-- FORM PARA AFECTAT -->
    <b-modal
      id="modal-afectat"
      ref="modal"
      title="Completa el form per afectat"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
    >
      <form ref="form" @submit.stop.prevent="onSubmit">
        <!-- tenir_tarjeta -->
        <b-form-group
          label-cols="5"
          label-cols-md="4"
          label-cols-xl="3"
          id="input-group-0"
          label="Té targeta?"
          label-for="input-0"
        >
          <b-form-radio-group
            id="radio-group"
            required
            v-model="formAfectat.tenir_tarjeta"
            name="radio-sub-component"
          >
            <b-form-radio name="some-radios" @change="verificarCip" value="1">Si</b-form-radio>
            <b-form-radio name="some-radios" @change="verificarCip" value="0">No</b-form-radio>
          </b-form-radio-group>
        </b-form-group>
        <!-- CIP -->
        <b-form-group
          label-cols="5"
          label-cols-md="4"
          label-cols-xl="3"
          id="input-group-1"
          label="Codi CIP"
          label-for="input-1"
        >
          <b-form-input
            id="input-1"
            required
            v-model="formAfectat.cip"
            ref="inputCip"
            type="text"
            maxlength="14"
            placeholder="EX: 910913412340 SAFE"
          ></b-form-input>
        </b-form-group>
        <!-- Nom -->
        <b-form-group
          label-cols="5"
          label-cols-md="4"
          label-cols-xl="3"
          id="input-group-2"
          label="Nom"
          label-for="input-2"
        >
          <b-form-input id="input-2" required v-model="formAfectat.nom" placeholder="Ex: Bonifaci"></b-form-input>
        </b-form-group>
        <!-- Cognom -->
        <b-form-group
          label-cols="5"
          label-cols-md="4"
          label-cols-xl="3"
          id="input-group-3"
          label="Cognom"
          label-for="input-3"
        >
          <b-form-input
            id="input-3"
            required
            v-model="formAfectat.cognoms"
            type="text"
            placeholder="Ex: Pérez"
          ></b-form-input>
        </b-form-group>
        <!-- Edat -->
        <b-form-group
          label-cols="5"
          label-cols-md="4"
          label-cols-xl="3"
          id="input-group-4"
          label="Edat (en anys)"
          label-for="input-4"
        >
          <b-form-input
            id="input-4"
            required
            v-model="formAfectat.edat"
            type="number"
            max="150"
            min="1"
            placeholder="Ex: 69"
          ></b-form-input>
        </b-form-group>
        <!-- Sexe -->
        <b-form-group
          label-cols="5"
          label-cols-md="4"
          label-cols-xl="3"
          id="input-group-5"
          label="Sexe (M o F)"
          label-for="input-4"
        >
          <b-form-radio-group
            required
            id="radio-group-2"
            v-model="formAfectat.sexe"
            name="radio-sub-component-2"
          >
            <b-form-radio name="some-radios-2" value="M">Masculí</b-form-radio>
            <b-form-radio name="some-radios-3" value="F">Femení</b-form-radio>
          </b-form-radio-group>
        </b-form-group>
        <!-- Telefon -->
        <b-form-group
          label-cols="5"
          label-cols-md="4"
          label-cols-xl="3"
          id="input-group-6"
          label="Telefon)"
          label-for="input-6"
        >
          <b-form-input
            id="input-4"
            required
            v-model="formAfectat.telefon"
            type="text"
            placeholder="Ex: 606 969 606"
          ></b-form-input>
        </b-form-group>

        <!-- Submit -->
        <div class="d-flex justify-content-center">
          <b-button ref="submit" type="submit" :disabled="busy">Submit</b-button>
        </div>

        <!-- keloké? -->
        <b-overlay :show="busy" no-wrap @shown="onShown" @hidden="onHidden">
          <template v-slot:overlay>
            <div v-if="processing" class="text-center p-4 bg-primary text-light rounded">
              <b-icon icon="cloud-upload" font-scale="4"></b-icon>
              <div class="mb-3">Processing...</div>
              <b-progress
                min="1"
                max="20"
                :value="counter"
                variant="success"
                height="3px"
                class="mx-n4 rounded-0"
              ></b-progress>
            </div>
            <div
              v-else
              ref="dialog"
              tabindex="-1"
              role="dialog"
              aria-modal="false"
              aria-labelledby="form-confirm-label"
              class="text-center p-3"
            >
              <p>
                <strong id="form-confirm-label">Are you sure?</strong>
              </p>
              <div class="d-flex">
                <b-button variant="outline-danger" class="mr-3" @click="onCancel">Cancel</b-button>
                <b-button variant="outline-success" @click="onOK">OK</b-button>
              </div>
            </div>
          </template>
        </b-overlay>
      </form>
    </b-modal>

    <!-- FORM PARA RECURSOS -->
    <b-modal
      id="modal-recursos"
      ref="modal"
      title="Afegeix un recurs mòbil"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
    >
      <form ref="form" @submit.stop.prevent="onSubmit">
        <b-form-group label-class="margenform" id="input-group-1" label="Codi" label-for="input-1">
          <b-form-input
            class="margeninput"
            id="input-1"
            v-model="formNourecurs.codi"
            required
            placeholder="Enter codi"
          ></b-form-input>

          <b-icon
            v-b-tooltip.focus
            title="Aquest camp s'ha d'omplir amb el codi del recurs mòbil"
            icon="info-circle"
            class="icona-info"
          ></b-icon>
        </b-form-group>

        <b-form-group
          label-class="margenform"
          id="input-group-3"
          label="Tipus de recurs"
          label-for="input-3"
        >
          <select
            v-model="formNourecurs.tipus_recurs_id"
            name="city"
            id="city"
            class="form-control margeninput"
            tabindex="12"
          >
            <option
              v-for="(city, index) in tipoRecursos"
              :key="index"
              :value="city.id"
            >{{ city.tipus }}</option>
          </select>
          <b-icon
            v-b-tooltip.focus
            title="Aquest camp s'ha d'omplir amb el tipus del recurs mòbil"
            icon="info-circle"
            class="icona-info"
          ></b-icon>
        </b-form-group>
        <div class="d-flex justify-content-center">
          <b-button class="boto-primari" ref="submit" type="submit" :disabled="busy">Submit</b-button>
        </div>

        <b-overlay :show="busy" no-wrap @shown="onShown" @hidden="onHidden">
          <template v-slot:overlay>
            <div v-if="processing" class="text-center p-4 bg-primary text-light rounded">
              <b-icon icon="cloud-upload" font-scale="4"></b-icon>
              <div class="mb-3">Processing...</div>
              <b-progress
                min="1"
                max="20"
                :value="counter"
                variant="success"
                height="3px"
                class="mx-n4 rounded-0"
              ></b-progress>
            </div>
            <div
              v-else
              ref="dialog"
              tabindex="-1"
              role="dialog"
              aria-modal="false"
              aria-labelledby="form-confirm-label"
              class="text-center p-3"
            >
              <p>
                <strong id="form-confirm-label">Estas segur?</strong>
              </p>
              <div class="d-flex">
                <b-button variant="outline-danger" class="mr-3" @click="onCancel">NO</b-button>
                <b-button variant="outline-success" @click="onOK">SI</b-button>
              </div>
            </div>
          </template>
        </b-overlay>
      </form>
    </b-modal>
  </div>
</template>
<script>
import Vuex from "vuex";
export default {
  props: ["tipoaccion", "alertant", "test"],
  data() {
    return {
      busy: false,
      processing: false,
      counter: 1,
      interval: null,
      form: {
        codi: 0,
        nom: "",
        contrasenya: "",
        rols_id: null
      },
      rols_id: [],

      formRols: {
        nom: ""
      },
      formAlertant: {
        nom: "",

        adreca: "",
        municipis_id: null,

        telefon: "",
        tipus_alertant_id: null
      },
      formRecurs: {
        codi: "",
        tipus_recurs_id: null
      },
      formNourecurs: {
        codi: "",
        tipus_recurs_id: null
      },
      formAfectat: {
        cip: "",
        telefon: "",
        edat: null,
        sexe: null,
        nom: "",
        cognoms: "",
        tenir_tarjeta: null,
        municipis_id: 1
      },
      name: "",
      nameState: null,
      submittedNames: [],
      modalMunicpis2: false
    };
  },
  computed: {
    ...Vuex.mapState([
      "message",
      "count",
      "users",
      "posts",
      "tipoRols",
      "municipis",
      "tipoAlertant",
      "tipoRecursos"
    ])
  },
  methods: {
    tancarModal(item) {
      //alert(item.id);
      //input = this.$refs['input-alertant'];
      if (this.modalHospitals) {
        this.modalHospitals = false;
        this.$refs.botoHospital.textContent = item.nom;
        this.formIncidencia.alertants_id = item.id;
      } else if(this.modalMunicpis2){
        this.modalMunicpis2 = false;
        this.$refs.botoMunincpi2.textContent = item.nom;
        this.formAlertant.municipis_id = item.id;
      }else{

      }
    },
    verificarCip(checked) {
      if (checked == "1") {
        // this.$refs['inputCip'].disabled = false;
        document.getElementById("input-1").disabled = false;
        this.formAfectat.cip = "";
      } else {
        //this.$refs['inputCip'].disabled = true;
        //this.formAfectat.cip.disabled = true;
        document.getElementById("input-1").disabled = true;
        this.formAfectat.cip = "null";
      }
    },
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.nameState = valid;
      return valid;
    },
    clearInterval() {
      if (this.interval) {
        clearInterval(this.interval);
        this.interval = null;
      }
    },
    onShown() {
      // Focus the dialog prompt
      this.$refs.dialog.focus();
    },
    onHidden() {
      // In this case, we return focus to the submit button
      // You may need to alter this based on your application requirements
      this.$refs.submit.focus();
    },
    onSubmit() {
      this.processing = false;
      this.busy = true;
    },
    onCancel() {
      this.busy = false;
    },
    onOK() {
      this.counter = 1;
      this.processing = true;
      // Simulate an async request

      this.clearInterval();
      this.interval = setInterval(() => {
        if (this.counter < 20) {
          this.counter = this.counter + 1;
          this.Actualizar(this.tipoaccion);
        } else {
          this.clearInterval();
          if (this.tipoaccion == "alertant") {
            this.getPosts(this.tipoaccion, this.formAlertant);
          } else if (this.tipoaccion == "recurso") {
            console.log(this.formNourecurs);
            this.getPosts(this.tipoaccion, this.formNourecurs);
          } else if (this.tipoaccion == "afectats") {
            console.log(this.formAfectat);
            this.getPosts(this.tipoaccion, this.formAfectat);
          }

          this.$nextTick(() => {
            this.busy = this.processing = false;

            if (this.tipoaccion == "usuarios") {
              this.$bvModal.hide("modal-prevent-closing");
            } else if (this.tipoaccion == "alertant") {
              this.$bvModal.hide("modal-Alertant");
            } else if (this.tipoaccion == "recurso") {
              this.$bvModal.hide("modal-recursos");
            } else if (this.tipoaccion == "afectats") {
              this.$bvModal.hide("modal-afectat");
            } else {
              this.$bvModal.hide("modalPostRol");
            }
          });
        }
      }, 350);
    },

    getPosts(tipoaccion, formGeneric) {
      console.log(formGeneric);
      return axios
        .post("http://127.0.0.1:8000/api/" + this.tipoaccion, formGeneric)
        .then(function(response) {
          //me.rols=response.data;
          console.log(response);

          this.Actualizar(this.tipoaccion);
          // enviem la info en cas de que sigui afectat
          if (this.tipoaccion == "afectat") {
            this.$emit("verificar-afectat", true);
          }
        })
        .catch(function(error) {
          console.log(error);
          if (this.tipoaccion == "afectat") {
            this.$emit("verificar-afectat", false);
          }
        });
    },

    resetModal() {
      if (this.tipoaccion == "usuarios") {
        this.name = "";
        this.form.nom = "";
        this.form.codi = "";

        this.form.contrasenya = "";
        this.form.rols_id = "";

        this.nameState = null;
      } else if (this.tipoaccion == "alertant") {
        (this.formAlertant.nom = ""),
          (this.formAlertant.adreca = ""),
          (this.formAlertant.telefon = ""),
          (this.formAlertant.municipis_id = null),
          (this.formAlertant.tipus_alertant_id = null);
      } else if (this.tipoaccion == "recurso") {
        (this.formNourecurs.codi = ""),
          (this.formNourecurs.tipus_recurs_id = null);
      } else {
        this.formRols.nom = "";
      }
    },

    Actualizar(Apiactuar) {
      this.$store.dispatch(
        "loadUsers",
        "http://127.0.0.1:8000/api/" + Apiactuar
      );
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      this.handleSubmit();
    },
    handleSubmit() {
      console.log(this.formRecurs);
      this.processing = false;
      this.busy = true;
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }
      // Push the name to submitted names
      console.log(this.tipoaccion);
      if (this.tipoaccion == "alertant") {
        this.getPosts(this.tipoaccion, this.formAlertant);
      } else if (this.tipoaccion == "recurso") {
        console.log(this.formRecurs);
        this.getPosts(this.tipoaccion, this.formRecurs);
      }
      // Hide the modal manually
      this.$nextTick(() => {
        if (this.tipoaccion == "usuarios") {
          this.$bvModal.hide("modal-prevent-closing");
        } else if (this.tipoaccion == "alertant") {
          this.$bvModal.hide("modal-Alertant");
        } else if (this.tipoaccion == "recurso") {
          this.$bvModal.hide("modal-recursos");
        } else {
          this.$bvModal.hide("modalPostRol");
        }
      });
    }
  },
  created() {
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/rols");
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/municipi");
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/TipusA");
    this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/TipusR");
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
