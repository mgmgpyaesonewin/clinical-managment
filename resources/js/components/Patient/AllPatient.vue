<template>
    <div>
        <div class="row">
            <div class="col-12">
            <h3 class="vue-title">Vue Tables 2 Demo - Client Component</h3>

<div id="app">
  <v-client-table :columns="columns" :data="data" :options="options">
    <a slot="uri" slot-scope="props" target="_blank" :href="props.row.uri" class="glyphicon glyphicon-eye-open"></a>

    <div slot="child_row" slot-scope="props">
      The link to {{props.row.name}} is <a :href="props.row.uri">{{props.row.uri}}</a>
    </div>

  </v-client-table>
</div>


            </div>
        </div>
    </div>
</template>
<style lang="css">
.table td,
.table th{
padding: 0.5rem
}
.table{
    /* padding:0 !important;
    margin:0 !important;
     */
   border: 0px;
    padding:0; 
    border-spacing: 0;
    margin:0;
    border-collapse: collapse;
}
.VuePagination {
  text-align: center;
}

.vue-title {
  text-align: center;
  margin-bottom: 10px;
}

.vue-pagination-ad {
  text-align: center;
}

.glyphicon.glyphicon-eye-open {
  width: 16px;
  display: block;
  margin: 0 auto;
}

th:nth-child(3) {
  text-align: center;
}

.VueTables__child-row-toggler {
  width: 16px;
  height: 16px;
  line-height: 16px;
  display: block;
  margin: auto;
  text-align: center;
}

.VueTables__child-row-toggler--closed::before {
  content: "+";
}

.VueTables__child-row-toggler--open::before {
  content: "-";
}

    
</style>
<script>
export default {
 
    data(){
        return{
                columns: ['name', 'code', 'uri'],

    data:getData(),
    options: {
      headings: {
        name: 'Country Name',
        code: 'Country Code',
        uri: 'View Record'
      },
      sortable: ['name', 'code'],
      filterable: ['name', 'code']
    }
        }
    },
    mounted(){
        axios.get('patients/')
        .then((res)=>{
            this.patients=res.data
            console.log(this.patients)
        })
        .catch((err)=>{
            console.log(err)
        })
    }
}

function getData() {
  return [{
    code: "ZW",
    name: "Zimbabwe",
    created_at: "2015-04-24T01:46:50.459583",
    updated_at: "2015-04-24T01:46:50.459593",
    uri: "http://api.lobbyfacts.eu/api/1/country/245",
    id: 245
  }, {
    code: "ZM",
    name: "Zambia",
    created_at: "2015-04-24T01:46:50.457459",
    updated_at: "2015-04-24T01:46:50.457468",
    uri: "http://api.lobbyfacts.eu/api/1/country/244",
    id: 244
  }, {
    code: "YE",
    name: "Yemen",
    created_at: "2015-04-24T01:46:50.454731",
    updated_at: "2015-04-24T01:46:50.454741",
    uri: "http://api.lobbyfacts.eu/api/1/country/243",
    id: 243
  }, {
    code: "EH",
    name: "Western Sahara",
    created_at: "2015-04-24T01:46:50.452002",
    updated_at: "2015-04-24T01:46:50.452011",
    uri: "http://api.lobbyfacts.eu/api/1/country/242",
    id: 242
  }, {
    code: "WF",
    name: "Wallis & Futuna",
    created_at: "2015-04-24T01:46:50.449346",
    updated_at: "2015-04-24T01:46:50.449355",
    uri: "http://api.lobbyfacts.eu/api/1/country/241",
    id: 241
  }, {
    code: "VN",
    name: "Vietnam",
    created_at: "2015-04-24T01:46:50.446644",
    updated_at: "2015-04-24T01:46:50.446652",
    uri: "http://api.lobbyfacts.eu/api/1/country/240",
    id: 240
  }, {
    code: "VE",
    name: "Venezuela",
    created_at: "2015-04-24T01:46:50.444031",
    updated_at: "2015-04-24T01:46:50.444040",
    uri: "http://api.lobbyfacts.eu/api/1/country/239",
    id: 239
  }, {
    code: "VU",
    name: "Vanuatu",
    created_at: "2015-04-24T01:46:50.441423",
    updated_at: "2015-04-24T01:46:50.441433",
    uri: "http://api.lobbyfacts.eu/api/1/country/238",
    id: 238
  }, {
    code: "UZ",
    name: "Uzbekistan",
    created_at: "2015-04-24T01:46:50.438748",
    updated_at: "2015-04-24T01:46:50.438757",
    uri: "http://api.lobbyfacts.eu/api/1/country/237",
    id: 237
  }, {
    code: "UY",
    name: "Uruguay",
    created_at: "2015-04-24T01:46:50.435761",
    updated_at: "2015-04-24T01:46:50.435770",
    uri: "http://api.lobbyfacts.eu/api/1/country/236",
    id: 236
  }, {
    code: "VI",
    name: "United States Virgin Islands",
    created_at: "2015-04-24T01:46:50.433229",
    updated_at: "2015-04-24T01:46:50.433238",
    uri: "http://api.lobbyfacts.eu/api/1/country/235",
    id: 235
  }, {
    code: "US",
    name: "United States",
    created_at: "2015-04-24T01:46:50.430335",
    updated_at: "2015-04-24T01:46:50.430340",
    uri: "http://api.lobbyfacts.eu/api/1/country/234",
    id: 234
  }, {
    code: "GB",
    name: "United Kingdom",
    created_at: "2015-04-24T01:46:50.427956",
    updated_at: "2015-04-24T01:46:50.427961",
    uri: "http://api.lobbyfacts.eu/api/1/country/233",
    id: 233
  }];
}

</script>