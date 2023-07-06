<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        iki halaman memek

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        cokModel : ''

      }
    },
    async mounted(){
    
      this.initialize()

    },
    methods:{

      initialize(){
          
          this.cokModel = 'i love nundu'

      },

      async getMemberListData(){

            await axios.get(`/testGetData`, { 
                headers: { 
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Origin': '*',
                    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                } 
            })
            .then(res => {

                this.userLists = res.data.result
                // console.log(res.data.result);

            })
            .catch(err => {
                
                console.log(err)

            })

        },

    }
  }
</script>
    
