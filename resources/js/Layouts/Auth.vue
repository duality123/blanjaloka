<template>

  <Head>
    <title>Blanjaloka - {{ title }}</title>
    <meta name="description" content="Your page description">
  </Head>
  <div class="container-fluid">
    <div class="row min-vh-100">
      <div class="col-lg left_content"></div>
      <div class="col-lg right_content">
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3'

const props = defineProps({
  title: {
    type: String,
    default: 'Berikan judul disini'
  }
});
</script>

<style>
.left_content {
  background-image: url('../assets/images/auth_left_img.png');
  background-position: center;
  background-size: cover;
}

h1 {
  font-size: 24px;
  font-weight: 600;
  margin-top: 3rem;
}

p {
  font-size: 16px;
  font-weight: 400;
  margin-bottom: 0;
}

form {
  margin-top: 1.5rem;
}

.icon_eye {
  bottom: 0.8rem;
  right: 0;
  cursor: pointer;
}

.oauth_choose {
  display: grid;
  grid-template-columns: 1fr 1.5fr 1fr;
  align-items: center;
  justify-items: center;
  column-gap: 0.5rem;
}

.line {
  width: 100%;
  height: 2px;
  background-color: #AEAEAE;
}

@media (max-width: 575.98px) {
  .left_content {
    display: none;
  }

  .oauth_choose {
    grid-template-columns: 1fr 2fr 1fr;
  }
}
</style>
