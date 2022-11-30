 <template>
  <BaseLayout>
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h1>Dashboard</h1>
                <div class="d-flex flex-column flex-lg-row gap-4 justify-content-between mt-5">
                  <div :class="['step',$page.props.auth.profileComplete != null?'clear':'']">
                    <div class="number">1</div>
                    <h1>Profil Pribadi</h1>
                  </div>
                  <div :class="['step',$page.props.auth.produkComplete != null && $page.props.auth.usahaComplete != null && $page.props.auth.finansialComplete!= null ?'clear':'']">
                    <div class="number">2</div>
                    <h1>Profil UMKM</h1>
                  </div>
                  <div class="step">
                    <div class="number">3</div>
                    <h1>Inkubasi</h1>
                  </div>
                  <div class="step">
                    <div class="number">4</div>
                    <h1>Penilaian</h1>
                  </div>
                  <div class="step">
                    <div class="number">5</div>
                    <h1>Pasar Modal</h1>
                  </div>
                </div>
                <div class="d-flex flex-column flex-lg-row gap-2 bg-primary-blue-1 rounded px-3 py-2 mt-4">
                  <div >
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p  class="fw-semibold text-primary-blue-6 mb-0">
                    Harap lengkapi profil usaha, profil produk, dan kajian finansial agar data Anda dapat diseleksi
                    untuk proses inkubasi!
                  </p>
                </div>
                <div
                  class="d-flex flex-column flex-lg-row gap-2 align-items-center bg-primary-blue-1 rounded px-3 py-2 mt-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                    Saat ini kamu berada di minggu <span class="text-neutral-black">ke-12</span> untuk inkubasi UMKM.
                  </p>
                </div>
                <div class="d-flex flex-column flex-lg-row gap-2 bg-primary-blue-1 rounded px-3 py-2 mt-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                    Anda telah mengikuti proses inkubasi di Blanjaloka. Saat ini UMKM Anda berada pada tahap penilaian
                    untuk dapat masuk ke pasar modal dan mendapatkan dana investasi.
                  </p>
                </div>
                <div
                  class="d-flex flex-column flex-lg-row gap-2 align-items-center bg-primary-blue-1 rounded px-3 py-2 mt-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                    UMKM Anda telah lolos ke pasar modal Blanjaloka. Anda bisa mendapatkan mendanaan dari kami!
                  </p>
                </div>
                <h2 class="text-neutral-gray-4 my-3">Jadwal Janji Temu yang Akan Datang</h2>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="table-primary-blue-4">
                      <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Nama Investor</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>11/10/22</td>
                        <td>Lab 505</td>
                        <td>Bu Malika</td>
                        <td>
                          <a href="#" class="btn btn-primary-blue-6 text-neutral-white">
                            Dijadwalkan
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/Profile.vue'
export default{
  components:{
    BaseLayout
  },
  mounted(){
  }
}
</script>

<style scoped>
section {
  margin-top: 0rem !important;
}
.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
.sidebar ul li {
  padding: 1rem;
  cursor: pointer;
}
.sidebar ul li.active {
  border: 1px solid #AEAEAE;
  border-radius: 0.5rem;
}
.sidebar ul li.active a span,
.sidebar ul li.active a path {
  color: #398AB9;
  fill: #398AB9;
}
.sidebar ul li a {
  width: max-content;
  text-decoration: none;
  font-weight: 600;
  position: relative;
}
.sidebar ul li a span {
  width: max-content;
  position: absolute;
  left: 2rem;
}
.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}
.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 1rem;
}
.step .number {
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.25rem;
  font-weight: 600;
  border-radius: 50%;
  background-color: #D9D9D9;
  color: #FFFFFF;
}
.step h1 {
  font-size: 1.125rem;
  font-weight: 600;
  color: #AEAEAE;
}
.step.clear .number {
  background-color: #398AB9;
}
.step.clear h1 {
  color: #3E4041;
}
h2 {
  font-size: 1.25rem;
  font-weight: 600;
}
table thead tr td,
table thead tr th {
  font-weight: 600;
  color: #3E4041;
  border: none;
  text-align: center;
}
table tbody tr td,
table tbody tr th {
  font-weight: 400;
  color: #3E4041;
  border-bottom: none;
  text-align: center;
  background-color: #F0F0F0;
}
table tbody tr:nth-child(2n) td,
table tbody tr:nth-child(2n) th {
  background-color: #F2F7FA;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>