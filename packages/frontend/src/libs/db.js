import low, { LocalStorage } from 'lowdb'

const adapter = new LocalStorage('frontend')
const db = low(adapter)

db
  .defaults({
    auth: {}
  })
  .write()

export default db
