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
    default: 'please set a title props'
  }
});
</script>

<style scoped>
.left_content {
  background-image: url('../assets/images/auth_left_img.png');
  background-position: center;
  background-size: cover;
}

@media (max-width: 575.98px) {
  .left_content {
    display: none;
  }
}
</style>