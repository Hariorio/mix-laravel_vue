<template>
    <v-container>
    <div class="row">
        <div class="col-lg-12">
            <div class="card elevation-5">
                <div class="card-body">
                    <div class="card-title"><h5>Master Member</h5></div>
                    <v-spacer></v-spacer>
                    <div class="row">
                        <div class="col-lg-2">
                            <v-text-field v-model="nameModel" label="Nama Member" dense prepend-icon="mdi-google-nearby"></v-text-field>
                        </div>
                        <div class="col-lg-2">
                            <v-text-field v-model="addressModel" label="Alamat Member" dense prepend-icon="mdi-google-nearby"></v-text-field>
                        </div>
                        <div class="col-lg-2">
                            <v-text-field v-model="cityModel" label="Kota Member" dense prepend-icon="mdi-google-nearby"></v-text-field>
                        </div>
                        <div class="col-lg-2">
                            <v-text-field v-model="phoneModel" label="No. HP" dense prepend-icon="mdi-google-nearby"></v-text-field>
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
            nameModel: '',
            addressModel: '',
            cityModel: '',
            phoneModel: '',
            headers: [
                { text: 'NAMA', value: 'name', align: 'left', class: 'primary--text blue lighten-5' },
                { text: 'ALAMAT', value: 'address', align: 'left', class: 'primary--text blue lighten-5' },
                { text: 'KOTA', value: 'city', align: 'right', class: 'primary--text blue lighten-5' },
                { text: 'NO. HP', value: 'phone', align: 'right', class: 'primary--text blue lighten-5' },
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

            await axios.post(`http://127.0.0.1:8000/insertMember`, { 

                name: this.nameModel ? this.nameModel : '',
                address: this.addressModel ? this.addressModel : '',
                city: this.cityModel ? this.cityModel : '',
                phone: this.phoneModel ? this.phoneModel : '',

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

            await axios.post(`http://127.0.0.1:8000/getDataMember`, { 


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
    
