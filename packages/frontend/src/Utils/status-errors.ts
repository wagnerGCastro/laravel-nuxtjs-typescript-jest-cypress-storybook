import { AxiosError } from 'axios'

export const statusErrors = (err: AxiosError) => {
  if (err.response) {
    if (err.response.status === 400) {
      return console.log(err.response.data.data)
    }

    if (err.response.status === 500) {
      return console.log('Houve um erro inesperado, tente novamente mais tarde.')
    }
  }

  /** Network Error */
  if (err.name === 'Error') {
    if (err.message === 'Network Error') {
      return console.log('Sem conexão com o servidor.')
    }

    if (err.message === 'Request failed with status code 500') {
      return console.log('Houve um erro com o servidor.')
    }
  }
}
