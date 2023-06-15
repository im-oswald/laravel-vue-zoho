import { ref } from 'vue'
import axios from "axios"
import { useToastr } from '../composables/toastr'

export default function useAccounts() {
  const errors = ref('')
  const { showSuccessMessage, showErrorMessage } = useToastr();

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
      
      showSuccessMessage('Account and Deal created successfully')
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors
      }

      if (e.response.status === 400) {
        showSuccessMessage('Error creating Account and Deal')
      }
    }
  }

  return {
    storeAccount,
    errors
  }
}