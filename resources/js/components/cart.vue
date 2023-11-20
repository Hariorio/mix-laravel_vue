<template>
    <v-container>
    <div class="row">
        <div class="col-lg-12">
            <div class="card elevation-5">
                <div class="card-body">
                    <div class="card-title"><h5>Keranjang Belanja</h5></div>
                    <v-spacer></v-spacer>
                    <div class="row">
                        <div class="col-lg-6">
                            <v-autocomplete
                                v-model="findItemModel"
                                :items="findItemLists"
                                item-value="kode_barang"
                                item-text="descr"
                                :search-input.sync="search"
                                cache-items
                                flat
                                hide-no-data
                                hide-details
                                dense
                                clearable
                                label="Cari Barang"
                                @change="(event) => onChangeItem(event)"></v-autocomplete>
                        </div>
                        <div class="col-lg-3">
                            <v-text-field v-model="qtyModel" label="Jumlah Barang" dense></v-text-field>
                        </div>
                        <div class="col-lg-3">
                            <v-btn class="mt-1" color="primary" elevation="2" small rounded @click="saveData()">SAVE</v-btn>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card elevation-5">
                <div class="card-body">
                    <v-spacer></v-spacer>
                    <v-data-table :headers="headers" :items="itemLists" class="elevation-1" page-count="5" :search="searchItem" :loading="loadingDatatable" dense>
                        <template v-slot:[`item.total`]="{ item }">
                            Rp. {{item.sell_price * item.qty}}
                        </template>
                        <template v-slot:[`item.action`]="{ item }">
                            <v-menu offset-y>
                                <template v-slot:activator="{ on }">
                                <v-btn icon v-on="on">
                                    <i class="fas fa-fw fa-wrench"></i>
                                </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item link>
                                        <v-list-item-title class="ma-2" @click="deleteItem(item)">Delete</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                                
                        </template>
                    </v-data-table>
                </div>
            </div>
        </div>

    </div>
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
            qtyModel: '',
            findItemModel: '',
            findItemLists: [],
            search: null,
            headers: [
                { text: 'KODE BARANG', value: 'kode_barang', align: 'left', class: 'primary--text blue lighten-5' },
                { text: 'DESCRIPTION', value: 'descr', align: 'left', class: 'primary--text blue lighten-5' },
                { text: 'QTY', value: 'qty', align: 'right', class: 'primary--text blue lighten-5' },
                { text: 'PRICE', value: 'sell_price', align: 'right', class: 'primary--text blue lighten-5' },
                { text: 'TOTAL', value: 'total', align: 'right', class: 'primary--text blue lighten-5' },
                { text: '', value: 'action', align: 'right', class: 'primary--text blue lighten-5' },
            ],
            itemLists: [],
            searchItem: '',
            loadingDatatable: false
        }
    },
    async mounted(){
    
        this.getData()

    },
    methods:{
        
        async saveData(){

            // console.log(this.findItemModel);

            await axios.post(`http://127.0.0.1:8000/insertBarangCart`, { 

                kodeBarang: this.findItemModel ? this.findItemModel : '',
                qty: this.qtyModel ? this.qtyModel : '',

            },
            {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*',
                    } 
            })
            .then(res => {
                
                console.log(res.data)

                this.getData()

            })
            .catch(err => {

                console.log(err);

            })

        },

        async getData(){

            await axios.post(`http://127.0.0.1:8000/getDataCart`, { 


            },
            {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*',
                    } 
            })
            .then(res => {
                
                console.log(res.data)
                this.itemLists = res.data.result

            })
            .catch(err => {

                console.log(err);

            })

        },

        onChangeItem(id){

            console.log(id);

        },

        async getBarang(id){

            await axios.post(`http://127.0.0.1:8000/getBarang`, { 
                    id : id,
            },{
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*',
                    } 
            })
            .then(res => {

                this.findItemLists = res.data.result

            })
            .catch(err => {

                console.log(err)

            })

        },

        async deleteItem(id){

            console.log(id.kode_barang)

            await axios.post(`http://127.0.0.1:8000/deleteBarang`, { 
                    id : id.kode_barang,
            },{
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*',
                    } 
            })
            .then(res => {

                this.getData()

            })
            .catch(err => {

                console.log(err)

            })

        }

    },
    watch: {
        search (val) {
            val && val !== this.findItemModel && this.getBarang(val)
        },
    }
  }
</script>
    
