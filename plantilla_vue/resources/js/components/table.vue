<template>
  <div>
    <b-form-group label="Selection mode:" label-cols-md="4">
      <b-form-select v-model="selectMode" :options="modes" class="mb-3"></b-form-select>
    </b-form-group>

    <b-table
      ref="selectableTable"
      selectable
      :select-mode="selectMode"
      :items="users"
      :fields="fields"
      @row-selected="onRowSelected"
      responsive="sm"
    >
      <!-- Example scoped slot for select state illustrative purposes -->
      <template v-slot:cell(selected)="{ rowSelected }">
        <template v-if="rowSelected">
          <span aria-hidden="true">&check;</span>
          <span class="sr-only">Selected</span>
        </template>
        <template v-else>
          <span aria-hidden="true">&nbsp;</span>
          <span class="sr-only">Not selected</span>
        </template>
      </template>
    </b-table>
    <p>
      <b-button size="sm" @click="selectAllRows">Select all</b-button>
      <b-button size="sm" @click="clearSelected">Clear selected</b-button>
      <b-button size="sm" @click="selectThirdRow">Select 3rd row</b-button>
      <b-button size="sm" @click="unselectThirdRow">Unselect 3rd row</b-button>
    </p>
    <p>
      Selected Rows:<br>
      {{ selected }}
    </p>
  </div>
</template>

<script>
import Vuex from 'vuex';

  export default {
    data() {
      return {
        modes: ['multi', 'single', 'range'],
        fields: ['selected', 'isActive', 'age', 'name', 'url'],
        items: [],
          /*{ isActive: true, age: 40, first_name: 'Land', last_name: 'sssss' },
          { isActive: false, age: 21, first_name: 'Kazu', last_name: 'ssss' },
          { isActive: false, age: 89, first_name: 'Albert', last_name: 'sss' },
          { isActive: true, age: 38, first_name: 'Jordi', last_name: 'sss' }*/

        selectMode: 'multi',
        selected: []
      }
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
         created() {

            //this.$store.dispatch('loadUsers','https://jsonplaceholder.typicode.com/users');
            //this.$store.dispatch('loadUsers','https://jsonplaceholder.typicode.com/posts');
                        this.$store.dispatch('loadUsers','https://pokeapi.co/api/v2/pokemon');

  },




    methods: {

      onRowSelected(items) {
        this.selected = items
      },
      selectAllRows() {
        this.$refs.selectableTable.selectAllRows()
      },
      clearSelected() {
        this.$refs.selectableTable.clearSelected()
      },
      selectThirdRow() {
        // Rows are indexed from 0, so the third row is index 2
        this.$refs.selectableTable.selectRow(2)
      },
      unselectThirdRow() {
        // Rows are indexed from 0, so the third row is index 2
        this.$refs.selectableTable.unselectRow(2)
      }
    }
  }
</script>
