  <template>
   <div id="myModal" class="modal" v-if="sessionCondition && popup" >

      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "removePopup()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
       <img src="../assets/images/success.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-between text-center" style="margin-left: 2rem;">
       <h2 >Data baru anda sedang diproses</h2>
        </div>
       <p>Rutinlah mengecek email anda tiap hari untuk pemberitahuan status akun anda!.Namun anda sekarang juga masih bisa mengubah data anda :)</p>
      </div>

    </div>
  </template>
<script>
export default{
  data(){
    return{
      popup:true
    }
  },
  methods:{
    removePopup(){
      this.popup =false
    }
  },
  props:{
    sessionCondition:Boolean
  },
}
</script>
<style scoped>
.close{
  border-width: 0px;
  background-color: white;
}
  .modal {
  position: fixed; /* Stay in place */
  padding-top: 100px; /* Location of the box */
  left: 0;
  display: block;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.1); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin-top: 3rem;
  margin-left: 25rem;
  padding: 20px;
  border-radius: 25px;
  width: 40%;
  text-align: center;
}


@media (max-width: 575.98px) {
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
  }
}
</style>