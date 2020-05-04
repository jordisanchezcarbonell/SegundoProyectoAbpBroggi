<template>
    <b-container fluid>
        <!-- User Interface controls


    <b-form-input list="my-list-id"></b-form-input>

  <datalist id="my-list-id">

    <option v-for="size in municipis" :key="size.id">{{ size.nomfomrupdateincidenciasxRecursos }}
      <p>{{size.id}}</p>
    </option>

  </datalist>

    -->

        <b-row>
            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Filter"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="filterInput"
                    class="mb-0"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="Type to Search"
                        ></b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''"
                                >Clear</b-button
                            >
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
            </b-col>

            <b-col sm="5" md="6" class="my-1">
                <b-form-group
                    label="Per page"
                    label-cols-sm="6"
                    label-cols-md="4"
                    label-cols-lg="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="perPageSelect"
                    class="mb-0"
                >
                    <b-form-select
                        v-model="perPage"
                        id="perPageSelect"
                        size="sm"
                        :options="pageOptions"
                    ></b-form-select>
                </b-form-group>
            </b-col>

            <b-col sm="7" md="6" class="my-1">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="users.length"
                    :per-page="perPage"
                    align="fill"
                    size="sm"
                    class="my-0"
                ></b-pagination>
            </b-col>
        </b-row>


        <!-- Main table element -->
        <b-table
            sticky-header
            head-variant="dark"
            id="my-table"
            ref="table"
            show-empty
            small
            stacked="md"
            :items="users"
            :fields="fields"
            :current-page="currentPage"
            :per-page="perPage"
            :filter="filter"
            :filterIncludedFields="filterOn"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection"
        >
            <template v-slot:cell(actions)="row">
                <b-button
                    size="sm"
                    @click="info(row.item, row.item.id, $event.target)"
                    variant="danger"
                    class="mr-1"
                    >Eliminar</b-button
                >
                <b-button
                    size="sm"
                    @click="update(row.item, row.item.id, $event.target)"
                    class="mr-1 boto-primari"
                    >Modificar</b-button
                >
                <!--
        <b-button size="sm" @click="eliminar(row.item.id)">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>

      </template>
      <template v-slot:row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul>
        </b-card>

        -->
            </template>
        </b-table>
  <b-button

                        @click="guardarPDF()"
                        class="buttondatetime boto-primari"
                        >Guardar pagina</b-button
                    >
        <b-modal
            id="modal-recursos2"
            ref="modal"
            title="Añadir un recurso movil"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
            cancel-variant="colordefondoinsert"
            cancel-title="Cancelar"
            ok-title="Aceptar"
        >
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-form-group
                    id="input-group-1"
                    label="codi"
                    label-for="input-1"
                    label-class="margenform"
                >
                    <b-form-input
                        id="input-1-recurs"
                        class="margeninput"
                        v-model="formRecurs.codi"
                        required
                        placeholder="Enter codi"
                    ></b-form-input>
                    <b-icon
                        v-b-tooltip.focus
                        title="Este campo se ha de rellenar con el codigo del recurso movil"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>

                <b-form-group
                    label-class="margenform"
                    id="input-group-3"
                    label="rols:"
                    label-for="input-3"
                >
                    <select
                        v-model="formRecurs.tipus_recurs_id"
                        name="recurso"
                        id="recurso"
                        class="form-control margeninput"
                        tabindex="12"
                    >
                        <option
                            v-for="(recurso, index) in tipoRecursos"
                            :key="index"
                            :value="recurso.id"
                            >{{ recurso.tipus }}</option
                        >
                    </select>
                    <b-icon
                        v-b-tooltip.focus
                        title="Este campo se ha de rellenar con el tipo que sera el recurso movil"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>
            </form>
        </b-modal>

        <!-- FORM PARA ALERTANT -->

        <b-modal
            class="margeninput"
            id="modal-alertant2"
            ref="modal"
            title="Modifica un alertant"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
            cancel-variant="colordefondoinsert"
            cancel-title="Cancelar"
            ok-title="Aceptar"
        >
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-form-group
                    id="input-group-1"
                    label="Nom"
                    label-for="input-1"
                    label-class="margenform"
                >
                    <b-form-input
                        class="margeninput"
                        id="input-1"
                        v-model="formAlertant.nom"
                        required
                        placeholder="Enter codi"
                    ></b-form-input>

                    <b-icon
                        v-b-tooltip.focus
                        title="Este campo se ha de rellenar con el nombre del alertante"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>

                <b-form-group
                    label-class="margenform"
                    id="input-group-2"
                    label="adreca"
                    label-for="input-2"
                >
                    <b-form-input
                        class="margeninput"
                        id="input-2"
                        v-model="formAlertant.adreca"
                        required
                        placeholder="Enter nom"
                    ></b-form-input>
                    <b-icon
                        v-b-tooltip.focus
                        title="Este campo se ha de rellenar con la direccion del alertante"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>
                <b-form-group
                    label-class="margenform"
                    id="input-group-5"
                    label="telefon"
                    label-for="input-5"
                >
                    <b-form-input
                        id="input-5"
                        class="margeninput"
                        v-model="formAlertant.telefon"
                        required
                        placeholder="Indica el telefon"
                    ></b-form-input>
                    <b-icon
                        v-b-tooltip.focus
                        title="Este campo se ha de rellenar con el telefono del alertante"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>

                <b-form-group
                    label-class="margenform"
                    id="input-group-3"
                    label="municipis_id"
                    label-for="input-3"
                >
                    <select
                        v-model="formAlertant.municipis_id"
                        name="municipi"
                        id="municipi"
                        class="form-control margeninput"
                        tabindex="12"
                    >
                        <option
                            v-for="(municipi, index) in municipis"
                            :key="index"
                            :value="municipi.id"
                            >{{ municipi.nom }}</option
                        >
                    </select>
                    <b-icon
                        v-b-tooltip.focus
                        title="Este campo se ha de rellenar con el municipio del alertante"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
            margin-top: 2px; "
                    ></b-icon>
                    <!-- cAMBIAR POR DATALIST PERO SE LAGEA
  <b-form-input  v-model="formAlertant.municipis_id"  name="municipi" id="municipi" list="my-list-id"></b-form-input>

  <datalist id="my-list-id" >
    <option>Manual Option</option>
    <option v-for="municipi in municipis " :key="municipi.id">{{ municipi }}</option>



  </datalist>
          -->
                </b-form-group>

                <b-form-group
                    label-class="margenform"
                    id="input-group-4"
                    label="tipus_alertant_id"
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
                            >{{ city.tipus }}</option
                        >
                    </select>

                    <b-icon
                        v-b-tooltip.focus
                        title="Este campo se ha de rellenar con el tipo de alertante que tiene el alertante"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>

                <!--
  <b-form-input  v-model="formAlertant.municipis_id"  name="municipi" id="municipi" list="my-list-id"></b-form-input>

  <datalist id="my-list-id" >

    <option v-for="(municipi, index) in municipis"
                    :key="index"
                    :value="municipi.nom">

    </option>

  </datalist>
        -->
            </form>
        </b-modal>

        <!-- FORM PARA incidenciasxrecursos -->

        <b-modal
            class="margeninput"
            id="modal-incidenciasxrecursos"
            ref="modal"
            title="Modifica las horas"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
            cancel-variant="colordefondoinsert"
            cancel-title="Cancelar"
            ok-title="Aceptar"
        >
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-form-group
                    id="input-group-1"
                    label="Hora de acitvacio"
                    label-for="input-1"
                    label-class="margenform"
                >

                    <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="stopwatch"
                         @click="Obtenertiemopo('activacio')"
                        style="width: 37px; height: 32px;     margin-left: 25px;
                margin-top: 2px; "
                    ></b-icon>

                    <b-form-input
                        class="margeninput"
                        id="input-1"
                        v-model="fomrupdateincidenciasxRecursos.hora_acitvacio"
                        required
                        placeholder="Enter codi"
                    ></b-form-input>

                    <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
                margin-top: 2px; "
                    ></b-icon>
                </b-form-group>

                <b-form-group
                    id="input-group-2"
                    label="Hora de mobilitzacio"
                    label-for="input-2"
                    label-class="margenform"
                >
                <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="stopwatch"
                         @click="Obtenertiemopo('mobilitat')"
                        style="width: 37px; height: 32px;     margin-left: 25px;
                margin-top: 2px; "
                    ></b-icon>


                    <b-form-input
                        class="margeninput"
                        id="input-2"
                        v-model="
                            fomrupdateincidenciasxRecursos.hora_mobilitzacio
                        "
                        required
                        placeholder="Enter codi"
                    ></b-form-input>

                    <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>
                <b-form-group
                    id="input-group-3"
                    label="Hora de assistencia"
                    label-for="input-3"
                    label-class="margenform"
                >

      <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="stopwatch"
                         @click="Obtenertiemopo('asistencia')"
                        style="width: 37px; height: 32px;     margin-left: 25px;
                margin-top: 2px; "
                    ></b-icon>
                    <b-form-input
                        class="margeninput"
                        id="input-3"
                        v-model="
                            fomrupdateincidenciasxRecursos.hora_assistencia
                        "
                        required
                        placeholder="Enter codi"
                    ></b-form-input>

                    <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>

                <b-form-group
                    id="input-group-4"
                    label="Hora de transport"
                    label-for="input-4"
                    label-class="margenform"
                >

      <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="stopwatch"
                         @click="Obtenertiemopo('transport')"
                        style="width: 37px; height: 32px;     margin-left: 25px;
                margin-top: 2px; "
                    ></b-icon>
                    <b-form-input
                        class="margeninput"
                        id="input-4"
                        v-model="fomrupdateincidenciasxRecursos.hora_transport"
                        required
                        placeholder="Enter codi"
                    ></b-form-input>

                    <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>
                <b-form-group
                    id="input-group-5"
                    label="Hora de arribada l'hospital"
                    label-for="input-5"
                    label-class="margenform"
                >

      <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="stopwatch"
                         @click="Obtenertiemopo('hospital')"
                        style="width: 37px; height: 32px;     margin-left: 25px;
                margin-top: 2px; "
                    ></b-icon>
                    <b-form-input
                        class="margeninput"
                        id="input-5"
                        v-model="
                            fomrupdateincidenciasxRecursos.hora_arribada_hospital
                        "
                        required
                        placeholder="Enter codi"
                    ></b-form-input>

                    <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>
                <b-form-group
                    id="input-group-6"
                    label="Hora de transferencia"
                    label-for="input-6"
                    label-class="margenform"
                >


      <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="stopwatch"
                         @click="Obtenertiemopo('transferencia')"
                        style="width: 37px; height: 32px;     margin-left: 25px;
                margin-top: 2px; "
                    ></b-icon>
                    <b-form-input
                        class="margeninput"
                        id="input-6"
                        v-model="
                            fomrupdateincidenciasxRecursos.hora_transferencia
                        "
                        required
                        placeholder="Enter codi"
                    ></b-form-input>

                    <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>
                <b-form-group
                    id="input-group-7"
                    label="Hora de finalitzacio"
                    label-for="input-7"
                    label-class="margenform"
                >

      <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="stopwatch"
                         @click="Obtenertiemopo('finlatizacio')"
                        style="width: 37px; height: 32px;     margin-left: 25px;
                margin-top: 2px; "
                    ></b-icon>
                    <b-form-input
                        class="margeninput"
                        id="input-7"
                        v-model="
                            fomrupdateincidenciasxRecursos.hora_finalitzacio
                        "
                        required
                        placeholder="Enter codi"
                    ></b-form-input>

                    <b-icon
                        v-b-tooltip.focus
                        title="Al clickear el boton se obtendra la hora y la fecha actual"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
            margin-top: 2px; "
                    ></b-icon>
                </b-form-group>


                <b-form-group
                    label-class="margenform"
                    id="input-group-8"
                    label="estats_incidencia_id"
                    label-for="input-8"
                >
                    <select
                        v-model="fomrupdateincidenciasxRecursos.estats_incidencia_id"
                        name="city"
                        id="city"
                        class="form-control margeninput"
                        tabindex="12"
                    >
                        <option
                            v-for="(city, index) in tipoEstat"
                            :key="index"
                            :value="city.id"
                            >{{ city.estat }}</option
                        >
                    </select>

                    <b-icon
                        v-b-tooltip.focus
                        title="Este campo se ha de rellenar con el tipo de alertante que tiene el alertante"
                        icon="question-circle"
                        style="width: 37px; height: 32px;     margin-left: 25px;
    margin-top: 2px; "
                    ></b-icon>
                </b-form-group>
            </form>
        </b-modal>
    </b-container>
</template>

<script>
import Vuex from "vuex";
import jsPDF from 'jspdf'
import 'jspdf-autotable'


export default {
    /**
     * OBTENEMOS LAS VARIABLES PASADAS POR PARAMETRO DE LARAVEL EN VUE CON LAS PROPS
     */
    props: [
        "api",
        "tablaccion",
        "nomtabla",
        "tablanula",
        "datamunicipi",
        "adreca",
        "telefon",
        "tipusalertant",
        "nombtablaalertant",
        "col23",
        "col24",
        "col25",
        "col26",
        "col27",
        "col28",
        'col29','col30','col31','col32'
    ],
    data() {
        return {
            testfields: ["nom", "last_name", "age"],
            dataReady: false,
            items: [],
            fields: [
                /**
                 * INDICAREMOS CADA VARIABLE CON SU CAMPO CORRESPONDIENTE.
                 */
                {
                    key: this.nomtabla,
                    label: this.nomtabla,
                    sortable: true,
                    sortDirection: "desc"
                },
                {
                    key: this.adreca,
                    label: this.adreca,
                    sortable: true,
                    class: "text-center"
                },
                {
                    key: this.telefon,
                    label: this.telefon,
                    sortable: true,
                    class: "text-center"
                },
                // { key: 'municipis_id', label: 'municipis', sortable: true, class: 'text-center' },
                // { key: 'municipis_id', label: 'nom', sortable: true, class: 'text-center' },

                {
                    key: this.datamunicipi,
                    label: "municipi",
                    sortable: true,
                    class: "text-center"
                },
                {
                    key: this.tipusalertant,
                    label: this.nombtablaalertant,
                    sortable: true,
                    class: "text-center"
                },
                {
                    key: this.col32,
                    label: this.col23,
                    sortable: true,
                    class: "text-center"
                },
                {
                    key: this.col30,
                    label: this.col24,
                    sortable: true,
                    class: "text-center"
                },
                {
                    key: this.col31,
                    label: this.col25,
                    sortable: true,
                    class: "text-center"
                },
                {
                    key: this.col29,
                    label: this.col26,
                    sortable: true,
                    class: "text-center"
                },
                {
                    key: this.col28,
                    label: this.col27,
                    sortable: true,
                    class: "text-center"
                },
                { key: "actions", label: "Actions", class: "text-center" }
            ],

            click: 0,
            //totalRows: 1,
            VALOR: 0,
            currentPage: 1,
            perPage: 5,
            pageOptions: [5, 10, 15],
            test: 0,
            sortBy: "",
            sortDesc: false,
            sortDirection: "asc",
            filter: "",
            filterOn: [],
            Pruebamunicipi: [],
            infoModal: {
                rols_id: 0,
                Contraseña: "",
                codi: "",
                nom: "",
                id: 0
            },
            fomrupdateincidenciasxRecursos: {
                id: 0,
                hora_acitvacio: "",
                hora_mobilitzacio: "",
                hora_assistencia: "",
                hora_transport: "",
                hora_arribada_hospital: "",
                hora_transferencia: "",
                hora_finalitzacio: "",
                estats_incidencia_id:0
            },
            formAlertant: {
                id: 0,
                nom: "",

                adreca: "",
                municipis_id: null,

                telefon: "",
                tipus_alertant_id: null
            },
            formRecurs: {
                id: 0,
                codi: "",
                tipus_recurs_id: null
            },
            deleteModal: {
                titulo: "",
                id: 0,
                content: ""
            },
            boxTwo: ""
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
            "tipoRecursos",
            "tipoEstat"
        ]),
        //...Vuex.mapGetters({selectedOption:'getUsers'}),

        sortOptions() {
            // Create an options list from our fields
            return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return { text: f.label, value: f.key };
                });
        }
    },
    beforeCreate() {},

    created() {
        //this.$store.dispatch('loadUsers','https://jsonplaceholder.typicode.com/users');
        //this.$store.dispatch('loadUsers','https://jsonplaceholder.typicode.com/posts');
        // this.$store.dispatch('loadUsers','https://pokeapi.co/api/v2/pokemon');
        //this.items=  this.users.length;/
        this.$store.dispatch(
            "loadUsers",
            "http://127.0.0.1:8000/api/" + this.api
        );
        this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/rols");
        this.$store.dispatch(
            "loadUsers",
            " http://127.0.0.1:8000/api/municipi"
        );
        this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/TipusA");

                this.$store.dispatch("loadUsers", " http://127.0.0.1:8000/api/estat");


        /*if(this.api =="alertant"){
                    this.$store.dispatch('loadAlertant','http://127.0.0.1:8000/api/'+this.api );


        }else{
        this.$store.dispatch('loadUsers','http://127.0.0.1:8000/api/'+this.api );
        }*/

        console.log(this.Pruebamunicipi[0]);

        console.log(this.$store.state.users[0]);
    },
    beforeUpdate() {
        // this.selectedOption=this.getResults
        this.All_fields = this.fields;
    },
    updated() {
        //SE EJECUTA CUÁNDO SE RALIZAN LOS CAMBIOS
        // this.$store.dispatch('loadUsers','http://127.0.0.1:8000/api/alertant');

        console.log("update");
    },
    async mounted() {
        this.get();
        this.dataReady = true;
    },
    beforeMount() {
        //SE EJECUTA ANTES DE INSERTAR EL DOM
        console.log("beforeMount");

        //  this.$store.dispatch('loadUsers','http://127.0.0.1:8000/api/alertant');
    },
    methods: {
        makeToast(variant = null) {
            this.$bvToast.toast("Toast body content", {
                title: `Variant ${variant || "default"}`,
                variant: variant,
                solid: true
            });
        },
        Obtenertiemopo:function(formalquecambiar) {

            if(formalquecambiar=='asistencia'){
            this.fomrupdateincidenciasxRecursos.hora_assistencia = this.Obtenertiempoactual();

            }
            else if(formalquecambiar=='activacio'){
            this.fomrupdateincidenciasxRecursos.hora_acitvacio = this.Obtenertiempoactual();

            }
            else if(formalquecambiar=='mobilitat'){


                    this.fomrupdateincidenciasxRecursos.hora_mobilitzacio =this.Obtenertiempoactual();

         }else if(formalquecambiar=='transport'){
                                    this.fomrupdateincidenciasxRecursos.hora_transport =this.Obtenertiempoactual();

            }else if(formalquecambiar=='hospital'){
                                    this.fomrupdateincidenciasxRecursos.hora_arribada_hospital =this.Obtenertiempoactual();

            }else if(formalquecambiar=='transferencia'){
                                    this.fomrupdateincidenciasxRecursos.hora_transferencia =this.Obtenertiempoactual();

            }else if(formalquecambiar=='finlatizacio'){
                                    this.fomrupdateincidenciasxRecursos.hora_finalitzacio =this.Obtenertiempoactual();

            }
        },

        Obtenertiempoactual(){
             return new Date(
                new Date(new Date(new Date()).toISOString()).getTime() -
                    new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .slice(0, 19)
                .replace("T", " ");
            },

        get() {
            return (this.Pruebamunicipi = this.$store.state.users);

            console.log(this.$store.state.users);
        },
        ...Vuex.mapMutations(["getallusers", "getResults"]),
        ...Vuex.mapActions(["getResults"]),
        update(item, index, button) {
            //console.log(item);
            console.log(this.item);
            if (this.tablaccion == "rols") {
                this.infoModal.id = index;
                this.infoModal.rols_id = item.rols_id;

                this.infoModal.Contraseña = item.contrasenya;
                this.infoModal.codi = item.codi;
                this.infoModal.nom = item.nom;
            } else if (this.tablaccion == "recursos") {
                /*   console.log(this.formRecurs);
                        console.log(this.item);*/

                this.formRecurs.id = index;

                this.formRecurs.codi = item.codi;
                this.formRecurs.tipus_recurs_id = item.tipus_recurs_id;

                this.$root.$emit("bv::show::modal", "modal-recursos2", button);

                //this.$root.$emit('bv::show::modal', "modal-recursos2", button)
            } else if (this.tablaccion == "alertant") {
                this.formAlertant.id = index;
                this.formAlertant.nom = item.nom;
                this.formAlertant.adreca = item.adreca;
                this.formAlertant.telefon = item.telefon;
                this.formAlertant.municipis_id = item.municipi.id;
                this.formAlertant.tipus_alertant_id = item.tipus_alertant.id;

                console.log(this.formAlertant);
                this.$root.$emit("bv::show::modal", "modal-alertant2", button);
            } else if (this.tablaccion == "incidencias") {
                console.log(item.estat_incidencia[0].id);
                if (item.incidenciaspruebaderecursos.hora_acitvacio != null) {
                    this.fomrupdateincidenciasxRecursos.id = index;

                    this.fomrupdateincidenciasxRecursos.hora_acitvacio =
                        item.incidenciaspruebaderecursos.hora_acitvacio;
                    this.fomrupdateincidenciasxRecursos.hora_mobilitzacio =
                        item.incidenciaspruebaderecursos.hora_mobilitzacio;
                    this.fomrupdateincidenciasxRecursos.hora_assistencia =
                        item.incidenciaspruebaderecursos.hora_assistencia;
                    this.fomrupdateincidenciasxRecursos.hora_transport =
                        item.incidenciaspruebaderecursos.hora_transport;
                    this.fomrupdateincidenciasxRecursos.hora_arribada_hospital =
                        item.incidenciaspruebaderecursos.hora_arribada_hospital;
                    this.fomrupdateincidenciasxRecursos.hora_transferencia =
                        item.incidenciaspruebaderecursos.hora_transferencia;
                    this.fomrupdateincidenciasxRecursos.hora_finalitzacio =
                        item.incidenciaspruebaderecursos.hora_finalitzacio;
                       this.fomrupdateincidenciasxRecursos.estats_incidencia_id=item.estat_incidencia[0].id;
                    this.$root.$emit(
                        "bv::show::modal",
                        "modal-incidenciasxrecursos",
                        button
                    );
                } else {
                    alert("No tiene recursos");
                }
            }

            console.log(item);
            console.log(this.formAlertant);
        },
        info(item, index, button) {
            this.deleteModal.id = index;
            this.$bvModal
                .msgBoxConfirm(`Esta seguro que desea borrar este elemento?`, {
                    title: "Confirmación",
                    size: "sm",
                    buttonSize: "sm",
                    okVariant: "danger",
                    headerClass: "p-2 border-bottom-0",
                    footerClass: "p-2 border-top-0",
                    centered: true,
                    okTitle: "Eliminar",
                    cancelTitle: "Cancelar"
                })
                .then(value => {
                    this.boxTwo = value;
                    console.log(this.boxTwo);
                    if (this.boxTwo == true) {
                        var vm = this;
                        axios
                            .delete(
                                "http://127.0.0.1:8000/api/" +
                                    this.api +
                                    "/" +
                                    this.deleteModal.id
                            )
                            .then(response => {
                                /*const prueba = this.users.findIndex(user => user.id === id) // find the post index
                            if (~prueba) // if the post exists in array
                                this.users.splice(prueba, 1) //delete the post

                    console.log(this.result);*/
                                this.Actualizar(this.api);
                            });
                    }
                })
                .catch(err => {
                    // An error occurred
                });
            console.log(this.$refs.table.refresh());
            this.$refs.table.refresh();
            //console.log();
        },
        UpdateFORMS(Apiactuar, RecibirObjeto) {
            console.log("RECIBIROBKETO");
            console.log(RecibirObjeto);
            return axios
                .put(
                    "http://127.0.0.1:8000/api/" +
                        Apiactuar +
                        "/" +
                        RecibirObjeto.id,
                    RecibirObjeto
                )
                .then(function(response) {
                    //me.rols=response.data;

                    console.log(this.result);
                    //this.$store.dispatch('loadUsers','http://127.0.0.1:8000/api/'+Apiactuar);
                    Actualizar(Apiactuar);
                })
                .catch(function(error) {});
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            //this.totalRows = users.length;
            this.currentPage = 1;
        },
        selectedOption() {
            return pageOptions.push(this.$store.state.users.length);
        },
        checkFormValidity() {
            const valid = this.$refs.form.checkValidity();
            this.nameState = valid;
            return valid;
        },
        resetModal() {
            this.name = "";
            this.nameState = null;
        },
        Borrarelemento(bvModalEvt) {
            bvModalEvt.preventDefault();
            // console.log(this.infoModal);

            axios
                .delete(
                    "http://127.0.0.1:8000/api/" +
                        this.nombreApi +
                        this.infoModal.index
                )
                .then(response => {
                    const prueba = this.items.findIndex(
                        item => items.id === id
                    ); // find the post index
                    if (~prueba)
                        // if the post exists in array
                        this.items.splice(prueba, 1); //delete the post

                    console.log(this.result);
                });

            this.handleSubmit();
        },
        handleOk(bvModalEvt) {
            // Prevent modal from closing

            bvModalEvt.preventDefault();
            // console.log(this.infoModal);
            console.log(this.api);
            console.log(this.formRecurs);
            if (this.api == "recurso") {
                this.UpdateFORMS(this.api, this.formRecurs);
                 this.handleSubmit();
            } else if (this.api == "alertant") {
                this.UpdateFORMS(this.api, this.formAlertant);

                this.handleSubmit();
            } else if (this.api == "incidencias") {
                this.UpdateFORMS(this.api, this.fomrupdateincidenciasxRecursos);

                this.handleSubmit();
            }


        },
        Actualizar(Apiactuar) {
            this.$store.dispatch(
                "loadUsers",
                "http://127.0.0.1:8000/api/" + Apiactuar
            );
        },
        handleSubmit() {
            // Exit when the form isn't valid

            console.log("cerrar modal");
            console.log(this.infoModal);
            // location.reload();

            // Push the name to submitted names
            // Hide the modal manually
            this.$nextTick(() => {

                // Wrapped in $nextTick to ensure DOM is rendered before closing
                this.$store.dispatch(
                    "loadUsers",
                    "http://127.0.0.1:8000/api/" + this.api
                );
                this.$refs.modal.hide();

            });
             this.popToast();
        },
        eliminar(id) {
            // Exit when the form isn't valid

            axios
                .delete("http://127.0.0.1:8000/api/usuarios/" + id)
                .then(response => {
                    this.$store.dispatch(
                        "loadUsers",
                        "http://127.0.0.1:8000/api/" + this.nombreApi
                    );

                    this.result.splice(id, 1);
                    console.log(this.result);
                });
        },
        guardarPDF(){
            const doc = new jsPDF()
            doc.autoTable({ html: '#my-table' })
            doc.save('table.pdf')
        },
        popToast() {
            // Use a shorter name for this.$createElement
            const h = this.$createElement;
            // Increment the toast count
            this.VALOR++;
            // Create the message
            const vNodesMsg = h("p", { class: ["text-center", "mb-0"] }, [
                h("b-spinner", { props: { type: "grow", small: true } }),
                ` Se ha modificado Correctamente`,
                h("b-spinner", { props: { type: "grow", small: true } })
            ]);
            // Create the title
            const vNodesTitle = h(
                "div",
                {
                    class: [
                        "d-flex",
                        "flex-grow-1",
                        "align-items-baseline",
                        "mr-2"
                    ]
                },
                [
                    h("strong", { class: "mr-2" }, "Notificacion"),
                    h(
                        "small",
                        { class: "ml-auto text-italics" },
                        "5 minutes ago"
                    )
                ]
            );
            // Pass the VNodes as an array for message and title
            this.$bvToast.toast([vNodesMsg], {
                title: [vNodesTitle],
                solid: true,
                variant: "success"
            });
        }
    }
};
</script>
