<template>
  <div class="container">
    <Form />
  </div>
</template>

<script>
  import Form from './components/form/Form.vue'
  import useTokens from './composables/tokens'
  import checkPastTime from './utils/checkPastTime'

  export default {
    data: () => ({
      intervalValue: 0
    }),

    components: {
      Form
    },

    mounted() {
      const { refreshToken } = useTokens()

      if (!localStorage.getItem('refresh_token')) {
        this.$router.push({ path: '/auth/zoho/callback' })
      }

      this.intervalValue = setTimeout(() => {
        if(checkPastTime()) {
          refreshToken()
        }
      }, 1000);
    },

    destroyed() {
      if (this.intervalValue) {
        clearInterval(this.intervalValue)
      }
    }
  }
</script>