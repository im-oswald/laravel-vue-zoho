import { ref } from 'vue'
import axios from "axios"

export default function useAccounts() {
  const errors = ref('')

  const storeAccount = async (data) => {
    errors.value = ''
    try {
      await axios.post('/api/account', data)
      // TODO: show alert here
    } catch (e) {
      // TODO: handle other errors here
      if (e.response.status === 422) {
        errors.value = e.response.data.errors
      }
    }
  }

  return {
    storeAccount,
    errors
  }
}