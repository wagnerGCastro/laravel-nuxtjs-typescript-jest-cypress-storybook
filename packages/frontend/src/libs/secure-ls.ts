import SecureLS from 'secure-ls'
import { SECURE_LS_ENCODING, SECURE_LS_SECRET } from '@/config/constants'

const ls = new SecureLS({
  encodingType: SECURE_LS_ENCODING,
  encryptionSecret: SECURE_LS_SECRET,
  isCompression: true
})

export default ls
