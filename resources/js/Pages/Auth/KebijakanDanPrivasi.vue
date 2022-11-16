<template>
  <BaseLayout title="Kebijakan Privasi">
    <section class="mt-4">
      <div class="container">
        <h1>Kebijakan Privasi</h1>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate minima maiores, molestias natus esse
          dolores facere atque, explicabo qui delectus quo saepe, quas impedit maxime exercitationem? Iure aliquam,
          rerum perspiciatis architecto explicabo adipisci repellat, ipsam officia nostrum voluptas qui aspernatur,
          exercitationem quos similique aperiam maxime porro totam perferendis sunt optio.
        </p>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni recusandae tempore veniam perspiciatis alias
          quae. Illo officiis, repellendus distinctio placeat expedita non quisquam laboriosam sed facere fugiat, iure
          iusto voluptatum natus commodi, pariatur esse harum. Eligendi exercitationem accusantium nihil dolores porro
          numquam cupiditate ratione necessitatibus modi, dolorem reprehenderit molestias inventore quo, quasi sed
          facilis. Quasi vitae quisquam, mollitia repellendus eaque sint! Eligendi, vitae omnis delectus iure provident
          fugiat quas ducimus, libero hic dignissimos soluta sint deleniti! Quod, quo quas ipsam inventore praesentium
          deserunt cum! Recusandae voluptatibus et non laborum! Veritatis voluptatem officia pariatur. Non deleniti, in
          voluptate harum quibusdam beatae?
        </p>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate minima maiores, molestias natus esse
          dolores facere atque, explicabo qui delectus quo saepe, quas impedit maxime exercitationem? Iure aliquam,
          rerum perspiciatis architecto explicabo adipisci repellat, ipsam officia nostrum voluptas qui aspernatur,
          exercitationem quos similique aperiam maxime porro totam perferendis sunt optio.
        </p>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut, animi, beatae nesciunt minima error deleniti ea
          veritatis libero debitis delectus voluptate quam quibusdam eum nulla, repellendus nihil ab sapiente amet
          suscipit labore! Voluptatum, doloribus ipsam asperiores a dicta voluptate sed maiores nihil aut odio ex
          minima? Sint facilis quo consequatur quae dolorum sunt, pariatur deleniti molestias odit adipisci vel quaerat
          enim necessitatibus at quibusdam nobis commodi. Asperiores itaque cupiditate perspiciatis soluta voluptates
          qui quaerat nobis aut recusandae, iure illum sapiente quasi culpa! Illum nesciunt facilis aspernatur ea labore
          accusantium assumenda tempore blanditiis iure autem, expedita recusandae! Officiis, laudantium blanditiis,
          minus, fugiat cumque asperiores voluptatibus ad repellendus ut nisi cum tempora optio maxime modi? Nihil,
          voluptatum voluptates id at fugit ea nulla soluta libero fugiat provident facere tenetur quisquam nostrum
          veniam! Nihil voluptates recusandae laboriosam qui similique animi, provident doloremque? Minima officia
          temporibus culpa expedita eligendi minus at, accusamus odit quaerat delectus? Aspernatur, cum mollitia
          quisquam quibusdam fuga illo. Sed fuga consequuntur inventore officiis rem possimus numquam quos beatae qui.
          Minus tenetur neque velit. Maxime obcaecati inventore rem modi consequatur a, velit architecto at odio
          tempore! Eligendi delectus culpa expedita! Nemo quidem perspiciatis ex amet labore eligendi, ea aliquid?
          Dignissimos, reprehenderit.
        </p>
        <form @submit.prevent="$inertia.visit('/syarat_dan_ketentuan')">
          <div class="form-check">
            <input v-model="isCheckKebijakanPrivasi" class="form-check-input" type="checkbox" id="kebijakan_privasi">
            <label class="form-check-label" for="kebijakan_privasi">
              Saya telah membaca dan menyetujui Kebijakan Privasi dari aplikasi Blanjaloka Akselerator seperti yang
              tertera diatas
            </label>
          </div>
          <button type="submit" :disabled="!isCheckKebijakanPrivasi" class="btn text-neutral-white"
            :class="{'btn-primary-blue-6': isCheckKebijakanPrivasi, 'btn-primary-blue-3': !isCheckKebijakanPrivasi}">Lanjutkan</button>
        </form>
      </div>
    </section>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '../../Layouts/Layout.vue'
import { ref } from 'vue'
const isCheckKebijakanPrivasi = ref(false);
</script>

<style scoped>
section {
  margin-top: 10rem !important;
}
h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
}
p {
  margin-bottom: 1rem;
}
form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 2.5rem;
  margin-top: 6.25rem;
}
.form-check-label {
  font-weight: 600;
  color: #3E4041;
}
form button {
  padding: 0.5rem 10rem;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
  form button {
    width: 100%;
    padding: 0.5rem 0;
  }
}
</style>