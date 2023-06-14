import { ref } from 'vue'
import axios from "axios"

export default function useAccounts() {
  const errors = ref('')

  const storeAccount = async (data) => {
    errors.value = ''
    try {
      await axios.post('/api/account', data, {
        headers: {
          'Access-Token': localStorage.getItem('access_token'),
          'Refresh-Token': localStorage.getItem('refresh_token'),
          'Access-Token-Created-At': localStorage.getItem('access_token_created_at')
        }
      })
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