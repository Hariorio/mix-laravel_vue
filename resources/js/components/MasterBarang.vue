<template>
    <v-container>
    <div class="row">
        <div class="col-lg-12">
            <div class="card elevation-5">
                <div class="card-body">
                    <v-spacer></v-spacer>
                    <div class="row">
                        <div class="col-lg-2">
                            <v-text-field v-model="kodeBarangModel" label="Kode Barang" dense prepend-icon="mdi-google-nearby"></v-text-field>
                        </div>
                        <div class="col-lg-2">
                            <v-text-field v-model="namaBarangModel" label="Nama Barang" dense prepend-icon="mdi-google-nearby"></v-text-field>
                        </div>
                        <div class="col-lg-2">
                            <v-text-field v-model="basePriceBarangModel" label="Base Price" dense prepend-icon="mdi-google-nearby"></v-text-field>
                        </div>
                        <div class="col-lg-2">
                            <v-text-field v-model="sellPriceBarangModel" label="Sell Price" dense prepend-icon="mdi-google-nearby"></v-text-field>
                        </div>
                        <div class="col-lg-4">
                            <v-btn class="" color="primary" elevation="2" small rounded @click="saveData()">SAVE<v-icon right dark>mdi-magnify</v-icon></v-btn>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card elevation-5">
                <div class="card-body">
                    <v-spacer></v-spacer>
                    <v-data-table :headers="headers" :items="itemLists" class="elevation-1" page-count="5" :search="searchItem" :loading="loadingDatatable" dense></v-data-table>
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
            namaBarangModel: '',
            kodeBarangModel: '',
            basePriceBarangModel: '',
            sellPriceBarangModel: '',
            headers: [
                { text: 'KODE BARANG', value: 'kode_barang', align: 'left', class: 'primary--text blue lighten-5' },
                { text: 'DESCRIPTION', value: 'descr', align: 'left', class: 'primary--text blue lighten-5' },
                { text: 'BASE PRICE', value: 'base_price', align: 'right', class: 'primary--text blue lighten-5' },
                { text: 'SELL PRICE', value: 'sell_price', align: 'right', class: 'primary--text blue lighten-5' },
                { text: 'DT. ADDED', value: 'tr_date', align: 'right', class: 'primary--text blue lighten-5' },
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

            await axios.post(`http://127.0.0.1:8000/insertBarang`, { 

                kodeBarang: this.kodeBarangModel ? this.kodeBarangModel : '',
                namaBarang: this.namaBarangModel ? this.namaBarangModel : '',
                basePriceBarang: this.basePriceBarangModel ? this.basePriceBarangModel : '',
                sellPriceBarang: this.sellPriceBarangModel ? this.sellPriceBarangModel : '',

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

            await axios.post(`http://127.0.0.1:8000/getData`, { 


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

        }

    }
  }
</script>
    
