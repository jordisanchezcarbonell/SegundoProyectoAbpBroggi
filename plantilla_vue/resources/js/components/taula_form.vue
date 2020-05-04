<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col lg="5" sm="5" md="5" class="my-1">
        <b-form-group
          label="Ordenar"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="sortBySelect"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-select v-model="sortBy" id="sortBySelect" :options="sortOptions" class="w-75">
              <template v-slot:first>
                <option value="">-- cap filtre --</option>
              </template>
            </b-form-select>
            <b-form-select v-model="sortDesc" size="sm" :disabled="!sortBy" class="w-25">
              <option :value="false">Ascendent</option>
              <option :value="true">Descendent</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col sm="7" md="7" class="my-1">
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


      <b-col lg="5" class="my-1">
        <b-form-group
          label="Filtrar"
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
              <b-button :disabled="!filter" @click="filter = ''">Esborrar</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="7" class="my-1">
        <b-form-group
          label="Municipi"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0">
          <b-form-checkbox-group v-model="filterOn" class="mt-1">
            <b-form-checkbox value="id_provincia">Barcelona</b-form-checkbox>
            <b-form-checkbox value="2">Girona</b-form-checkbox>
            <b-form-checkbox value="3">Lleida</b-form-checkbox>
            <b-form-checkbox value="4">Tarragona</b-form-checkbox>
          </b-form-checkbox-group>
        </b-form-group>
      </b-col>

      <b-col sm="12" md="12" class="my-1">
        <b-pagination
          v-model="currentPage"
          :total-rows="current_items.length"
          :per-page="perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>


    </b-row>

    <!-- Main table element -->
    <b-table
    selectable
        select-mode="single"
      head-variant="dark"
      show-empty
      small
      stacked="md"
      :items="current_items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filterIncludedFields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @row-dblclicked="showInfo"
      @filtered="onFiltered"
    >



    </b-table>
  </b-container>
</template>

<script>
import Vuex from "vuex";
  export default {
    /*props:{
      current_items:{
        type: Array,
        required: true,
      },
      col1:{
        type: String,
        required: true,
      },
      col2:{
        type: String,
        required: true,
      }
    },*/
    props:[
      "current_items",
      "col1",
      "col2",
      "col3",
      "col4",
      "col5",
      "col6",
      "col7",
      "col8"
    ],
    data() {
      return {
        fields: [
          //columnes personalitzades
          {
            key: this.col1,
            label: this.col1,
            sortable: true,
            class: "text-center"
          },
          {
            key: this.col2,
            label: this.col2,
            sortable: true,
            class: "text-center"
          },
          {
            key: this.col3,
            label: this.col3,
            sortable: true,
            class: "text-center"
          },
          {
            key: this.col4,
            label: this.col4,
            sortable: true,
            class: "text-center"
          },
          {
            key: this.col6,
            label: this.col5,
            sortable: true,
            class: "text-center"
          },
          {
            key: this.col7,
            label: this.col8,
            sortable: true,
            class: "text-center"
          }
        ],
        //totalRows: 1,
        currentPage: 1,
        perPage: 10,
        pageOptions: [5, 10, 15],
        sortBy: '',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
      }
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      }
    },
    mounted() {
      // Set the initial number of items
      //this.totalRows = this.items.length
    },
    methods: {
      resetInfoModal() {
        this.infoModal.title = ''
        this.infoModal.content = ''
      },
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      showInfo(item, index){
        //alert(item.id)

        this.$emit('tancar-modal', item);
      }
    }
  }
</script>
