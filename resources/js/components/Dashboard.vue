<template>
    <v-container>
    <v-row>
        <v-col cols="12">
            <v-breadcrumbs :items="breadcumbs">
                <template v-slot:item="{ item }">
                    <v-breadcrumbs-item
                        :to="item.href"
                        class="text-subtitle-2 crumb-item"
                        :disabled="item.disabled"
                        exact
                    >
                        {{ item.text }}
                    </v-breadcrumbs-item>
                </template>
            </v-breadcrumbs>
        </v-col>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-progress-linear
                        :active="loading"
                        :indeterminate="loading"
                        absolute
                        bottom
                        color="deep-purple accent-4"
                    ></v-progress-linear>
                    <v-container fluid>
                        <v-row>
                            <v-col cols="12" xs="12" sm="5" md="2">
                                <v-autocomplete
                                    solo
                                    clearable
                                    v-model="sales"
                                    :items="saleses"
                                    item-value="salesman_id"
                                    item-text="salesman_name"
                                    label="Sales Person"
                                    class="ma-0 pa-0 border-12"
                                    hide-details=true
                                    :disabled="disabled_sales"
                                ></v-autocomplete>
                                <v-progress-linear
                                    :active="loading2"
                                    :indeterminate="loading2"
                                    absolute
                                    bottom
                                    color="deep-purple accent-4"
                                ></v-progress-linear>
                            </v-col>
                            <v-col cols="12" xs="12" sm="5" md="3">
                                <v-menu
                                    ref="dialog_from"
                                    v-model="modal"
                                    :close-on-content-click="false"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="auto"
                                    >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                        solo
                                        v-model="date_from"
                                        label="Date from"
                                        persistent-hint
                                        append-icon="mdi-calendar"
                                        v-bind="attrs"
                                        v-on="on"
                                        class="ma-0 pa-0 border-12"
                                        hide-details=true
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="date_from"
                                        no-title
                                        @input="[modal = false]"
                                    ></v-date-picker>
                                </v-menu>
                            </v-col>
                            <v-col cols="12" xs="12" sm="5" md="3">
                                <v-menu
                                    ref="dialog"
                                    v-model="modal_to"
                                    :close-on-content-click="false"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="auto"
                                    >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                        solo
                                        v-model="date_to"
                                        label="Date To"
                                        persistent-hint
                                        append-icon="mdi-calendar"
                                        v-bind="attrs"
                                        v-on="on"
                                        class="ma-0 pa-0 border-12"
                                        hide-details=true
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="date_to"
                                        no-title
                                        @input="[modal_to = false]"
                                    ></v-date-picker>
                                </v-menu>
                            </v-col>
                             <v-col cols="12" xs="12" sm="3" md="2">
                                <v-btn class="mt-1 border-12" 
                                color="info" elevation="2" large @click="search()">Search</v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </v-col>
            <v-col cols="12" style="padding-bottom: 100px">
                <v-card outlined>
                    <v-container fluid>
                        <v-row>
                            <v-col cols="12">
                                <v-card-title>Result
                                    <v-spacer></v-spacer>
                                    <v-col cols="12" xs="12" sm="12" md="2" class="text-right">
                                                     <v-btn class="mb-4 mr-2 text-white" 
                                                        color="#0D47A1" elevation="2" medium>
                                                        <download-excel
                                                        class="text"
                                                        :fetch           = "exportExcel"
                                                        :fields="headerexcel"
                                                        :before-generate = "startDownload"
                                                        :before-finish   = "finishDownload">
                                                        Export Excel
                                                        </download-excel> 
                                                     <v-icon>mdi-arrow-down-bold-box</v-icon>
                                                    </v-btn>
                                                </v-col>
                                        </v-card-title>
                                        <v-data-table
                                    fixed-header
                                    height="490"
                                    :headers="headers"
                                    :items="desserts"
                                    :options.sync="options"
                                    :loading="loading"
                                    loading-text="Please wait, retrieving data"
                                    :server-items-length="totalItems"
                                    :page.sync="pagination"
                                    page-count="10"
                                    class="elevation-1"
                                >
                                    <template v-slot:[`item.activity`]="{ item }">
                                        <div v-html="item.activity">

                                        </div>
                                    </template>
                                    <template v-slot:[`item.actions`]="{ item }">
                                        <td>
                                            <v-tooltip top>
                                                <template v-slot:activator="{ on }">
                                                    <v-icon small class="mr-2" @click="showItem(item)" v-on="on">
                                                        mdi-eye
                                                    </v-icon>
                                                </template>
                                                <span>View Map</span>
                                            </v-tooltip>
                                        </td>
                                        <td v-if="item.img_url != '' || item.img_url != null">
                                            <v-tooltip top>
                                                <template v-slot:activator="{ on }">
                                                    <v-chip class="ma-1" color="#283593" elevation="2" dense v-on="on" small rounded @click="showImageModal(item.img_url)" dark><v-icon dark>mdi-file-image</v-icon></v-chip>
                                                </template>
                                                <span>Show Image</span>
                                            </v-tooltip>
                                        </td>
                                    </template>
                                </v-data-table>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
                <v-dialog v-model="dialog" max-width="1000px">                
                    <v-card>
                        <v-card-title>Detail Location</v-card-title>
                        <v-card-text>
                             <v-container fluid>
                                <v-row>
                                    <v-col cols="12">
                                        <div id="map_canvas" style="height:432px; width:100%; border: 1px solid grey;"></div>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-snackbar v-model="snackbar.visible" :color="snackbar.color" :multi-line="snackbar.mode === 'multi-line'" :timeout="snackbar.timeout" :top="snackbar.position === 'top'">
                    <v-layout align-center pr-4>
                        <v-icon class="pr-3" dark large>{{ snackbar.icon }}</v-icon>
                        <v-layout column>
                            <div>
                            <strong>{{ snackbar.title }}</strong>
                            </div>
                            <div>{{ snackbar.text }}</div>
                        </v-layout>
                    </v-layout>
                    <v-btn v-if="snackbar.timeout === 0" icon @click="snackbar.visible = false">
                        <v-icon>clear</v-icon>
                    </v-btn>
                </v-snackbar>
                            </v-col>
      </v-row>
    </v-row>
    </v-container>
</template>

<script>
  export default {
    data () {
           return {
            snackbar: {
                color: null,
                icon: null,
                mode: null,
                position: "top",
                text: null,
                timeout: 7500,
                title: null,
                visible: false
            },
            breadcumbs: [
                {
                text: 'Sunrise Steel',
                disabled: false,
                href: '/admin/sr',
                },
                {
                text: 'Sales Activity',
                disabled: true,
                href: 'breadcrumbs_link_2',
                },
                {
                text: 'Activity Visit Report',
                disabled: true,
                href: 'breadcrumbs_link_2',
                },
            ],
            loading: false,
            offices: [],
            office: '',
            saleses: [],
            sales: '',
            date_from: '',
            modal: false,
            date_to: '',
            modal_to: false,
            display: 'none',
           // purchases: [],
            headers: [
          {
            text: 'Dessert (100g serving)',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Calories', value: 'calories' },
          { text: 'Fat (g)', value: 'fat' },
          { text: 'Carbs (g)', value: 'carbs' },
          { text: 'Protein (g)', value: 'protein' },
          { text: 'Iron (%)', value: 'iron' },
        ],
            desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: 1,
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: 1,
          },
          {
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: 7,
          },
          {
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: 8,
          },
          {
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: 16,
          },
          {
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: 0,
          },
          {
            name: 'Lollipop',
            calories: 392,
            fat: 0.2,
            carbs: 98,
            protein: 0,
            iron: 2,
          },
          {
            name: 'Honeycomb',
            calories: 408,
            fat: 3.2,
            carbs: 87,
            protein: 6.5,
            iron: 45,
          },
          {
            name: 'Donut',
            calories: 452,
            fat: 25.0,
            carbs: 51,
            protein: 4.9,
            iron: 22,
          },
          {
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: 6,
          },
        ],
            headerexcel: {
            'Id Cust':'customerid',
            'Customer': 'namacustomer',
            'Sales': 'nama',
            'Address' : 'alamat',
            'City': 'city',
            'Date': 'tr_date',
            'Remark': 'remark',
            'Activity': 'activity',
            },
            totalItems: 10,
            options: {},
            loading2: false,
            loading:false,
            search_detail: '',
            po_items: [],
            po_item: '',
            option_po_items: {},
            loading3: false,
            loading4: false,
            loading5: false,
            totalItem_po_items: 10,
            dialog: false,
            user_approve1: '',
            user_approve2: '',
            pagination: 1,
            mymap: '',
            data_var: {
                entity_id : 'SR',
                appl_id : 'WEBSR'
            },
            salesid: '',
            disabled_sales: false,
            imageUrl: ''
        }
    },
    async mounted(){
    

    },
    methods:{
        startDownload(){
           this.loading = true
           this.disabledExport=true
        },
        finishDownload(){
            this.loading = false
            this.disabledExport=false
        },
        close() {
            this.dialog = false
        },
        async exportExcel() {
            var start_date = this.date_from ? new Date(this.date_from).toISOString().substr(0, 10).replace(/-/g,"") : ''
            var end_date = this.date_to ? new Date(this.date_to).toISOString().substr(0, 10).replace(/-/g,"") : ''
            if (this.date_from === '' || this.date_from === null) {
                    this.snackbar = {
                    color: "error",
                    icon: "mdi-alert-circle",
                    mode: "multi-line",
                    position: "top",
                    timeout: 7500,
                    title: "Error",
                    text: "Please fill period",
                    visible: true
                    };
                return false;
            } else {
                if (this.start_date) {
                    this.start_date = new Date(this.start_date).toISOString().substr(0, 10).replace(/-/g,"")
                } else  {
                    this.start_date = ''
                }

                if (this.end_date) {
                    this.end_date = new Date(this.end_date).toISOString().substr(0, 10).replace(/-/g,"")
                } else  {
                    this.end_date = ''
                }
                const response = await axios.get(`${process.env.VUE_APP_URL}/api/sr/sales_activity/ExportExcel?search=${this.$store.state.text}&txtOffID=${this.office ? this.office : ''}&salesid=${this.sales ? this.sales : ''}&start_date=${start_date ? start_date : ""}&end_date=${end_date ? end_date : ""}`, {
                headers: { Authorization: `Bearer ${this.$store.getters.isTokenUser}` }
                });
                console.log(response.data);
                return response.data.data
                
            }

        },

    }
  }
</script>
    
