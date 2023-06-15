<template>
  <Errors :errors="errors" />

  <form class="mt-5" @submit.prevent="saveAccount">
    <h1>Account Information</h1>
    <div class="form-row">
      <div class="form-group mt-2 col-lg-3 col-md-4 col-sm-6 col-xs-10">
        <label for="name">Account Name</label>
        <input type="text" class="form-control" placeholder="Enter account name" v-model="account.name" required>
      </div>

      <div class="form-group mt-2 col-lg-3 col-md-4 col-sm-6 col-xs-10">
        <label for="website">Account Website</label>
        <input type="url" class="form-control" placeholder="Enter account website" v-model="account.website" required>
      </div>

      <div class="form-group mt-2 col-lg-3 col-md-4 col-sm-6 col-xs-10">
        <label for="phone">Account Phone</label>
        <input type="text" class="form-control" placeholder="Enter account phone" v-model="account.phone" required>
      </div>
    </div>

    <h1 class="mt-5">Deal Information</h1>
    <div class="form-row">
      <div class="form-group mt-2 col-lg-3 col-md-4 col-sm-6 col-xs-10">
        <label for="name">Deal Name</label>
        <input type="text" class="form-control" placeholder="Enter deal name" v-model="account.deal.name" required>
      </div>

      <div class="form-group mt-2 col-lg-3 col-md-4 col-sm-6 col-xs-10">
        <label for="website">Deal Stage</label>
        <input type="text" class="form-control" placeholder="Enter deal stage" v-model="account.deal.stage" required>
      </div>
    </div>

    <button type="submit" class="btn btn-success mt-4" :disabled="loading">Create</button>
  </form>
</template>

<script>
import { reactive } from "vue";
import useAccounts from "../../composables/accounts";
import Errors from "../errors/Errors.vue";

export default {
  components: {
    Errors
  },

  setup() {
    const account = reactive({
      name: '',
      website: '',
      phone: '',
      deal: {
        name: '',
        stage: ''
      }
    })

    const { errors, storeAccount, loading } = useAccounts()

    const saveAccount = async () => {
      const success = await storeAccount({ ...account })

      if (success) {
        account.name = ''
        account.website = ''
        account.phone = ''
        account.deal.name = ''
        account.deal.stage = ''
      }
    }

    return {
      account,
      errors,
      saveAccount,
      loading
    }
  }
}
</script>
