import axios from "axios"

export default function useTokens() {
  const refreshToken = async () => {
    try {
      const resp = await axios.post('/api/token/refresh', {}, {
        headers: {
          'Refresh-Token': localStorage.getItem('refresh_token'),
        }
      })

      const { data: { new_access_token, new_access_token_created_at } = {} } = resp.data;

      if(new_access_token) {
        localStorage.setItem('access_token', new_access_token)
        localStorage.setItem('access_token_created_at', new_access_token_created_at)
      }

    } catch (e) {
      // TODO: handle other errors here
    }
  }

  return {
    refreshToken,
  }
}
