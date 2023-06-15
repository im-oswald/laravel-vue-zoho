import { ref } from 'vue'
import axios from "axios"
import { useToastr } from '../composables/toastr'

export default function useAccounts() {
  const errors = ref('')
  const loading = ref(false)
  const { showSuccessMessage, showErrorMessage } = useToastr();

  const storeAccount = async (data) => {
    errors.value = ''
    loading.value = true
    try {
      await axios.post('/api/account', data, {
        headers: {
          'Access-Token': localStorage.getItem('access_token'),
          'Refresh-Token': localStorage.getItem('refresh_token'),
          'Access-Token-Created-At': localStorage.getItem('access_token_created_at')
        }
      })
      
      loading.value = false
      showSuccessMessage('Account and Deal created successfully')

      return true
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors
      }

      if (e.response.status === 400) {
        showSuccessMessage('Error creating Account and Deal')
      }

      loading.value = false
      return false
    }
  }

  return {
    storeAccount,
    errors,
    loading,
  }
}