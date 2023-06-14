<template>
  <div class="mt-5 col-lg-5 col-md-6 col-sm-8 col-xs-10" v-if="errors">
    <div v-for="(v, k) in errors" :key="k" class="bg-danger text-white rounded font-weight-bold mb-4 shadow-lg px-4 pr-0">
      <p v-for="error in v" :key="error" class="small py-2">
        {{ error }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: ['errors'],
}
</script>
